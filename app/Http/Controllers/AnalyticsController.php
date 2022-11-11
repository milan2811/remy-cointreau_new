<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analytics;
use App\Models\Bar;
use App\Models\Country;
use App\Models\Region;
use App\Models\Item;
use App\Models\Term;
use App\Models\ItemsRelationship;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;


class AnalyticsController extends Controller
{

    public $role;

    public function __construct()
    {
        $this->role = roles();
    }

    public function getAllBarsAndLocations($request) {
        $user = auth()->user();

        // Get All Bars
        $bars = Bar::select("name", "id", 'country', "city"); // select all bars
        // $allBars = $bars->pluck('country')->unique(); /// pluck all unique allBars from bars
        $countries = null;
        $allRegion = Region::pluck('description', 'id')->toArray(); /// pluck all regions
        if (isset($request->region)) {
            $region = Region::find($request->region);
            $countries = Country::whereIn('id', json_decode($region->country, true))->pluck('country_name', 'id')->toArray();
            $bars = $bars->whereIn('country', array_keys($countries));            
        }
        else if ($user->role_id == $this->role["Account Admin"]) {   /// role based filter
            $bars = $bars->where('user_id', $user->id);
            $countries = Country::whereIn('id', $bars->pluck('country'))->pluck('country_name', 'id')->toArray();
        }
        else if($user->role_id == $this->role['Regional Admin']) {
            $region = Region::find($user->assigned_id);
            $countries = Country::whereIn('id', json_decode($region->country, true))->get();
            $bars = $bars->whereIn('country', $countries->pluck('id'));
            $countries = $countries->pluck('country_name', 'id')->toArray();
        }
        else if($user->role_id == $this->role['National Admin']) {
            $countries = Country::where('id', $user->assigned_id)->pluck('country_name', 'id')->toArray();
            $bars = $bars->where('country', $user->assigned_id);
        }
        else {
            $allBars = $bars->pluck('country')->unique()->toArray();
            $countries = Country::whereIn('id', $allBars)->pluck('country_name', 'id')->toArray();
        }

        if (isset($request->country) && $request->country != '') { /// filter based on country and city
            $bars = $bars->where('country', $request->country);
        }
        $allCities = $bars->pluck('city')->unique(); /// pluck all unique allCities from bars

        if (isset($request->city) && $request->city != '') {
            $bars = $bars->where('city', $request->city); // get bars where city = city
        }
        $bars = $bars->where('status', 1)->pluck('name', 'id')->toArray();  /// convert to array
        return [
            // "allBars" => $allBars,
            "allCities" => $allCities,
            "allRegion" => $allRegion,
            "countries" => $countries,
            "bars" => $bars,
        ];
    }

    public function getBarsIds($request) {
        $user = auth()->user();
        $bar_ids = null; /// initialize bar_ids to analyze
        if ($user->role_id == $this->role["Account Admin"]) {
            $bar_ids = Bar::where("user_id", $user->id);
        } else if($user->role_id == $this->role["Bar Admin"]) {
            $bar_ids = Bar::where("id", $user->assigned_id);
        } else if($user->role_id == $this->role['National Admin']) {
            $country = Country::where('id', $user->assigned_id)->first();
            $bar_ids = Bar::where("country", $country->id);
        } else if($user->role_id == $this->role['Regional Admin']) {
            $region = Region::where('id', $user->assigned_id)->first();
            $countryIds = json_decode($region->country);
            $bar_ids = Bar::whereIn("country", $countryIds);
        } else {
            $bar_ids = Bar::select("id");
            // if (isset($request->country) || isset($request->bar) || isset($request->city)) {
                // if (isset($request->country)) {
                //     $bar_ids = $bar_ids->where("country", $request->country); // where country
                // }
                // if (isset($request->city)) {
                //     $bar_ids = $bar_ids->where("city", $request->city); // where city = city
                // }
                // if (isset($request->bar)) {
                //     $bar_ids = $bar_ids->where("id", $request->bar); // where bar = selected bar
                // }
                // $bar_ids = $bar_ids->where('status', 1)->pluck("id")->toArray(); // bar ids to array
            // }
        }
        if (isset($request->region)) {
            $region = Region::where('id', $request->region)->first();
            $countryIds = json_decode($region->country);
            $bar_ids = $bar_ids->whereIn("country", $countryIds);
        }
        if (isset($request->country)) {
            $bar_ids = $bar_ids->where("country", $request->country); // where country
        }
        if (isset($request->city)) {
            $bar_ids = $bar_ids->where("city", $request->city); // where city = city
        }
        if (isset($request->bar)) {
            $bar_ids = $bar_ids->where("id", $request->bar); // where bar = selected bar
        }
        $bar_ids = $bar_ids->pluck("id")->toArray(); // bar ids to array

        return $bar_ids;
    }

