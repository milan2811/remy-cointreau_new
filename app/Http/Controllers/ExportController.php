<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Analytics;
use App\Models\Bar;
use App\Models\Country;
use App\Models\Region;
use App\Models\Term;
use App\Models\Item;

class ExportController extends Controller
{    
    public $role;

    public function __construct()
    {
        $this->role = roles();
    }

    public function export(Request $request, $type) {            

        // $least_viewed = Analytics::with('item')->where('type', 'item')->orderBy('total_count', 'asc')->get()->unique("object_id");
        // $most_viewed_category = Analytics::with('term')->where('type', 'category')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_category = Analytics::with('term')->where('type', 'category')->orderBy('total_count', 'asc')->get()->unique("object_id");
        // $most_viewed_ingredients = Analytics::with('term')->where('type', 'ingredients')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_ingredients = Analytics::with('term')->where('type', 'ingredients')->orderBy('total_count', 'asc')->get()->unique("object_id");                
        // $most_viewed_brands = Analytics::with('term')->where('type', 'brands')->orderBy('total_count', 'desc')->get()->unique("object_id");
        // $least_viewed_brands = Analytics::with('term')->where('type', 'brands')->orderBy('total_count', 'asc')->get()->unique("object_id");                
        // $busiest_hours = Analytics::where("created_at", ">=", date("Y-m-d", strtotime("-1 Week")))->orderBy("count", "desc")->first();        
        // $least_busiest_hours = Analytics::where("created_at", ">=", date("Y-m-d", strtotime("-1 Week")))->orderBy("count", "asc")->first(); 
        
        $fileName = "$type.csv";
        header("Content-type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=$fileName");            
        $file = fopen('php://output', 'w');

        // Analyzation start
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
            // if(isset($request->filters)) { 
            //     if(isset($request->filters["region"])) { 
            //         $bar_ids = $bar_ids->where("country", $request->filters["region"]); // where region = country
            //     }
            //     if(isset($request->filters["city"])) {
            //         $bar_ids = $bar_ids->where("city", $request->filters["city"]); // where city = city
            //     }
            //     if(isset($request->filters["bar"])) {
            //         $bar_ids = $bar_ids->where("id", $request->filters["bar"]); // where bar = selected bar
            //     }
            //     $bar_ids = $bar_ids->pluck("id")->toArray(); // bar ids to array
            // }                                
        }
        if(isset($request->filters["region"])) { 
            $region = Region::where('id', $request->filters["region"])->first();
            $countryIds = json_decode($region->country);
            $bar_ids = $bar_ids->whereIn("country", $countryIds);            
        }
        if(isset($request->filters["city"])) {
            $bar_ids = $bar_ids->where("city", $request->filters["city"]); // where city = city
        }
        if(isset($request->filters["bar"])) {
            $bar_ids = $bar_ids->where("id", $request->filters["bar"]); // where bar = selected bar
        }
        $bar_ids = $bar_ids->pluck("id")->toArray(); // bar ids to array

        // Items Exporty
        if($type == "most_viewed_items" || $type == "least_viewed_items") {            
            
            $viewed_items = Analytics::whereHas('item', function($query) use ($bar_ids, $request) {
                if(is_array($bar_ids)) {
                    $query->whereIn("bar_id", $bar_ids);
                }       
                if (isset($request->filters['search']) || $request->filters['search'] != '') {
                    $search = $request->filters['search'];
                    $query->where("name", 'LIKE', "%$search%");
                }         
            })->with('item')->where('type', 'item')->orderBy('total_count', 'desc')->get()->unique("object_id");

            if($type == "least_viewed_items") {
                $viewed_items = $viewed_items->reverse();
            }

            $columns = array("Name", "Bar/Restaurant", "Total Count", "Ip Address", "Device", "page Url");
            
            fputcsv($file, $columns);

            $otherItems = Item::whereNotIn('id', $viewed_items->pluck('object_id'))->whereIn('bar_id', $bar_ids);
            if (isset($request->filters['search']) || $request->filters['search'] != '') {
                $search = $request->filters['search'];
                $otherItems->where("name", 'LIKE', "%$search%");
            }         
            $otherItems = $otherItems->get();
            if($type == "least_viewed_items") {
                foreach ($otherItems as $item) {
                    $row = [];
                    $row[]  = $item->name;    
                    $row[]  = $item->bar ? $item->bar->name : 'N/A';    
                    $row[] = 0;  
                    $row[] = '';  
                    $row[] = '';  
                    $row[] = '';  

                    fputcsv($file, $row);
                }                                
            }

            foreach ($viewed_items as $items) {
                $row = [];
                $row[]  = $items->item->name;    
                $row[]  = $items->item->bar ? $items->item->bar->name : 'N/A';    
                $row[] = $items->total_count;  
                $row[] = $items->ip_address;  
                $row[] = $items->device;  
                $row[] = $items->page_url;  

                fputcsv($file, $row);
            }

            if($type != "least_viewed_items") {
                foreach ($otherItems as $item) {
                    $row = [];
                    $row[]  = $item->name;    
                    $row[]  = $item->bar ? $item->bar->name : 'N/A';    
                    $row[] = 0;  
                    $row[] = '';  
                    $row[] = '';  
                    $row[] = '';  

                    fputcsv($file, $row);
                }                                
            }                                
        }        
        
