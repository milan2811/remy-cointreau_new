<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Carbon\Carbon;
use App\Models\Term;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;


class TermController extends Controller
{

    public $type = null;

    public function __construct()
    {
        $this->type = "category";
        if (request()->is('*ingredients*')) {
            $this->type = "ingredients";
        }
        if (request()->is('*brands*')) {
            $this->type = "brands";
        }
        if (request()->is('*drink*')) {
            $this->type = "drink";
        }
        if (request()->is('*products*')) {
            $this->type = "products";
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $terms = Term::where('type', $this->type)->get();
        if ($this->type == "ingredients" || $this->type == "products" || $this->type == "brands" ||  $this->type == "category" ) {
            return view('terms.ingredients', ["title" => $this->type, "terms" => $terms]);
        } else {
            return view('terms.terms', ["title" => $this->type, "terms" => $terms]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = Term::select("id", "name")->where('type', $this->type)->pluck("name", "id")->toArray();
        return view('terms.terms-form', [
            'title' => $this->type,
            'term' => null,
            'parents' => $parents,
            "formAttributes" => [
                "url" => route($this->type . '.store'),
                "method" => "POST",
                "files" => true
            ]
        ]);
    }

    public function slug($name)
    {
        $slug = strtolower($name);
        $slug = preg_replace("/\W+/", "-", $slug); // \W = any "non-word" character
        return trim($slug, "-");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'type' => "required"
        ]);

        $input = $request->all();
        if ($this->createTerm($input) == false) {
            return redirect()->back()->withInput($input)->withErrors(['name' => 'Name Already Exist']);
        }
        $url = route($this->type . '.index');
        return redirect($url)->with("success", ucwords($this->type) . " created Successfully");
    }

    public function createTerm($input)
    {
        $input["slug"] = $this->slug($input['name']);
        $check = Term::where('slug', $input['slug'])->where('type', $input['type'])->count();
        if ($check > 0) {
            if($input['type'] == 'drink') {
                $last = Term::where('slug', 'LIKE', $input['slug'].'%')->where('type', $input['type'])->orderBy('id','desc')->first();
                $no = explode('-',$last->slug);
                $input["slug"] = $input["slug"] . '-'. (isset($no[1]) ? $no[1] + 1 : 1);                
            } else {
                return false;
            }
        }

        if (isset($input["picture"]) && !empty($input['picture'])) {
            $fileName = rand() . $input["picture"]->getClientOriginalName();
            $input["picture"]->move(public_path('images/terms/picture/'), $fileName);
            $input["picture"] = $fileName;
        }
        $input['parent'] = isset($input['parent']) && $input['parent'] ? $input['parent'] : 0;

        return Term::create($input);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function show(Term $term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $term = Term::with('children')->find($id);
        $ids = [$id];
        if ($term->children->count() > 0) {
            $ids = array_merge($ids, $term->children->pluck("id")->toArray());
        }
        $parents = Term::select("id", "name")->where('type', $this->type)->whereNotIn('id', $ids)->pluck("name", "id")->toArray();
        // dd($parents);
        return view('terms.terms-form', ['title' => $this->type, 'parents' => $parents, 'term' => $term, "formAttributes" => ["url" => route($this->type . '.update', $term->id), "method" => "PUT", "files" => true]]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            // 'slug' => "required|unique:terms,slug,$id",
            'type' => "required"
        ]);

        $term = Term::find($id);
        $input = $request->all();

        $input["slug"] = $this->slug($input['name']);
        $check = Term::where('slug', $input['slug'])->where('type', $input['type'])->where('id', '!=', $id)->count();
        if ($check > 0) {
            if($input['type'] != 'drink') {                        
                return false;
                return redirect()->back()->withInput($input)->withErrors(['name' => "Name Already Exist"]);
            }
            $input["slug"] = $term->slug;
        }

        // $input["slug"] = str_replace(' ', '-', strtolower(trim($input["slug"])));

        $input["type"] = $input['type'];

        if (isset($input["picture"]) && !empty($input['picture'])) {
            if ($term->picture && file_exists(public_path('images/terms/picture/') . $term->picture)) {
                unlink(public_path('images/terms/picture/') . $term->picture);
            }
            $fileName = rand() . $input["picture"]->getClientOriginalName();
            $input["picture"]->move(public_path('images/terms/picture/'), $fileName);
            $input["picture"] = $fileName;
        }

        $term->update($input);
        $url = route($this->type . '.index');
        return redirect($url)->with("success", ucwords($this->type) . " updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Term  $term
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $term = Term::find($id);

        if (isset($term->getAssignTerms) && count($term->getAssignTerms) == 0) {
            if ($term->children->count() > 0) {
                return response()->json(['status' => 0, 'msg' => "Please remove the sub terms to delete"]);
            }
            if ($term->picture && file_exists(public_path('images/terms/picture/') . $term->picture)) {
                unlink(public_path('images/terms/picture/') . $term->picture);
            }
            Analytics::where('object_id', $term->id)->where('type', $term->type)->delete();
            $term->delete();
            return response()->json(['status' => 1]);
        } else {
            return response()->json(['status' => 0, 'msg' => "You can't delete this record, because this record assign to menu item"]);
        }
    }

    public function getTerms(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('name', fn ($term) => $term->name)
            ->editColumn('slug', fn ($term) => $term->slug)
            ->editColumn('picture', function ($term) {
                $picture = $term->picture ? asset('/public/images/terms/picture/' . $term->picture) : asset('/public/images/placeholder.png');
                return "<img src='" . $picture . "' height='50' width='50'/>";
            })
            ->editColumn('created_at', fn ($term) => Carbon::parse($term->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($term) use ($request) {
                return "<a href='" . route($this->type . '.edit', $term->id) . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>
                <a href='javascript:;' class='btn btn-outline-danger delete_" . $term->id . "' data-url='" . route($this->type . '.destroy', $term->id) . "'  onclick='deleteRecorded(" . $term->id . ")'><i class='fas fa-trash'></i></a>";
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {

        $dataTableQuery = Term::query()->where('type', $this->type)->where('status', 1);

        if (isset($input["parent"]) && $input["parent"] != 0 && $input["parent"] != '') {
            $dataTableQuery->where("parent", $input['parent']);
        } else {
            $dataTableQuery->where("parent", 0);
        }

        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('terms.created_at', [$from, $to]);
        }

        // if (isset($input['date']) && $input['date'] != '') {
        //     $dataTableQuery->whereDate('components.created_at', '=', $input['date']);
        // }


        if (isset($input['role_id']) && $input['role_id'] != '') {
            $dataTableQuery->where('role_id', $input['role_id']);
        }


        return  $dataTableQuery;
    }

    public function getChildren(Request $request)
    {
        if (!isset($request->id) || $request->id == '') {
            return response([
                'success' => 1,
                'terms' => Term::where('type', 'products')->pluck("name", "id")->toArray(),
            ]);
        }
        return response([
            'success' => 1,
            'terms' => Term::where('parent', $request->id)->pluck("name", "id")->toArray(),
        ]);
    }
}