    public function activity(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request);

        $busiest_hours = Analytics::where("created_at", ">=", date("Y-m-d", strtotime("-1 Week")));
        
        $busiest_hours = $busiest_hours->where("type", "bar")->whereIn("object_id", $bar_ids);
        
        $busiest_hours = $busiest_hours
            ->selectRaw("*,sum(count) as sum, DATE_FORMAT(created_at, '%T') as hours")
            ->orderBy("sum", "desc")
            ->groupBy("hours")
            ->pluck("sum", "hours");
        $hours = [
            '00:00:00' => "0",
            '01:00:00' => "0",
            '02:00:00' => "0",
            '03:00:00' => "0",
            '04:00:00' => "0",
            '05:00:00' => "0",
            '06:00:00' => "0",
            '07:00:00' => "0",
            '08:00:00' => "0",
            '09:00:00' => "0",
            '10:00:00' => "0",
            '11:00:00' => "0",
            '12:00:00' => "0",
            '13:00:00' => "0",
            '14:00:00' => "0",
            '15:00:00' => "0",
            '16:00:00' => "0",
            '17:00:00' => "0",
            '18:00:00' => "0",
            '19:00:00' => "0",
            '20:00:00' => "0",
            '21:00:00' => "0",
            '22:00:00' => "0",
            '23:00:00' => "0",
        ];
        $busiest_hours = array_merge($hours, $busiest_hours->toArray());


        $bar_analtics = Analytics::with('bar')->whereIn('object_id', array_keys($all['bars']))->where("type", "bar")->orderBy("total_count", "desc")->get()->unique("object_id");
        $popular_cities = [];
        $popular_countries = [];
        foreach ($bar_analtics as $analytics) {
            if (isset($popular_countries[$analytics->bar->getCountry->country_name])) {
                $popular_countries[$analytics->bar->getCountry->country_name] = $popular_countries[$analytics->bar->getCountry->country_name] + 1;
            } else {
                $popular_countries[$analytics->bar->getCountry->country_name] = 1;
            }

            if (isset($popular_cities[$analytics->bar->city])) {
                $popular_cities[$analytics->bar->city] = $popular_cities[$analytics->bar->city] + 1;
            } else {
                $popular_cities[$analytics->bar->city] = 1;
            }
        }

        arsort($popular_cities);
        arsort($popular_countries);

        return view('analytics.index', [
            'title' => "Activity",
            // "allBars" => $all['allBars'],
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "busiest_hours" => $busiest_hours,
            'popular_cities' => $popular_cities,
            'popular_countries' => $popular_countries,
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);
    }

    public function items(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request);  //get bar ids based on the filters and roles

        // Items
        $items = Analytics::whereHas('item', function ($query) use ($bar_ids, $request) {
            if (is_array($bar_ids)) {
                $query->whereIn("bar_id", $bar_ids);
            }
            if (isset($request->search) || $request->search != '') {
                $query->where("name", 'LIKE', "%$request->search%");
            }
        })->with('item')->where('type', 'item')->orderBy('total_count', 'desc')->get()->unique("object_id");
        if(isset($request->search)) {
            $otherItems = Item::whereNotIn('id', $items->pluck('object_id'))->whereIn('bar_id', $bar_ids)->where('name', 'LIKE', "%$request->search%")->get();
            foreach ($otherItems as $key => $item) {            
                $c = new Analytics([                
                    "object_id" => $item->id,
                    "count" => 0,                 
                    "total_count" => 0,
                    "item" => $item,         
                ]);
                $items->push($c);
            }        
        }
        $most_viewed = $items->take(5);
        $least_viewed = $items->reverse()->take(5);

