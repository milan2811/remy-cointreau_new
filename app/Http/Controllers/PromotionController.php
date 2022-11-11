<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bar;
use App\Models\Region;
use App\Models\Country;
use App\Models\Promotion;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $role;

    public function __construct()
    {
        $this->role = roles();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('promotion.index', ['title' => "Promotions"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dataTableQuery = Bar::query();
        $user = auth()->user();
        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->whereIn('bars.country', $ids);
        }
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $dataTableQuery->where('id', $user->assigned_id);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $dataTableQuery->where('user_id', $user->id);
        }
        $bars = $dataTableQuery->pluck('name', 'id')->toArray();
        return view('promotion.form', [
            'title' => 'Promotions',
            'promotion' => null,
            'formAttributes' => [
                'url' => route('promotion.store'),
                'method' => 'POST',
                'files' => true,
            ],
            'bars' => $bars
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'promotion_for' => 'required',
            // 'short_description' => 'required',
            // 'description' => 'required',
        ], [
            'promotion_for.required' => 'Please enter name of the promotion',
            'title.required' => 'Please enter item name'
        ]);
        $input = $request->all();

        if (isset($input["image"]) && !empty($input['image'])) {
            $fileName = rand() . $input["image"]->getClientOriginalName();
            $input["image"]->move(public_path('images/promotion/'), $fileName);
            $input["image"] = $fileName;
        }

        $input['price'] = json_encode($input['price']);

        Promotion::create($input);
        return redirect()->route('promotion.index')->with(['success' => 'Promotion created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        $dataTableQuery = Bar::query();
        $user = auth()->user();
        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->whereIn('bars.country', $ids);
        }
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $dataTableQuery->where('id', $user->assigned_id);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $dataTableQuery->where('user_id', $user->id);
        }
        $bars = $dataTableQuery->pluck('name', 'id')->toArray();
        // \Session::put('lastVisited', url());
        return view('promotion.form', [
            'title' => 'Promociones',
            'promotion' => $promotion,
            'formAttributes' => [
                'url' => route('promotion.update', $promotion),
                'method' => 'PUT',
                'files' => true,
            ],
            'bars' => $bars
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        $request->validate([
            'title' => 'required',
            'promotion_for' => 'required',
            // 'short_description' => 'required',
            // 'description' => 'required',
        ], [
            'promotion_for.required' => 'Please enter name of the promotion',
            'title.required' => 'Please enter item name'
        ]);

        $input = $request->all();

        if (isset($input["image"]) && !empty($input['image'])) {
            if ($promotion->image && file_exists(public_path('images/promotion/') . $promotion->image)) {
                unlink(public_path('images/promotion/') . $promotion->image);
            }
            $fileName = rand() . $input["image"]->getClientOriginalName();
            $input["image"]->move(public_path('images/promotion/'), $fileName);
            $input["image"] = $fileName;
        }

        $input['price'] = json_encode($input['price']);

        $promotion->update($input);
        return redirect()->route('promotion.index')->with(['success' => 'Promotion updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        if ($promotion->image && file_exists(public_path('images/promotion/') . $promotion->image)) {
            unlink(public_path('images/promotion/') . $promotion->image);
        }
        $promotion->delete();
        return response()->json(['status' => 1]);
    }

    public function getPromotions(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('title', fn ($promotion) => $promotion->title)
            ->editColumn('image', function ($promotion) {
                $picture = $promotion->image ? asset('/public/images/promotion/' . $promotion->image) : asset('/public/images/placeholder.png');
                return "<img src='" . $picture . "' height='50' width='50'/>";
            })
            ->editColumn('link', fn ($promotion) => $promotion->link ? $promotion->link : 'NIL')
            ->editColumn('created_at', fn ($promotion) => Carbon::parse($promotion->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($promotion) {
                return "<a href='" . route('promotion.edit', $promotion->id) . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>
                <a href='javascript:;' class='btn btn-outline-danger delete_" . $promotion->id . "' data-url='" . route('promotion.destroy', $promotion->id) . "'  onclick='deleteRecorded(" . $promotion->id . ")'><i class='fas fa-trash'></i></a>";
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $user = auth()->user();
        $dataTableQuery = Promotion::select('promotions.*')->leftjoin('bars', 'bars.id', '=', 'promotions.bar_id')->leftjoin('countries as c', 'c.id', '=', 'bars.country')->orderBy('promotions.created_at', 'desc');

        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->whereIn('bars.country', $ids);
        }
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $dataTableQuery->where('bar_id', $user->assigned_id);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $bars = Bar::where('user_id', $user->id)->pluck('id');
            $dataTableQuery->whereIn('bar_id', $bars);
        }
        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('promotions.created_at', [$from, $to]);
        }

        return  $dataTableQuery;
    }
}
