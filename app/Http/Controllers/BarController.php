<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use Carbon\Carbon;
use App\Models\Bar;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Term;
use App\Models\Item;
use App\Models\Region;
use App\Models\Promotion;
use App\Models\ItemsRelationship;
use App\Models\Font;
use PDF;
use QrCode;
use App\Models\Country;

class BarController extends Controller
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


    public function index()
    {
        $user = auth()->user();
        $countries = Country::all();
        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $countries = Region::where('id', $user->assigned_id)->first()->countries();
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $countries = $countries->where('id', $user->assigned_id);
        }

        $bars = Bar::whereIn('country', $countries->pluck('id'));
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Bar AdminAdmin
            $bars = $bars->where('id', $user->assigned_id)->first();
            $countries = $countries->where('id', $bars->country);
        }
        $cities = $bars->distinct('city')->pluck('city')->toArray();

        if ($user->role_id == $this->role['Account Admin']) {
            $barsCountry = Bar::where('user_id', $user->id)->pluck('country')->toArray();
            $cities = Bar::where('user_id', $user->id)->pluck('city')->toArray();
            $countries = $countries->whereIn('id', $barsCountry);
        }
        $countries = $countries->pluck('country_name', 'id')->toArray();

        $types = $bars->distinct('type')->pluck('type')->toArray();

        if ($user->role_id == $this->role['Bar Admin']) { // is National Admin
            $countries = null;
            $cities = null;
        }
        $category = Term::where("type", "category")->pluck("name", "id");

        return view("bar.bars", [
            'title' => 'Restaurant / Bar',
            'countries' => $countries,
            'cities' => $cities,
            'types' => $types,
            'category' => $category,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role_id', $this->role["Account Admin"])->pluck('name', 'id')->toArray();
        $countries = Country::pluck('country_name', 'id')->toArray();
        $fonts = Font::orderBy('name', 'asc')->pluck("name", "id");
        return view(
            'bar.bars-form',
            [
                'title' => "Add Restarant / Bar",
                "bar" => null,
                'users' => $users,
                'countries' => $countries,
                "fonts" => $fonts,
                "formAttributes" => [
                    "url" => route('bars.store'),
                    "method" => "POST",
                    "files" => true,
                    "role" => 'form',
                    "autocomplete" => "off"
                ]
            ]
        );
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
            'slug' => 'required|unique:bars',
            'user_id' => 'required|integer',
            'type' => 'required',
            // 'show_brand' => 'required',
            'settings.color.item_name' => 'required',
            'settings.color.item_price' => 'required',
            'settings.color.highlight' => 'required',
            'settings.color.heading' => 'required',
        ], [
            'settings.color.item_name.required' => 'Item Name Color is required',
            'settings.color.item_price.required' => 'Item Price Color is required',
            'settings.color.highlight' => 'Highlight Color is required',
            'settings.color.heading' => 'Heading Color is required',
        ]);

        
        $input = $request->all();
        $input['show_brand'] = 1;
        
        $input["slug"] = str_replace(' ', '-', strtolower($input["slug"]));
        
        if (isset($input["logo"]) && !empty($input['logo'])) {
            $fileName = rand() . $input["logo"]->getClientOriginalName();
            $input["logo"]->move(public_path('images/bars/logo/'), $fileName);
            $input["logo"] = $fileName;
        }
        
        $images = [];
        if (isset($input["images"]) && !empty($input["images"])) {
            foreach ($input["images"] as $image) {
                $imageName = rand() . $image->getClientOriginalName();
                $image->move(public_path('images/bars/'), $imageName);
                $images[] = $imageName;
            }
        }
        
        $input["images"] = json_encode($images);
        $input['settings'] = json_encode($input['settings']);
        Bar::create($input);
        
        return redirect(route('bars.index'))->with("success", "Bar Registered Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bar $bar)
    {
        analytics($request, $bar->id, 'bar', $bar->id);
        $search = $request->has('search') ? $request->search : '';
        // $categories = Term::where('type', 'category')->where('name', 'LIKE', "%$search%")->orderBy('created_at', 'desc')->where('status', 1)->get();
        $items = Item::where('name', 'LIKE', "%$search%")->where('bar_id', $bar->id)->where('status', 1)->get();
        // $terms = ItemsRelationShip::with('term')->whereIn('item_id', $items->pluck('id'))->get()->pluck('term');
        $drinks = Term::where('type', 'drink')->whereIn('id', $items->pluck('drink_id'))->where('status', 1)->get();
        // dd($categories);
        $promotions = Promotion::where('bar_id', $bar->id)->orderBy('created_at', 'desc')->get();
        session()->put('lastVisited', url()->current());
        session()->put('bar_home_url', url()->current());
        return view('home', ['drinks' => $drinks, 'items' => $items, 'promotions' => $promotions, 'bar' => $bar]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function edit(Bar $bar)
    {
        if (!$this->isAuthorized($bar)) {
            abort(401, 'UNAUTHORIZED');
        }
        $users = User::where('role_id', $this->role["Account Admin"])->pluck('name', 'id')->toArray();
        $countries = Country::pluck('country_name', 'id')->toArray();
        $fonts = Font::orderBy('name', 'asc')->pluck("name", "id");
        return view(
            'bar.bars-form',
            [
                'title' => "Edit Restaurant / Bar",
                "bar" => $bar,
                'users' => $users,
                'countries' => $countries,
                "fonts" => $fonts,
                "formAttributes" => [
                    "url" => route('bars.update', $bar->id),
                    "method" => "PUT",
                    "files" => true,
                    "role" => 'form',
                    "autocomplete" => "off"
                ]
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bar $bar)
    {
        if (!$this->isAuthorized($bar)) {
            abort(401, 'UNAUTHORIZED');
        }
        $this->validate($request, [
            'name' => 'required',
            'slug' => "required|unique:bars,slug,$bar->id",
            'user_id' => 'required|integer',
            'type' => 'required',
            // 'show_brand' => 'required',
            'settings.color.item_name' => 'required',
            'settings.color.item_price' => 'required',
            'settings.color.highlight' => 'required',
            'settings.color.heading' => 'required',
        ], [
            'settings.color.item_name.required' => 'Item Name Color is required',
            'settings.color.item_price.required' => 'Item Price Color is required',
            'settings.color.highlight' => 'Highlight Color is required',
            'settings.color.heading' => 'Heading Color is required',
        ]);

        

        $input = $request->all();

        $input["slug"] = str_replace(' ', '-', strtolower($input["slug"]));

        if (isset($input["logo"]) && !empty($input['logo'])) {
            if ($bar->logo && file_exists(public_path('images/bars/logo/') . $bar->logo)) {
                unlink(public_path('images/bars/logo/') . $bar->logo);
            }
            $fileName = rand() . $input["logo"]->getClientOriginalName();
            $input["logo"]->move(public_path('images/bars/logo/'), $fileName);
            $input["logo"] = $fileName;
        }

        $images = json_decode($bar->images);
        if (isset($input["images"]) && !empty($input["images"])) {
            foreach ($images as $image) {
                if (file_exists(public_path('images/bars/') . $image)) {
                    unlink(public_path('images/bars/') . $image);
                }
            }

            $images = [];

            foreach ($input["images"] as $image) {
                $imageName = rand() . $image->getClientOriginalName();
                $image->move(public_path('images/bars/'), $imageName);
                $images[] = $imageName;
            }
        }

        $input["images"] = json_encode($images);
        $bar->update($input);

        return redirect(route('bars.index'))->with("success", "Bar Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bar  $bar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bar $bar)
    {
        if (!$this->isAuthorized($bar)) {
            abort(401, 'UNAUTHORIZED');
        }
        if ($bar->logo && file_exists(public_path('images/bars/logo/') . $bar->logo)) {
            unlink(public_path('images/bars/logo/') . $bar->logo);
        }
        $images = json_decode($bar->images);
        foreach ($images as $image) {
            if (file_exists(public_path('images/bars/') . $image)) {
                unlink(public_path('images/bars/') . $image);
            }
        }

        $items = Item::where('bar_id', $bar->id)->get();
        foreach ($items as $item) {
            $controller = new \App\Http\Controllers\ItemController;
            $controller->destroy($item);
        }        
        Analytics::where('object_id', $bar->id)->where('type', 'bar')->delete();
        $bar->delete();

        return response()->json(['status' => 1]);
    }

    /// Function to check is user has permission to do action
    public function isAuthorized($bar)
    {
        $user = auth()->user();
        if ($user->role_id <= $this->role["Super Admin"]) {
            return true;
        }
        if ($user->role_id == $this->role["Regional Admin"]) {
            $region = Region::where('id', $user->assigned_id)->first();
            return in_array($bar->country, json_decode($region->country));
        }
        if ($user->role_id == $this->role["National Admin"]) {
            return $bar->country == $user->assigned_id;
        }
        if ($user->role_id == $this->role["Account Admin"]) {
            return $bar->user_id == $user->id;
        }
        if ($user->role_id == $this->role["Bar Admin"]) {
            return $bar->id == $user->assigned_id;
        }

        return false;
    }

    public function getBars(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('logo', function ($bar) {
                $logo = $bar->logo && file_exists(public_path('/images/bars/logo/' . $bar->logo)) ? asset('/public/images/bars/logo/' . $bar->logo) : asset('/public/images/placeholder.png');
                return "<img src='" . $logo . "' height='50' width='50'/>";
            })
            ->editColumn('name', fn ($bar) => $bar->name)
            ->editColumn('city', fn ($bar) => $bar->city)
            ->editColumn('country', function ($bar) {
                return $bar->country_name;
            })
            ->editColumn('status', function ($user) {
                if ($user->status == 1) {
                    return "<label class='badge bg-success'>Approved</label>";
                } else {
                    return "<label class='badge bg-warning'>Not Approved</label>";
                }
            })
            ->editColumn('owner', fn ($bar) => $bar->owner ? $bar->owner->name : 'NIL')
            ->editColumn('created_at', fn ($bar) => Carbon::parse($bar->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($bar) {
                $user = auth()->user();
                $action = "<a href='" . route('items.index') . "?bar=" . $bar->id . "' class='btn btn-outline-primary'>Items</a>  <a href='" . route('bars.edit', $bar->id) . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>";
                if ($user->role_id < $this->role['Account Admin']) {
                    $action .= "  <a href='javascript:;' class='btn btn-outline-danger delete_" . $bar->id . "' data-url='" . route('bars.destroy', $bar->id) . "'  onclick='deleteRecorded(" . $bar->id . ")'><i class='fas fa-trash'></i></a>";
                }
                return $action;
            })
            // ->addColumn('categories_usign_brands', function($bar) use ($request) {
            //     $all_categories = Term::where('type', 'category')->whereNotIn('name', remy_cointreau_brands())->get();                
            //     $brand_ids = Term::where('type', 'brands')->where('name', $request->brand)->pluck("id");
            //     $brands_item_ids = ItemsRelationship::whereIn('term_id', $brand_ids)->pluck("item_id");            

            //     $highest = [
            //         "count" => 0,
            //         "name" => null,
            //     ];

            //     foreach($all_categories as $cat) {
            //         $cat_item_ids = ItemsRelationship::where('term_id', $cat->id)->pluck("item_id");
            //         $intersects = $brands_item_ids->intersect($cat_item_ids);

            //         if($highest['count'] < $intersects->count()) {
            //             $highest = [
            //                 "count" => $intersects->count(),
            //                 "name" => $cat->name,
            //             ];      
            //         }

            //     }

            //     return number_format(($highest['count'] / $all_categories->count())* 100, 2, ".", "") ."% of " . $highest['name'] . " uses ". $request->brand;
            // })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $user = auth()->user();

        $dataTableQuery = Bar::select('bars.*', 'c.country_name')->leftjoin('countries as c', 'c.id', '=', 'bars.country');
        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $dataTableQuery->where('user_id', $user->id);
        }
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $dataTableQuery->where('bars.id', $user->assigned_id);
        }
        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('bars.created_at', [$from, $to]);
        }

        if (isset($input['bar_type']) && $input['bar_type'] != '') {
            $dataTableQuery->where('type', $input['bar_type']);
        }
        if (isset($input['country']) && $input['country'] != '') {
            $dataTableQuery->where('c.country_name', $input['country']);
        }
        if (isset($input['city']) && $input['city'] != '') {
            $dataTableQuery->where('city', $input['city']);
        }

        if (isset($input['category']) && $input['category'] != '') {            
            $term_ids = Term::where('type', 'category')->where('name', $input['category'])->pluck("id");
            $item_ids = ItemsRelationship::whereIn('term_id', $term_ids)->pluck("item_id");            
            $bar_ids = Item::whereIn("id", $item_ids)->pluck("bar_id");
            $dataTableQuery->whereIn('bars.id', $bar_ids);
        }

        if (isset($input['brand']) && $input['brand'] != '') {            
            $term_ids = Term::where('type', 'brands')->where('name', $input['brand'])->pluck("id");
            $item_ids = ItemsRelationship::whereIn('term_id', $term_ids)->pluck("item_id");            
            $bar_ids = Item::whereIn("id", $item_ids)->pluck("bar_id");
            if (isset($input['brand_invert']) && $input['brand_invert'] == "true") {                          
                $dataTableQuery->whereNotIn('bars.id', $bar_ids);
            } else {
                $dataTableQuery->whereIn('bars.id', $bar_ids);
            }                                 
        }        

        return  $dataTableQuery;
    }

    public function download_qr_code($slug)
    {
        $data = [
            'title' => 'Scan this QR Code to visit site.',
            'qrcode' => base64_encode(QrCode::size(300)->generate(route('bar.show', $slug))),
            'url' => config('app.url') . '/' . $slug,
        ];
        $pdf = PDF::loadView('bar.downloadPDF', $data);

        return $pdf->download('QRCode.pdf');
    }
}