        return view('analytics.index', [
            'title' => "Analyics",
            // "allBars" => $all['allBars'],
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            'most_viewed' => $most_viewed,
            'least_viewed' => $least_viewed,
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);
    }

    public function drinks(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request); //get bar ids based on the filters and roles        
        $analytics = Analytics::whereIn('bar_id', $bar_ids)->where('type', 'drink')->get();
        $drink_ids = $analytics->unique('object_id')->pluck('object_id');
        $drinks = collect([]);
        foreach($drink_ids as $index=>$drink_id) {
            $d = $analytics->where('object_id', $drink_id)->first();
            $d->total_count = $analytics->where('object_id', $drink_id)->sum('count');
            $drinks->push($d);
        } 
        // foreach($bars_slugs as $slug) {
        //     $analytics_id = array_merge($analytics_id, Analytics::where('page_url', 'LIKE', "%$slug%")->where('type', 'drink')->pluck('id')->toArray());
        // }
        


        // Terms
        // $terms = $analytics_id ? Analytics::with('term')->whereIn('id', $analytics_id)->orderBy('total_count', 'desc')->where('type', 'drink')->get()->unique("object_id") : null;
        $most_viewed_drinks = $drinks ? $drinks->sortByDesc('total_count')->take(5) : null;
        $least_viewed_drinks = $drinks ? $drinks->sortBy('total_count')->take(5) : null;

        return view('analytics.index', [
            'title' => "Drinks Analytics",
            'most_viewed_drinks' => $most_viewed_drinks,
            'least_viewed_drinks' => $least_viewed_drinks,
            // "allBars" => $all['allBars'],
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);

    }

    public function category(Request $request) {
        // Terms
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request); //get bar ids based on the filters and roles        
        $analytics = Analytics::whereIn('bar_id', $bar_ids)->where('type', 'category')->get();
        $cat_ids = $analytics->unique('object_id')->pluck('object_id');
        $category = collect([]);
        foreach($cat_ids as $index=>$catID) {
            $c = $analytics->where('object_id', $catID)->first();
            $c->total_count = $analytics->where('object_id', $catID)->sum('count');
            $category->push($c);
        }        
        $most_viewed_category = $category ? $category->sortByDesc('total_count')->take(5) : null;
        $least_viewed_category = $category ? $category->sortBy('total_count')->take(5) : null;        

        return view('analytics.index', [
            'title' => "Category Analytics",
            'most_viewed_category' => $most_viewed_category,
            'least_viewed_category' => $least_viewed_category,
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);

    }
    public function ingredients(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request); //get bar ids based on the filters and roles        
        $analytics = Analytics::whereIn('bar_id', $bar_ids)->where('type', 'ingredients')->get();
        $ingredients_ids = $analytics->unique('object_id')->pluck('object_id');
        $ingredients = collect([]);
        foreach($ingredients_ids as $index=>$drink_id) {
            $d = $analytics->where('object_id', $drink_id)->first();
            $d->total_count = $analytics->where('object_id', $drink_id)->sum('count');
            $ingredients->push($d);
        }        
        $most_viewed_ingredients = $ingredients ? $ingredients->sortByDesc('total_count')->take(5) : null;
        $least_viewed_ingredients = $ingredients ? $ingredients->sortBy('total_count')->take(5) : null;       

