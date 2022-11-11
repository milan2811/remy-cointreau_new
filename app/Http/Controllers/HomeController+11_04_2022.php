<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\User;
use App\Models\Term;
use App\Models\Item;
use App\Models\ItemsRelationship;
use App\Models\Promotion;
use App\Models\Analytics;
use App\Models\Country;
use App\Models\Region;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $role;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->role = roles();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->has('search') ? $request->search : '';
        $categories = Term::where('type', 'category')->where('name', 'LIKE', "%$search%")->where('status', 1)->orderBy('created_at', 'desc')->get();
        $items = Item::where('name', 'LIKE', "%$search%")->where('status', 1)->get();
        $promotions = Promotion::orderBy('created_at', 'desc')->get();
        return view('home', ['categories' => $categories, 'items' => $items, 'promotions' => $promotions]);
    }

    // get category items
    public function items(Term $term, Request $request)
    {
    
        analytics($request, $term->id, $term->type);
        $search = $request->has('search') ? $request->search : '';
        $ingredient = $request->has('ingredients') ?  Term::where("slug", $request->ingredients)->first() : null;

        // $items = ItemsRelationship::whereHas('items', function($query) use($search) {
        //     $query->where('name', 'LIKE', "%$search%");            
        // })->with('items')->where('term_id', $term->id)->distinct('item_id');
        // $items = $items->has('term')->orderBy('id', 'desc')->get()->pluck('items');

        // $item_ids = ItemsRelationship::where('term_id', $term->id)->pluck("item_id");    

        // if($ingredients || isset($request->ingredients)) {        

        //     $ids = null;    
        //     if($ingredients) {
        //         $ids = $ingredients->getAssignTerms->pluck("item_id")->toArray();
        //     }
        //     $item_ids = $item_ids->intersect($ids);             
        // }        
        // // dd($ingredients);
        $ingredient_item_ids = $ingredient ? ItemsRelationship::where('term_id', $ingredient->id)->pluck('item_id') : null;
        $items = Item::where('category_id', $term->id)->where('bar_id', $request->bar_id)->where('name', 'LIKE', "%$search%");
        if ($ingredient_item_ids) {
            $items = $items->whereIn('id', $ingredient_item_ids);
        }
        $items = $items->where('status', 1)->orderBy('id', 'desc')->get();


        $categories = Term::where('type', 'category')->where('id', '!=', $term->id)->where('status', 1)->orderBy('created_at', 'desc')->limit(4)->get();

        return view('items', ['items' => $items, 'category' => $term, 'categories' => $categories]);
    }

    public function BarItems(Bar $bar, $term = null, Request $request)
    {

        if (!$bar) {
            return redirect()->back()->with('error', "No Bar Found");
        }
        analytics($request, $bar->id, 'bar');
        if (isset($term) && $term) {
            $term = Term::where('slug', $term)->first();
            analytics($request, $term->id, $term->type);
        }
        $search = $request->has('search') ? $request->search : '';
        $ingredient = $request->has('ingredients') ?  Term::where("slug", $request->ingredients)->first() : null;

        // $items = ItemsRelationship::whereHas('items', function($query) use($search) {
        //     $query->where('name', 'LIKE', "%$search%");            
        // })->with('items')->where('term_id', $term->id)->distinct('item_id');
        // $items = $items->has('term')->orderBy('id', 'desc')->get()->pluck('items');

        // $item_ids = ItemsRelationship::where('term_id', $term->id)->pluck("item_id");    
        // if($ingredients || isset($request->ingredients)) {        
        //     $ids = null;    
        //     if($ingredients) {
        //         $ids = $ingredients->getAssignTerms->pluck("item_id")->toArray();
        //     }
        //     $item_ids = $item_ids->intersect($ids);             
        // }
        // dd($ingredients);
        $ingredient_item_ids = $ingredient ? ItemsRelationship::where('term_id', $ingredient->id)->pluck('item_id') : [];

        $items = Item::where('bar_id', $bar->id)->where('name', 'LIKE', "%$search%");
        if ($term) {
            $items->where('category_id', $term->id);
        }
        $ingredients = collect([]);
        foreach ($items->get() as $item) {
            $terms = $item->getTerms();
            $ingredients = $ingredients->merge($terms->ingredients)->unique(); 
            $ingredients = $ingredients->merge($terms->category)->unique(); 

            // if (!empty($ingredientCollection)) {
            //     foreach ($ingredientCollection as $index => $ingredient) {
            //         $ingredients[$ingredient->id] = $ingredient;
            //     }
            // }

            // $categoryCollection = $item->getTerms()->category;
            // if (!empty($categoryCollection)) {
            //     foreach ($categoryCollection as $index => $ingredient) {
            //         $ingredients[$ingredient->id] = $ingredient;
            //     }
            // }
        }
        if ($ingredient_item_ids || $request->has('ingredients')) {
            $items = $items->whereIn('id', $ingredient_item_ids);
        }
        $items = $items->where('status', 1)->orderBy('id', 'desc')->get();

        $item_ids = Item::where('bar_id', $bar->id)->pluck('category_id')->toArray();
        $categories = Term::where('type', 'category')->whereIn('id', $item_ids)->where('id', '!=', $term->id)->orderBy('created_at', 'desc')->where('status', 1)->limit(4)->get();

        return view('items', ['items' => $items, 'category' => $term, 'categories' => $categories, 'bar' => $bar, 'ingredients' => $ingredients]);
    }

    public function dashboard(Request $request)
    {
        // $least_viewed = Analytics::with('item')->where('type', 'item')->orderBy('total_count', 'asc')->get()->unique("object_id");
        // $most_viewed_category = Analytics::with('term')->where('type', 'category')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_category = Analytics::with('term')->where('type', 'category')->orderBy('total_count', 'asc')->get()->unique("object_id");
        // $most_viewed_ingredients = Analytics::with('term')->where('type', 'ingredients')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_ingredients = Analytics::with('term')->where('type', 'ingredients')->orderBy('total_count', 'asc')->get()->unique("object_id");                
        // $most_viewed_brands = Analytics::with('term')->where('type', 'brands')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_brands = Analytics::with('term')->where('type', 'brands')->orderBy('total_count', 'asc')->get()->unique("object_id");                        

        ///////////////////////////////////// OPTIMIZED 2 /////////////////////////
        // // Items 
        // $items = Analytics::with('item')->where('type', 'item')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $most_viewed = $items->take(5);        
        // $least_viewed = $items->reverse()->take(5);

        // // Terms
        // $terms = Analytics::with('term')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $most_viewed_category = $terms->where('type', 'category')->take(5);
        // $least_viewed_category = $terms->where('type', 'category')->reverse()->take(5);
        // $most_viewed_ingredients = $terms->where('type', 'ingredients')->take(5);
        // $least_viewed_ingredients = $terms->where('type', 'ingredients')->reverse()->take(5);
        // $most_viewed_brands = $terms->where('type', 'brands')->take(5);
        // $least_viewed_brands = $terms->where('type', 'brands')->reverse()->take(5);

        ////////////////////////////////// OPTIMIZED 3 ?//////////////////////////////
        // // Items 
        // $total_items = Analytics::where('type', 'item')->distinct()->count("object_id");
        // $items = Analytics::select("id", "total_count","object_id" )->with('item')->where('type', 'item')->orderBy('id', 'desc')->orderBy('total_count', 'desc')->get()->unique("object_id");         
        // dd($items);

        // $most_viewed = $items->limit(5)->get()->unique("object_id");
        // $least_viewed = $items->skip($total_items - 5)->get()->reverse()->unique("object_id");
        // // Terms        
        // $total_category = Analytics::where('type', 'category')->count();
        // $categories = Analytics::with('term')->where('type', 'category')->orderBy('total_count', 'desc');
        // $most_viewed_category = $categories->limit(5)->get()->unique("object_id");
        // // dd($categories->skip($total_category - 5)->get());
        // $least_viewed_category = $categories->skip($total_category - 5)->get()->unique("object_id")->reverse();

        // $total_ingredients = Analytics::where('type', 'ingredients')->count();
        // $ingredients = Analytics::with('term')->where('type', 'ingredients')->orderBy('total_count', 'desc');
        // $most_viewed_ingredients = $ingredients->limit(5)->get()->unique("object_id");
        // $least_viewed_ingredients = $ingredients->skip($total_ingredients - 5)->get()->unique("object_id")->reverse();

        // $total_brands = Analytics::where('type', 'brands')->count();
        // $brands = Analytics::with('term')->where('type', 'brands')->orderBy('total_count', 'desc');
        // $most_viewed_brands = $brands->limit(5)->get()->unique("object_id");
        // $least_viewed_brands = $brands->skip($total_brands - 5)->get()->unique("object_id")->reverse();

        // Bars
        // $busiest_hours = Analytics::where("created_at", ">=", date("Y-m-d", strtotime("-1 Week")))->orderBy("count", "desc")->first();        
        // $least_busiest_hours = Analytics::where("created_at", ">=", date("Y-m-d", strtotime("-1 Week")))->orderBy("count", "asc")->first(); 

        // $bar_analtics = Analytics::with('bar')->where("type", "bar")->orderBy("total_count", "desc")->get()->unique("object_id");
        // $popular_cities = [];
        // $popular_countries = [];
        // foreach($bar_analtics as $analytics) {
        //     if(isset($popular_countries[$analytics->bar->country])) {
        //         $popular_countries[$analytics->bar->country] = $popular_countries[$analytics->bar->country] + 1;
        //     } else {
        //         $popular_countries[$analytics->bar->country] = 1;
        //     }            

        //     if(isset($popular_cities[$analytics->bar->city])) {
        //         $popular_cities[$analytics->bar->city] = $popular_cities[$analytics->bar->city] + 1;
        //     } else {
        //         $popular_cities[$analytics->bar->city] = 1;
        //     }                        
        // }        
        // arsort($popular_cities);
        // arsort($popular_countries);                    

        $user = auth()->user();

        if ($user->role_id == $this->role['Super Admin'] || $user->role_id == $this->role['Froztech Admin']) {
            $bars = Bar::count();
            $owners = User::where("role_id", $this->role['Bar Admin'])->count();
            $items = Item::all();
        }
        if ($user->role_id == $this->role['Regional Admin']) {
            $region = Region::where('id', $user->assigned_id)->first();
            $country_Ids = json_decode($region->country);
            $bar_ids = Bar::whereIn("country", $country_Ids)->pluck("id");
            $bars = count($bar_ids);
            $items = Item::whereIn('bar_id', $bar_ids)->where('status', 1);
        }
        if ($user->role_id == $this->role['National Admin']) {
            $bar_ids = Bar::where("country", $user->assigned_id)->pluck("id");
            $bars = count($bar_ids);
            $items = Item::whereIn('bar_id', $bar_ids)->where('status', 1);
        }
        if ($user->role_id == $this->role['Bar Owner']) {
            $bar_ids = Bar::where("user_id", $user->id)->pluck("id");
            $bars = count($bar_ids);
            $items = Item::whereIn('bar_id', $bar_ids)->where('status', 1);
        }
        if ($user->role_id >= $this->role['Bar Admin']) {
            $items = Item::where('bar_id', $user->assigned_id)->where('status', 1);
        }
        // else {
        //     $bar_ids = Bar::where("user_id", $user->id)->pluck("id");
        //     $bars = count($bar_ids);
        //     $items = Item::whereIn('bar_id', $bar_ids)->where('status', 1)->count();
        // }        

        $term_ids = ItemsRelationship::whereIn('item_id', $items->pluck('id'))->distinct()->pluck('term_id')->toArray();
        $terms = Term::whereIn('id', $term_ids)->where('status', 1)->get();
        $category = $terms->where("type", "category")->count();
        $ingredients = $terms->where("type", "ingredients")->count();
        $brands = $terms->where("type", "brands")->count();

        return view('dashboard', [
            'title' => "Tablero de mandos",
            'owners' => isset($owners) ? $owners : null,
            'bars' => isset($bars) ? $bars : null,
            'category' => isset($category) ? $category : null,
            'ingredients' => isset($ingredients) ? $ingredients : null,
            "brands" => isset($brands) ? $brands : null,
            "items" => isset($items) ? $items->count() : null,
        ]);
    }
}