        if($type == "most_viewed_category" || $type == "least_viewed_category" || $type == "most_viewed_ingredients" || $type == "least_viewed_ingredients" || $type == "most_viewed_brands" || $type == "least_viewed_brands" || $type == "most_viewed_drink" || $type == "least_viewed_drink") {                                    
            
            $termArray = explode("_", $type);
            $term = $termArray[count($termArray) - 1];            
            $analytics = Analytics::whereIn('bar_id', $bar_ids)->where('type', $term)->get();
            $term_ids = $analytics->unique('object_id')->pluck('object_id');
            $terms = collect([]);
            foreach($term_ids as $index=>$drink_id) {
                $d = $analytics->where('object_id', $drink_id)->first();
                $d->total_count = $analytics->where('object_id', $drink_id)->sum('count');
                $terms->push($d);
            }        
            $viewed_terms = $terms ? $terms->sortByDesc('total_count') : null;

            // $viewed_terms = Analytics::with('term')->where('type', $term)->orderBy('total_count', 'desc')->get()->unique("object_id");            

            if(str_contains($type, "least")) {
                $viewed_terms = $viewed_terms->reverse();
            }

            $columns = array("Name", "Total Count", "Ip Address", "Device", "page Url");            
            fputcsv($file, $columns);

            $otherterms = Term::whereNotIn('id', $viewed_terms->pluck('object_id'))->where('type', $term)->get();
            if(str_contains($type, "least")) {
                foreach ($otherterms as $terms) {
                    $row = [];
                    $row[]  = $terms->name; 
                    $row[] = 0;  
                    $row[] = '';  
                    $row[] = '';  
                    $row[] = '';  

                    fputcsv($file, $row);
                }                        
            }

            foreach ($viewed_terms as $terms) {
                $row = [];
                $row[]  = $terms->term ? $terms->term->name : 'N/A'; 
                $row[] = $terms->total_count;  
                $row[] = $terms->ip_address;  
                $row[] = $terms->device;  
                $row[] = $terms->page_url;  

                fputcsv($file, $row);
            }                        
            
            if(!str_contains($type, "least")) {
                foreach ($otherterms as $terms) {
                    $row = [];
                    $row[]  = $terms->name; 
                    $row[] = 0;  
                    $row[] = '';  
                    $row[] = '';  
                    $row[] = '';  

                    fputcsv($file, $row);
                }                        
            }                        

        }        

        if($type == "popular_regions") {
            $countries = null;
            $city = null;
            if(isset($request->filters["region"]) && $request->filters["region"]) {
                $region = Region::where('id', $request->filters["region"]) ->first();
                $countries = $region ? json_decode($region->country) : null;
            }
            if(isset($request->filters["country"]) && $request->filters["country"]) {
                $countries = [$request->filters["country"]];
            }
            if(isset($request->filters["city"]) && $request->filters["city"]) {
                $city = $request->filters["city"];
            }
            
            $bar_analtics = Analytics::has('bar')->whereHas("bar", function($query) use($countries, $city) {
                if($countries) {
                    $query->whereIn('country', $countries);
                    if($city) {
                        $query->where('city', $city);
                    }
                }
            })->with('bar')->where("type", "bar")->orderBy("total_count", "desc")->get()->unique("object_id");
                    
            $popular_cities = [];
            $popular_countries = [];
            foreach($bar_analtics as $analytics) {                
                if(isset($popular_countries[$analytics->bar->country])) {
                    $popular_countries[$analytics->bar->getCountry->country_name] = $popular_countries[$analytics->bar->country] + 1;
                } else {
                    $popular_countries[$analytics->bar->getCountry->country_name] = 1;
                }            

                if(isset($popular_cities[$analytics->bar->city])) {
                    $popular_cities[$analytics->bar->city] = $popular_cities[$analytics->bar->city] + 1;
                } else {
                    $popular_cities[$analytics->bar->city] = 1;
                }                        
            }        
            arsort($popular_cities);
            arsort($popular_countries);                    

            $columns = array("Cities", "Countries");            
            fputcsv($file, $columns);

            $row = [];
            $cities = [];
            $countries = [];
            foreach($popular_cities as $city=>$count) {
                $cities[] = $city;
            }
            foreach($popular_countries as $country=>$count) {
                $countries[] = $country;
            }

            for($i=0; $i<count($cities); $i++) {
                $row = [];
                $row[]  = isset($cities[$i]) ? $cities[$i] : '';
                $row[] = isset($countries[$i]) ?$countries[$i] : '';                
                fputcsv($file, $row);
            }            
        }

        fclose($file);                       
        die();         
    }
}