        return view('analytics.index', [
            'title' => "Ingredients Analyics",
            'most_viewed_ingredients' => $most_viewed_ingredients,
            'least_viewed_ingredients' => $least_viewed_ingredients,
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);
    }
    public function brands(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request); //get bar ids based on the filters and roles        
        $analytics = Analytics::whereIn('bar_id', $bar_ids)->where('type', 'brands')->get();
        $brand_ids = $analytics->unique('object_id')->pluck('object_id');
        $brands = collect([]);
        foreach($brand_ids as $index=>$drink_id) {
            $d = $analytics->where('object_id', $drink_id)->first();
            $d->total_count = $analytics->where('object_id', $drink_id)->sum('count');
            $brands->push($d);
        }        
        $most_viewed_brands = $brands ? $brands->sortByDesc('total_count')->take(5) : null;
        $least_viewed_brands = $brands ? $brands->sortBy('total_count')->take(5) : null;

        return view('analytics.index', [
            'title' => "Liqueurs Brands Analyics",
            'most_viewed_brands' => $most_viewed_brands,
            'least_viewed_brands' => $least_viewed_brands,
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
        ]);
    }

    public function cointreau_brands(Request $request) {
        $all = $this->getAllBarsAndLocations($request);
        $bar_ids = $this->getBarsIds($request); //get bar ids based on the filters and roles                
        $category = Term::where("type", "category")->pluck("name", "id");
        $cointreau_brands = Term::where("type", "brands")->whereIn("name", remy_cointreau_brands())->pluck("name", "id");

        $cat_item_ids = collect();
        if(isset($request->cat_id) && $request->cat_id) {
            $ids = ItemsRelationship::where('term_id', $request->cat_id)->pluck('item_id');
            $cat_item_ids =  Item::whereIn('id', $ids)->whereIn('bar_id', $bar_ids)->pluck("id");

            // Show only related contreau brands
            $contreau_ids = Term::where("type", "brands")->whereIn('name', remy_cointreau_brands())->pluck('id');
            $cointreau_brands = Term::whereIn('id', 
            ItemsRelationship::whereIn('item_id', $ids)->whereIn('term_id', $contreau_ids)->groupBy("term_id")->pluck("term_id"))
            ->pluck("name", "id");            
        }

        $brand_item_ids = collect();
        if(isset($request->brand_id) && $request->brand_id) {            
            $ids = ItemsRelationship::where('term_id', $request->brand_id)->pluck('item_id');            
            $brand_item_ids = Item::whereIn('id', $ids)->whereIn('bar_id', $bar_ids)->pluck("id");
        }

        $response = null;
        $percentage = 100;
        
        if($cat_item_ids->count() && $brand_item_ids->count()) {
            $item_ids = $cat_item_ids->intersect($brand_item_ids);        

            $items = Item::whereIn("id", $item_ids)->whereIn('bar_id', $bar_ids)->count();
            
            // For Testing and verifications
            // Print the items which has the categories
            // foreach(Item::whereIn("id", $cat_item_ids)->whereIn('bar_id', $bar_ids)->get() as $i) {                
            //     echo '<a href="'.route("items.edit", $i->id).'?bar='.$i->bar_id.'" style="color:blue">'.$i->name ."</a><br>";
            // }

            // Print the items which has theses categories and brands both
            // foreach(Item::whereIn("id", $item_ids)->whereIn('bar_id', $bar_ids)->get() as $i) {                
            //     echo '<a href="'.route("items.edit", $i->id).'?bar='.$i->bar_id.'">'.$i->name ."</a><br>";
            // }

            $items = (isset($request->inverse_brand) && $request->inverse_brand) ? $cat_item_ids->count() - $items : $items;

            $s_category = Term::find($request->cat_id);
            $brand = Term::find($request->brand_id);
            $logic = 'uses';
            if((isset($request->inverse_brand) && $request->inverse_brand)) {
                $logic = "not uses";
            }

            $percentage = number_format(($items/$cat_item_ids->count()) * 100, "2", ".", "");
            $response = ($percentage. "% of ". $s_category->name . " " . $logic . ' brand '. $brand->name);
        }

        
        
        return view('analytics.index', [
            'title' => "Contreau Brands Analyics",
            "allCities" => $all['allCities'],
            "bars" => $all['bars'],
            "allRegion" => $all['allRegion'],
            "countries" => $all['countries'],
            "category" => $category,
            "cointreau_brands" => $cointreau_brands,
            "response" => $response,
            "percentage" => $percentage,
        ]);        
    }
}
