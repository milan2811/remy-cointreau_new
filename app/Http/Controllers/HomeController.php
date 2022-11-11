<?php

namespace App\Http\Controllers;

use App\Models\Bar;
use App\Models\User;
use App\Models\Term;
use App\Models\Item;
use App\Models\ItemsRelationship;
use App\Models\Promotion;
use App\Models\Analytics;
use App\Models\Content;
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

    public $upload_path;

    public function __construct()
    {
        // $this->middleware('auth');
        $this->role = roles();
        $this->upload_path = public_path('/images/uploads/');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $search = $request->has('search') ? $request->search : '';
        // $drinks = Term::where('type', 'drink')->where('name', 'LIKE', "%$search%")->where('status', 1)->orderBy('created_at', 'desc')->get();
        // $items = Item::where('name', 'LIKE', "%$search%")->where('status', 1)->get();
        // $promotions = Promotion::orderBy('created_at', 'desc')->get();
        $content = Content::where('page', 'home')->pluck("value", "name");

        return view('homepage', ['content' => $content]);
    }

    public function terms_and_conditions() {
        $content = Content::where('page', 'terms-and-conditions')->pluck("value", "name");
        return view('terms-and-conditions', ['content' => $content]);
    }

    public function privacy_policy() {
        $content = Content::where('page', 'privacy-policy')->pluck("value", "name");
        return view('privacy-policy', ['content' => $content]);
    }

    public function edit($page) {
        $bars = Bar::where('status', 1)->get();
        $content = Content::where('page', $page)->pluck("value", "name");           
        if(view()->exists('pages.'.$page.'-form')) {
            $pagename = str_replace('-', ' ', $page);
            return view('pages.'.$page.'-form', ['title' => "Edit $pagename page", 'bars' => $bars, 'home' => $content]);
        }
        abort(404);
    }

    public function update(Request $request, $page) {        
        switch($page) {
            case 'home':
                $this->update_homepage($request, $page);
                break;
            case 'contact':
                $this->update_contact($request, $page);
                break;
            case 'privacy-policy':
                $this->update_privacy_policy($request, $page);
                break;
            case 'terms-and-conditions':
                $this->update_terms_and_conditions($request, $page);
                break;
        }

        return redirect()->back()->with('success', "Home page updated successfully");
    }

    public function update_homepage($request, $page) {
        $content = Content::where('page', $page)->get();
        $data = $request->all();        
        unset($data["_token"]);

        // Banner Image upload
        $banner = $content->where('name', 'banner')->first();            
        if(isset($data['banner']['image']) && $data['banner']['image']) {
            if($banner && isset($banner->value->image) && $banner->value->image) {
                if(file_exists($this->upload_path. $banner->value->image)) {
                    unlink($this->upload_path. $banner->value->image);
                }
            }
            $name = rand().'_'.$data['banner']['image']->getClientOriginalName();
            $data['banner']['image']->move($this->upload_path,  $name);
            $data['banner']['image'] = $name;
        } else {
            $data['banner']['image'] = isset($banner->value->image) ? $banner->value->image : null;
        }

        // Available Images            
        foreach($data['available'] as $key => $available) {
            if(is_array($available)) {
                foreach($available as $index => $val) {
                    if(isset($val['image']) && $val['image'] != '')  {                        
                        if($val['image_name'] && file_exists($this->upload_path . $val['image_name'])) {
                            unlink($this->upload_path . $val['image_name']);
                        }
                        $name = rand().'_'.$val['image']->getClientOriginalName();
                        $val['image']->move($this->upload_path, $name);                                        
                        $data['available'][$key][$index]['image'] = $name;
                    } else {                         
                        $data['available'][$key][$index]['image'] = $val['image_name'];
                    }
                }
            }            
        }

        // About Image upload
        $about = $content->where('name', 'about')->first();            
        if(isset($data['about']['image']) && $data['about']['image']) {
            if($about && isset($about->value->image) && $about->value->image) {
                if(file_exists($this->upload_path. $about->value->image)) {
                    unlink($this->upload_path. $about->value->image);
                }
            }
            $name = rand().'_'.$data['about']['image']->getClientOriginalName();
            $data['about']['image']->move($this->upload_path,  $name);
            $data['about']['image'] = $name;
        } else {
            $data['about']['image'] = isset($about->value->image) ? $about->value->image : null;
        }

        // Easy to manage Image upload
        $easy = $content->where('name', 'easy')->first();        
        if(isset($data['easy']['image']) && $data['easy']['image']) {
            if($easy && isset($easy->value->image) && $easy->value->image) {
                if(file_exists($this->upload_path. $easy->value->image)) {
                    unlink($this->upload_path. $easy->value->image);
                }
            }
            $name = rand().'_'.$data['easy']['image']->getClientOriginalName();
            $data['easy']['image']->move($this->upload_path,  $name);
            $data['easy']['image'] = $name;
        } else {
            $data['easy']['image'] = isset($easy->value->image) ? $easy->value->image : null;
        }

        // How it works Image upload
        $how = $content->where('name', 'how')->first();
        
        if(isset($data['how']['image']) && $data['how']['image']) {
            if($how && isset($how->value->image) && $how->value->image) {
                if(file_exists($this->upload_path. $how->value->image)) {
                    unlink($this->upload_path. $how->value->image);
                }
            }
            $name = rand().'_'.$data['how']['image']->getClientOriginalName();
            $data['how']['image']->move($this->upload_path,  $name);
            $data['how']['image'] = $name;
        } else {
            $data['how']['image'] = isset($how->value->image) ? $how->value->image : null;
        }

        // logos Image Upload        
        if(isset($data['logos']) && $data['logos']) {
            foreach($data['logos'] as $index => $val) {
                if(isset($val['image']) && $val['image'] != '')  {                        
                    if($val['image_name'] && file_exists($this->upload_path . $val['image_name'])) {
                        unlink($this->upload_path . $val['image_name']);
                    }
                    $name = rand().'_'.$val['image']->getClientOriginalName();
                    $val['image']->move($this->upload_path, $name);                                        
                    $data['logos'][$index]['image'] = $name;
                } else {                         
                    $data['logos'][$index]['image'] = $val['image_name'];
                }
            }          
        }

        foreach($data as $name=>$value) {
            Content::updateOrCreate(['name' => $name, 'page' => $page, ],[
                'name' => $name,
                'value' => json_encode($value),
                'page' => $page,
            ]);
        }
    }

    public function update_contact($request, $page) {
        $content = Content::where('page', $page)->get();
        $data = $request->all();        
        unset($data["_token"]);

        // Banner Image upload
        $banner = $content->where('name', 'banner')->first();            
        if(isset($data['banner']['image']) && $data['banner']['image']) {
            if($banner && isset($banner->value->image) && $banner->value->image) {
                if(file_exists($this->upload_path. $banner->value->image)) {
                    unlink($this->upload_path. $banner->value->image);
                }
            }
            $name = rand().'_'.$data['banner']['image']->getClientOriginalName();
            $data['banner']['image']->move($this->upload_path,  $name);
            $data['banner']['image'] = $name;
        } else {
            $data['banner']['image'] = isset($banner->value->image) ? $banner->value->image : null;
        }

        // logos Image Upload        
        if(isset($data['logos']) && $data['logos']) {
            foreach($data['logos'] as $index => $val) {
                if(isset($val['image']) && $val['image'] != '')  {                        
                    if($val['image_name'] && file_exists($this->upload_path . $val['image_name'])) {
                        unlink($this->upload_path . $val['image_name']);
                    }
                    $name = rand().'_'.$val['image']->getClientOriginalName();
                    $val['image']->move($this->upload_path, $name);                                        
                    $data['logos'][$index]['image'] = $name;
                } else {                         
                    $data['logos'][$index]['image'] = $val['image_name'];
                }
            }          
        }

        foreach($data as $name=>$value) {
            Content::updateOrCreate(['name' => $name, 'page' => $page ],[
                'name' => $name,
                'value' => json_encode($value),
                'page' => $page,
            ]);
        }
    }

    public function update_privacy_policy($request, $page) {
        $content = Content::where('page', $page)->get();
        $data = $request->all();        
        unset($data["_token"]);

        foreach($data as $name=>$value) {
            Content::updateOrCreate(['name' => $name, 'page' => $page ],[
                'name' => $name,
                'value' => json_encode($value),
                'page' => $page,
            ]);
        }
    }

    public function update_terms_and_conditions($request, $page) {
        $content = Content::where('page', $page)->get();
        $data = $request->all();        
        unset($data["_token"]);

        foreach($data as $name=>$value) {
            Content::updateOrCreate(['name' => $name, 'page' => $page ],[
                'name' => $name,
                'value' => json_encode($value),
                'page' => $page,
            ]);
        }
    }

    // get category items
    public function items(Term $term, Request $request)
    {

        // analytics($request, $term->id, $term->type);
        // $search = $request->has('search') ? $request->search : '';
        // $ingredient = $request->has('ingredients') ?  Term::where("slug", $request->ingredients)->first() : null;

        // // $items = ItemsRelationship::whereHas('items', function($query) use($search) {
        // //     $query->where('name', 'LIKE', "%$search%");
        // // })->with('items')->where('term_id', $term->id)->distinct('item_id');
        // // $items = $items->has('term')->orderBy('id', 'desc')->get()->pluck('items');

        // // $item_ids = ItemsRelationship::where('term_id', $term->id)->pluck("item_id");

        // // if($ingredients || isset($request->ingredients)) {

        // //     $ids = null;
        // //     if($ingredients) {
        // //         $ids = $ingredients->getAssignTerms->pluck("item_id")->toArray();
        // //     }
        // //     $item_ids = $item_ids->intersect($ids);
        // // }
        // // // dd($ingredients);
        // $ingredient_item_ids = $ingredient ? ItemsRelationship::where('term_id', $ingredient->id)->pluck('item_id') : null;
        // $items = Item::where('drink_id', $term->id)->where('bar_id', $request->bar_id)->where('name', 'LIKE', "%$search%");
        // if ($ingredient_item_ids) {
        //     $items = $items->whereIn('id', $ingredient_item_ids);
        // }
        // $items = $items->where('status', 1)->orderBy('id', 'desc')->get();


        // $drinks = Term::where('type', 'drink')->where('id', '!=', $term->id)->where('status', 1)->orderBy('created_at', 'desc')->limit(4)->get();
        // session()->put('lastVisited', url()->previous());
        // return view('items', ['items' => $items, 'category' => $term, 'drinks' => $drinks]);
    }

    public function BarItems(Bar $bar, $term = null, Request $request)
    {

        if (!$bar) {
            return redirect()->back()->with('error', "No Bar Found");
        }
        analytics($request, $bar->id, 'bar', $bar->id);
        if (isset($term) && $term) {
            $term = Term::where('slug', $term)->where("type", 'drink')->first();
            analytics($request, $term->id, $term->type, $bar->id);
        }
        $search = $request->has('search') ? $request->search : '';
        $ingredient = $request->has('ingredients') ?  Term::where("slug", $request->ingredients)->where("type", 'category')->first() : null;
        if($ingredient) {
            analytics($request, $ingredient->id, $ingredient->type, $bar->id);
        }
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
        
        $items = Item::with('bar')->where('bar_id', $bar->id)->where('name', 'LIKE', "%$search%");
        if ($term) {
            $items->where('drink_id', $term->id);
        }
        
        $ingredients = collect([]);
        foreach ($items->get() as $item) {
            $terms = $item->getTerms();
            // $ingredients = $ingredients->merge($terms->ingredients)->unique();

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

        // Feature Items
        $feature_items = null;
        if($term->id == 42) {
            $feature_item_id = ItemsRelationship::whereIn('term_id', [72])->pluck('item_id');
            $feature_items = $items->whereIn('id', $feature_item_id);            
            $items = $items->whereNotIn('id', $feature_item_id);                        
        }


        $item_ids = Item::where('bar_id', $bar->id)->pluck('drink_id')->toArray();
        $drinks = Term::where('type', 'drink')->whereIn('id', $item_ids)->where('id', '!=', $term->id)->orderBy('created_at', 'desc')->where('status', 1)->limit(4)->get();

        if (session('bar_home_url') == url()->previous()) {
            session()->put('lastVisited', session('bar_home_url'));
        } else if (session('lastVisited') == url()->current()) {
            session()->put('lastVisited', session('bar_home_url'));
        } else {
            session()->put('lastVisited', url()->previous());
        }        

        return view('items', ['feature_items' => $feature_items, 'items' => $items, 'category' => $term, 'drinks' => $drinks, 'bar' => $bar, 'ingredients' => $ingredients]);
    }

    public function dashboard(Request $request)
    {
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
        if ($user->role_id == $this->role['Account Admin']) {
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
            'title' => "Dashboard",
            'owners' => isset($owners) ? $owners : null,
            'bars' => isset($bars) ? $bars : null,
            'category' => isset($category) ? $category : null,
            'ingredients' => isset($ingredients) ? $ingredients : null,
            "brands" => isset($brands) ? $brands : null,
            "items" => isset($items) ? $items->count() : null,
        ]);
    }

    /**
     * Get Promotion details
     *
     * @param Bar $bar
     * @param [int] $promotionId
     * @return void
     */
    public function promotionDetails($bar, $promotionId)
    {
        if (!$bar) {
            return redirect()->back()->with('error', "No Bar Found");
        }
        $bar = Bar::where("slug", $bar)->first();
        $promotion = Promotion::where('bar_id', $bar->id)->where('id', $promotionId)->first();
        if (!isset($promotion)) {
            return redirect()->back()->with('error', "No Promotion Found");
        }
        session()->put('lastVisited', url()->previous());
        return view('promotion-details', ['promotion' => $promotion, 'bar' => $bar]);
    }
}
