<?php

namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\Item;
use App\Models\Term;
use App\Models\Bar;
use App\Models\ItemsRelationship;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\Region;
use App\Models\Country;

class ItemController extends Controller
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

    // public function getBars()
    // {
    //     $user = auth()->user();
    //     if ($user->role_id == $this->role['Bar Admin']) {
    //         return Bar::where('user_id', $user->id)->where('status', 1)->pluck('name', 'id')->toArray();
    //     } else {
    //         return Bar::pluck('name', 'id')->toArray();
    //     }
    // }

    public function index(Request $request)
    {
        if (isset($request->bar)) {
            // $terms = ItemsRelationship::all();
            $bar = Bar::find($request->bar);
            $barController = new BarController();
            if(!$barController->isAuthorized($bar)) {
                return abort(401, 'UNAUTHORIZED');
            }
            $category = Term::where("type", "category")->pluck("name", "id");
            return view('items.items', [
                'title' => "All Items",
                // 'bars' => $this->getBars(),
                'selectedBar' => $request->bar,
                "category" => $category,
            ]);
        } else {
            return redirect(route('bars.index'))->with("error", "Please Select bar");
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (isset($request->bar)) {
            $terms = Term::where('status', 1)->get();
            return view('items.items-form', [
                'title' => "Create Item",
                'item' => null,
                'terms' => $terms,
                // 'barsList' => $this->getBars(),
                'relationships' => null,
                'selectedBar' => $request->bar,
                'formAttributes' => [
                    'url' => route("items.store"),
                    'method' => "POST",
                    "role" => "form",
                    'files' => true,
                ]
            ]);
        } else {
            return redirect(route('bars.index'))->with("error", "Please Select bar");
        }
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
            'name' => 'required|string',
            // 'slug' => 'required|string|unique:items',
            'drink_id' => 'required',
            // 'brand' => 'required',
            // 'ingredients' => 'required',
            'media_type' => 'required|string',
            'price' => 'required|array',
            'bar_id' => 'required',
        ]);
        $input = $request->all();

        if ($this->createItem($input) == false) {
            return redirect()->back()->withInput($input)->withErrors(["name" => "Name already exist"]);
        }
        return redirect(route('items.index', ['bar' => $request->bar_id]))->with("success", "Item Created Successfully");
    }

    public function slug($name)
    {
        $slug = strtolower($name);
        $slug = preg_replace("/\W+/", "-", $slug); // \W = any "non-word" character
        return trim($slug, "-");
    }

    public function createItem($input)
    {

        $input['slug'] = $this->slug($input['name']);

        $item = Item::where('bar_id', $input['bar_id'])->where('slug', $input['slug'])->count();
        if ($item > 0) {
            return false;
        }

        $input['price'] = json_encode($input['price']);

        $input["slug"] = str_replace(' ', '-', strtolower($input["slug"]));

        if (isset($input["media_type"])) {
            $media = null;
            if ($input["media_type"] == "video" && isset($input["video"]) && !empty($input["video"])) {  // If media is type of video
                $media = rand() . $input["video"]->getClientOriginalName();
                $input["video"]->move(public_path('images/items/'), $media);
                $input["media"] = $media;
            } else if ($input["media_type"] == "image" && isset($input["images"]) && !empty($input["images"])) { // If media is type of Image
                $media = [];
                foreach ($input["images"] as $image) {
                    $imageName = rand() . $image->getClientOriginalName();
                    $image->move(public_path('images/items/'), $imageName);
                    $media[] = $imageName;
                }
                $input["media"] = json_encode($media);
            }
        }

        $item = Item::create($input);

        if (isset($input['ingredients'])) {

            foreach ($input['ingredients'] as $key => $term) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $term == null || $term == '' ? 0 : $term,
                ]);
            }
        }
        // $input['ingredients'] = isset($input['ingredients']) ? $input['ingredients'] : [];
        // $input['ingredient_category'] = isset($input['ingredient_category']) ? $input['ingredient_category'] : [];
        // $input['brand'] = isset($input['brand']) ? $input['brand'] : [];
        // $terms = array_merge($input['ingredients'], $input["ingredient_category"], $input['brand']);

        if (isset($input['ingredient_category']) && !empty($input['ingredient_category'])) {
            foreach ($input['ingredient_category']['cate'] as $row_no => $term) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $term == null || $term == '' ? 0 : $term,
                    'row_no' => $row_no,
                ]);
            }
            foreach ($input['ingredient_category']['brand'] as $brand_row_no => $brand) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $brand == null || $brand == '' ? 0 : $brand,
                    'row_no' => $brand_row_no,
                ]);
            }
            foreach ($input['ingredient_category']['child_brand'] as $child_brand_row_no => $child_brand) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $child_brand == null || $child_brand == '' ? 0 : $child_brand,
                    'row_no' => $child_brand_row_no,
                ]);
            }
        }
        // foreach ($terms as $key => $term) {
        //     ItemsRelationship::create([
        //         'item_id' => $item->id,
        //         'term_id' => $term == null || $term == '' ? 0 : $term,
        //     ]);
        // }

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $bar = null, $item = null)
    {
        if ($bar == null || $item == null) {
            abort(404);
        }
        $item = Item::whereHas('bar', function ($query) use ($bar) {
            $query->where('slug', $bar);
        })->with('bar')->where('slug', $item)->first();
        $bar = Bar::where('slug', $bar)->first();        
        analytics($request, $item->id, 'item', $bar->id); // Item Analytics
        analytics($request, $item->bar_id, 'bar', $bar->id); // Bar Analytics Entry
        analytics($request, $item->drink_id, 'drink', $bar->id); // Category Analytics
        $terms = ItemsRelationship::with('term')->where('item_id', $item->id)->get()->pluck('term');
        // dd($item->drink->name );
        foreach ($terms as $term) {
            if ($term) {
                if($term->type != "brands" || ($item->drink->name == 'Liquors' && $term->type == "brands")) {
                    /**
                     * The above condition is to analyse the brands only from liquors(drink)
                     * 
                     */

                    analytics($request, $term->id, $term->type, $bar->id); /// Ingredients Terms Analytics
                }
            }
        }
        $relationShipCollection = ItemsRelationShip::with('term')->where('item_id', $item->id)->get();
        $selectedCategory = $relationShipCollection->where('term.type', 'category')->pluck("term")->toArray();
        $selectedbrands = $relationShipCollection->where('term.type', 'brands')->pluck("term");
        $related_items = Item::where('bar_id', $item->bar_id)->where('drink_id', $item->drink_id)->where('id', '!=', $item->id)->limit(4)->get();        

        $termRelations = ItemsRelationShip::where('row_no', '!=', 'NULL')->where('item_id', $item->id)->get();
        $selectedBrandsCates = [];
        foreach ($termRelations as $key => $term) {
            $selectedBrandsCates[$term->row_no][] = $term->term;
        }


        if (session('bar_home_url') == url()->previous()) {
            session()->put('lastVisited', session('bar_home_url'));
        } elseif (session('lastVisited') == url()->current()) {
            session()->put('lastVisited', route('bar.items', ['bar' => $bar->slug, 'term' => $item->drink->slug]));
        } else {
            session()->put('lastVisited', url()->previous());
        }
        return view('item-single', [
            'item' => $item,
            'terms' => $terms,
            'related_items' => $related_items,
            'selectedBrands' => $selectedbrands,
            'selectedCategory' => $selectedCategory,
            'selectedBrandsCates' => $selectedBrandsCates,
            'bar' => $bar,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, Request $request)
    {
        if (isset($request->bar)) {
            if (!$this->isAuthorized($item)) {
                abort(401, 'UNAUTHORIZED');
            }
            $terms = Term::where('status', 1)->get();
            // $nonAlcholicIngredients = ItemsRelationShip::with('term')->where('item_id', $item->id)->where('alcholic', 0)->get()->where('term.type', 'ingredients')->pluck("term.id")->toArray();
            $relationShipCollection = ItemsRelationShip::with('term')->where('item_id', $item->id)->get();
            $selectedIngredients = $relationShipCollection->where('term.type', 'ingredients')->pluck("term.id")->toArray();
            // $brandIds = $relationShipCollection->where('term.type', 'brands')->unique('term.id')->pluck("term.id")->toArray();
            // $childBrands = $relationShipCollection->whereIn('term.parent', $brandIds)->unique('term.id')->pluck("term")->toArray();
            // $selectedCategory = $relationShipCollection->skip(count($selectedIngredients))->take(count($selectedIngredients))->pluck('term');
            // $selectedbrands = $relationShipCollection->skip(count($selectedCategory))->take(count($selectedCategory))->pluck('term');
            $selectedCategory = $relationShipCollection->where('term.type', 'category')->pluck("term")->toArray();
            $selectedbrands = $relationShipCollection->where('term.type', '!=', 'brands')->pluck("term");


            $termRelations = ItemsRelationShip::where('row_no', '!=', 'NULL')->where('item_id', $item->id)->get();
            $selectedBrandsCates = [];
            foreach ($termRelations as $key => $term) {
                // if ($term->term_id != 0) {
                $selectedBrandsCates[$term->row_no][] = $term->term;
                // }
            }
            // dd($selectedbrands);
            // $relationships = [];
            // foreach ($relationShipCollection as $relationship) {
            //     $relationships[] = $relationship->term_id;
            // }
            // sort($selectedBrandsCates);


            return view('items.items-form', [
                'title' => "Edit Item",
                'item' => $item,
                'terms' => $terms,
                // 'barsList' => $this->getBars(),
                // 'relationships' => $relationships,
                // 'brandIds' => $brandIds,
                // 'childBrands' => $childBrands,
                'selectedBrands' => $selectedbrands,
                'selectedCategory' => $selectedCategory,
                'selectedIngredients' => $selectedIngredients,
                'selectedBrandsCates' => $selectedBrandsCates,
                // 'nonAlcholicIngredients' => $nonAlcholicIngredients,
                'selectedBar' => $request->bar,
                'formAttributes' => [
                    'url' => route("items.update", $item->id),
                    'method' => "PUT",
                    "role" => "form",
                    'files' => true,
                ]
            ]);
        } else {
            return redirect(route('bars.index'))->with("error", "Please Select bar");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        if (!$this->isAuthorized($item)) {
            abort(401, 'UNAUTHORIZED');
        }
        $this->validate($request, [
            'name' => 'required|string',
            // 'slug' => "required|string|unique:items,slug,$item->id",
            'drink_id' => 'required',
            // 'brand' => 'required',
            // 'ingredients' => 'required',
            'media_type' => 'required|string',
            'price' => 'required|array',
        ]);

        $input = $request->all();

        $input['slug'] = $this->slug($input['name']);
        $checkitem = Item::where('bar_id', $input['bar_id'])->where('slug', $input['slug'])->where('id', '!=', $item->id)->count();
        if ($checkitem > 0) {
            return redirect()->back()->withInput($input)->withErrors(["name" => "Name already exist"]);
        }

        $input['price'] = json_encode($input['price']);

        $input["media"] = $item->media;
        if (isset($input["media_type"])) {
            $media = null;
            if ($input["media_type"] == "video" && isset($input["video"]) && !empty($input["video"])) {  // If media is type of video
                $this->delete_old_media($item);
                $media = rand() . $input["video"]->getClientOriginalName();
                $input["video"]->move(public_path('images/items/'), $media);
                $input["media"] = $media;
            } else if ($input["media_type"] == "image" && isset($input["images"]) && !empty($input["images"])) { // If media is type of Image
                $this->delete_old_media($item);
                $media = [];
                foreach ($input["images"] as $image) {
                    $imageName = rand() . $image->getClientOriginalName();
                    $image->move(public_path('images/items/'), $imageName);
                    $media[] = $imageName;
                }
                $input["media"] = json_encode($media);
            }
        }

        $item->update($input);

        // $brands = array_map(function($val) {
        //     if($val == '') {
        //         $val = 0;
        //     }
        //     return $val;
        // },$input['brand']);

        // $terms = array_merge([$input["category"]], $input['ingredients'], $brands);
        $input['ingredients'] = isset($input['ingredients']) ? $input['ingredients'] : [];
        // $input['ingredient_category'] = isset($input['ingredient_category']) ? $input['ingredient_category'] : [];
        // $input['brand'] = isset($input['brand']) ? $input['brand'] : [];
        // $terms = array_merge($input['ingredients'], $input["ingredient_category"], $input['brand']);


        ItemsRelationship::where('item_id', $item->id)->delete();

        foreach ($input['ingredients'] as $key => $term) {
            ItemsRelationship::create([
                'item_id' => $item->id,
                'term_id' => $term == null || $term == '' ? 0 : $term,
            ]);
        }

        // if(isset($input['non_alcholic_ingredients']) && $input['non_alcholic_ingredients'] != '') {
        //     foreach($input['non_alcholic_ingredients'] as $term) {
        //         ItemsRelationship::create([
        //             'item_id' => $item->id,
        //             'term_id' => $term == null || $term == '' ? 0 : $term ,
        //             'alcholic' => 0,
        //         ]);
        //     }
        // }


        if (isset($input['ingredient_category']) && !empty($input['ingredient_category'])) {
            foreach ($input['ingredient_category']['cate'] as $row_no => $term) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $term == null || $term == '' ? 0 : $term,
                    'row_no' => $row_no,
                ]);
            }
            foreach ($input['ingredient_category']['brand'] as $brand_row_no => $brand) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $brand == null || $brand == '' ? 0 : $brand,
                    'row_no' => $brand_row_no,
                ]);
            }
            foreach ($input['ingredient_category']['child_brand'] as $child_brand_row_no => $child_brand) {
                ItemsRelationship::create([
                    'item_id' => $item->id,
                    'term_id' => $child_brand == null || $child_brand == '' ? 0 : $child_brand,
                    'row_no' => $child_brand_row_no,
                ]);
            }
        }

        // foreach ($terms as $key => $term) {
        //     ItemsRelationship::create([
        //         'item_id' => $item->id,
        //         'term_id' => $term == null || $term == '' ? 0 : $term,
        //     ]);
        // }
        $url = route('items.index') . '?bar=' . $request->bar_id . '';
        return redirect($url)->with("success", "Item Created Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if (!$this->isAuthorized($item)) {
            abort(401, 'UNAUTHORIZED');
        }
        $this->delete_old_media($item);
        ItemsRelationship::where('item_id', $item->id)->delete();
        Analytics::where('object_id', $item->id)->where('type', 'item')->delete();
        $item->delete();        

        return response()->json(['status' => 1]);
    }

    public function delete_old_media($item)
    {
        if (isset($item->media_type)) {
            if ($item->media_type == 'image') {
                if (!empty($item->media)) {
                    $images = json_decode($item->media);
                    foreach ($images as $image) {
                        if (file_exists(public_path('/images/items/' . $image))) {
                            unlink(public_path('/images/items/' . $image));
                            // echo public_path('/images/items/'.$image);
                        }
                    }
                }
            } else if ($item->media_type == "video") {
                if (!empty($item->media)) {
                    if (file_exists(public_path('/images/items/' . $item->media))) {
                        unlink(public_path('/images/items/' . $item->media));
                    }
                }
            }
        }
    }

    /// Function to check is user has permission to do action
    public function isAuthorized($item)
    {
        $user = auth()->user();
        // if ($user->role_id != 1 && $user->role_id != 2 && $item->bar->user_id != $user->id) {
        //     return false;
        // }
        if ($user->role_id <= $this->role["Super Admin"]) {
            return true;
        }
        if ($user->role_id == $this->role["Regional Admin"]) {
            $region = Region::where('id', $user->assigned_id)->first();
            return in_array($item->bar->country, json_decode($region->country));
        }
        if ($user->role_id == $this->role["National Admin"]) {
            return $item->bar->country == $user->assigned_id;
        }
        if ($user->role_id == $this->role["Account Admin"]) {
            return $item->bar->user_id == $user->id;
        }
        if ($user->role_id == $this->role["Bar Admin"]) {
            return $item->bar->id == $user->assigned_id;
        }

        return false;
    }

    public function getItemCategoryAndIngredients(Request $request)
    {
        $categories = Term::where('bar_id', $request->bar_id)->where('type', 'category')->pluck('name', 'id')->where('status', 1)->toArray();
        $ingredients = Term::where('bar_id', $request->bar_id)->where('type', 'ingredients')->pluck('name', 'id')->where('status', 1)->toArray();
        $data = view('bar-categories-ingredients', compact('categories', 'ingredients'))->render();
        return response()->json(['data' => $data]);
    }

    public function getItems(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('name', fn ($item) => $item->name)
            ->editColumn('drink', function ($item) {

                return $item->drink && isset($item->drink->name) ? $item->drink->name : 'N/A';
                // $categoriesCollection = $item->getTerms()->category;
                // $categories = '';
                // if (!empty($categoriesCollection)) {
                //     foreach ($categoriesCollection as $index => $category) {
                //         $categories .= $category->name;
                //         if (sizeof($categoriesCollection) - 1 > $index) {
                //             $categories .= ', ';
                //         }
                //     }
                // }
                // return $categories;
            })
            ->editColumn('ingredients', function ($item) {
                $ingredientCollection = $item->getTerms()->ingredients;
                $ingredients = '';
                if (!empty($ingredientCollection)) {
                    foreach ($ingredientCollection as $index => $ingredient) {
                        $ingredients .= $ingredient->name;
                        if (sizeof($ingredientCollection) - 1 > $index) {
                            $ingredients .= ', ';
                        }
                    }
                }
                return $ingredients;
            })
            ->editColumn('price', function ($item) {
                return getItemPriceRange($item);
            })
            ->editColumn('created_at', fn ($item) => Carbon::parse($item->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($item) {
                return "<a href='" . route('items.edit', $item->id) . "?bar=" . $item->bar_id . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>
                <a href='javascript:;' class='btn btn-outline-danger delete_" . $item->id . "' data-url='" . route('items.destroy', $item->id) . "'  onclick='deleteRecorded(" . $item->id . ")'><i class='fas fa-trash'></i></a>";
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $dataTableQuery = Item::select('items.*', 'terms.name as category')->leftjoin('terms', 'terms.id', '=', 'items.drink_id')->where('items.status', 1);

        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('items.created_at', [$from, $to]);
        }        

        $bar_id = isset($input['bar_id']) ? $input["bar_id"] : null;
        $dataTableQuery->where('bar_id', $bar_id);

        if (isset($input['category']) && $input['category'] != '') {            
            $term_ids = Term::where('type', 'category')->where('name', $input['category'])->pluck("id");
            $item_ids = ItemsRelationship::whereIn('term_id', $term_ids)->pluck("item_id");                        
            $dataTableQuery->whereIn('items.id', $item_ids);                        
        }

        if (isset($input['brand']) && $input['brand'] != '') {            
            $term_ids = Term::where('type', 'brands')->where('name', $input['brand'])->pluck("id");
            $item_ids = ItemsRelationship::whereIn('term_id', $term_ids)->pluck("item_id");                        
            if (isset($input['brand_invert']) && $input['brand_invert'] == "true") {                          
                $dataTableQuery->whereNotIn('items.id', $item_ids);
            } else {
                $dataTableQuery->whereIn('items.id', $item_ids);
            }    
            
        }


        return  $dataTableQuery;
    }
}
