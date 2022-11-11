<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bar;
use App\Models\Country;
use App\Models\Region;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
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
        $bars = Bar::select("name", "id", 'country', "city");
        $types = Bar::distinct('type')->pluck('type')->toArray();
        $roles = Role::where('role', '>=', $user->role_id)->get();

        $countries = [];
        if ($user->role_id <= $this->role['Super Admin']) {
            $countries = Country::whereIn('id', $bars->pluck('country'))->pluck('country_name', 'id')->toArray();
        }
        if ($user->role_id == $this->role["Account Admin"]) {   /// role based filter
            $bars = $bars->where('user_id', $user->id);
            $countries = Country::whereIn('id', $bars->pluck('country'))->pluck('country_name', 'id')->toArray();
        }
        if ($user->role_id == $this->role['Regional Admin']) {
            $region = Region::find($user->assigned_id);
            $countries = Country::whereIn('id', json_decode($region->country, true))->get();
            $bars = $bars->whereIn('country', $countries->pluck('id'));
            $countries = $countries->pluck('country_name', 'id')->toArray();
        }
        if ($user->role_id == $this->role['National Admin']) {
            $countries = Country::where('id', $user->assigned_id)->pluck('country_name', 'id')->toArray();
            $bars = $bars->where('country', $user->assigned_id);
        }
        $allCities = $bars->pluck('city')->unique();
        $allBars = $bars->pluck("name", 'id')->toArray();

        return view(
            'users.users',
            [
                'title' => 'Users',
                'roles' => $roles,
                'bars' => $allBars,
                'types' => $types,
                'countries' => $countries,
                'allCities' => $allCities,
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $allroles = Role::where('role', '>=', auth()->user()->role_id)->orWhere('role', 0)->get();
        $roles = [];
        foreach ($allroles as $role) {
            $roles[$role->role] = $role->role_name;
        }

        $formAttributes = ['url' => route('users.store'), 'method' => 'POST', 'role' => 'form', 'files' => true, "autocomplete" => "off"];

        $regions = Region::pluck('title', 'id')->toArray();
        $countries = Country::pluck('country_name', 'id')->toArray();
        $bars = null;
        $loginUser = auth()->user();
        if ($loginUser->role_id <= $this->role['Super Admin']) {
            $bars = Bar::pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['Regional Admin']) {
            $countries = Region::where('id', $loginUser->assigned_id)->first()->countries();
            $bars = Bar::whereIn('country', $countries->pluck('id'))->pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['National Admin']) {
            $bars = Bar::where('country', $loginUser->assigned_id)->pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['Account Admin']) {
            $bars = Bar::where('user_id', $loginUser->id)->pluck("name", 'id')->toArray();
        }

        return view('users.user-form', [
            'title' => 'Add User',
            'roles' => $roles,
            'regions' => $regions,
            'countries' => $countries,
            'bars' => $bars,
            'user' => null,
            'formAttributes' => $formAttributes
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
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
            'image' => ['sometimes', 'image'],
            'phone' => ['required'],
            'role_id' => ['required'],
            // 'approved' => ['required'],
        ]);

        $input = $request->all();

        if ($input["role_id"] != 0 && auth()->user()->role_id > $input["role_id"]) {
            $input["approved"] = 0;
        }

        if (isset($input["approved"]) && !empty($input["approved"])) {
            $input["approved"] = $input["approved"];
        } else {
            $input["approved"] = 0;
        }

        $input['password'] = Hash::make($input['password']);

        if (isset($input['image']) && !empty($input["image"])) {
            $fileName = rand() . $input["image"]->getClientOriginalName();
            $input['image']->move(public_path('images/users/'), $fileName);
            $input["profile_image"] = $fileName;
        }
        $input['name'] = ucfirst(strtolower($input['name']));

        switch ($input['role_id']) {
            case $this->role['Regional Admin']:
                if ($input['region'] == '') {
                    return redirect()->back()->withInput($input)->withErrors(['region' => 'Please select a Region']);
                }
                $input['assigned_id'] = $input['region'];
                break;
            case $this->role['National Admin']:
                if ($input['national'] == '') {
                    return redirect()->back()->withInput($input)->withErrors(['national' => 'Please select a National']);
                }
                $input['assigned_id'] = $input['national'];
                break;
            case $this->role['Bar Admin']:
                if ($input['bar'] == '') {
                    return redirect()->back()->withInput($input)->withErrors(['bar' => 'Please select a Bar']);
                }
                if (User::where('role_id', $this->role['Bar Admin'])->where('assigned_id', $input['bar'])->count() > 0) {
                    $input['role_id'] = null;
                    return redirect()->back()->withInput($input)->withErrors(['bar' => "This Bar Already has a Admin"]);
                }
                $input['assigned_id'] = $input['bar'];
                break;
            default:
                $input['assigned_id'] = 0;
        }
        User::create($input);

        if ($input["approved"] == 1) {
            try {
                $data = array('user' => $input);
                Mail::send(['html' => 'mail.user_created'], $data, function ($message) use ($input) {
                    $message->to($input['email'], $input['name'])->subject('Account Created Successfully');
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
            } catch (\Exception $e) {
                // Log the error
            }
        }

        return redirect(route('users.index'))->with('success', "User Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (!$this->isAuthorized($user)) {
            abort(401);
        }

        $roles = Role::get();
        $loginUser = auth()->user();
        if ($loginUser->role_id > $this->role['Super Admin']) {
            $roles = $roles->where('role', '>', $loginUser->role_id);
        }
        $roles = $roles->pluck('role_name', 'role')->toArray();
        // $roles = [];
        // foreach ($allroles as $role) {
        //     $roles[$role->role] = $role->role_name;
        // }
        $formAttributes = ['url' => route('users.update', $user->id), 'method' => 'PUT', 'role' => 'form', 'files' => true, "autocomplete" => "off"];
        $regions = Region::pluck('title', 'id')->toArray();
        $countries = Country::pluck('country_name', 'id')->toArray();
        $bars = [];
        $loginUser = auth()->user();
        if ($loginUser->role_id <= $this->role['Super Admin']) {
            $bars = Bar::pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['Regional Admin']) {
            $countries = Region::where('id', $loginUser->assigned_id)->first()->countries();
            $bars = Bar::whereIn('country', $countries->pluck('id'))->pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['National Admin']) {
            $bars = Bar::where('country', $loginUser->assigned_id)->pluck("name", 'id')->toArray();
        }
        if ($loginUser->role_id == $this->role['Account Admin']) {
            $bars = Bar::where('user_id', $loginUser->id)->pluck("name", 'id')->toArray();
        }
        return view('users.user-form', [
            'title' => 'Edit User',
            'roles' => $roles,
            'regions' => $regions,
            'countries' => $countries,
            'bars' => $bars,
            'user' => $user,
            'formAttributes' => $formAttributes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if (!$this->isAuthorized($user)) {
            abort(404);
        }

        $input = $request->all();
        unset($input['email']);
        if (isset($input['password']) && !empty($input['password'])) {
            $this->validate($request, [
                'password' => ['required', 'min:8'],
                'verify_otp' => ['required'],
            ]);
            $otp = $request->session()->get('otp');
            if (!isset($otp) || !isset($otp['pin']) || !isset($otp["expire_time"]) || $otp['expire_time'] <= time() || $input['verify_otp'] != $otp['pin']) {
                // dd('invalid');
                return redirect(route('dashboard'))->with('error', "Invalid OTP");
            }
        } else {
            $this->validate($request, [
                'name' => ['required', 'string', 'max:255'],
                // 'role_id' => ['sometimes', 'required'],
                // 'image' => ['sometimes', 'image'],
                'phone' => ['required'],
                // 'approved' => ['required'],
            ]);
        }
        // $input['email'] = NULL;

        if (isset($input["role_id"]) && $input["role_id"] != 0 && auth()->user()->role_id > $input["role_id"]) {
            $input["approved"] = "0";
        }

        // dd($input);

        if (isset($input['password']) && !empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            unset($input['password']);
        }

        if (isset($input['image']) && !empty($input["image"])) {
            if ($user->profile_image && file_exists(public_path('images/users/'.$user->profile_image))) {
                unlink(public_path('images/users/'.$user->profile_image));
            }
            $fileName = rand() . $input["image"]->getClientOriginalName();
            $input['image']->move(public_path('images/users/'), $fileName);
            $input["profile_image"] = $fileName;
        }

        ///// Send Email if user is approved to login
        if ($user->approved == 0 && $input["approved"] == 1) {
            try {
                $data = array('user' => $user);
                Mail::send(['html' => 'mail.approved'], $data, function ($message) use ($user) {
                    $message->to($user->email, $user->name)->subject('Approved to Login');
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                });
            } catch (\Exception $e) {
                // Log the error
            }
        }
        $input['name'] = isset($input['name']) ? ucfirst(strtolower($input['name'])) : $user->name;
        if (isset($input['role_id'])) {
            switch ($input['role_id']) {
                case $this->role['Regional Admin']:
                    if ($input['region'] == '') {
                        return redirect()->back()->withInput($input)->withErrors(['region' => 'Please select a Region']);
                    }
                    $input['assigned_id'] = $input['region'];
                    break;
                case $this->role['National Admin']:
                    if ($input['national'] == '') {
                        return redirect()->back()->withInput($input)->withErrors(['national' => 'Please select a National']);
                    }
                    $input['assigned_id'] = $input['national'];
                    break;
                case $this->role['Bar Admin']:
                    if ($input['bar'] == '') {
                        return redirect()->back()->withInput($input)->withErrors(['bar' => 'Please select a Bar']);
                    }
                    if (User::where('id', '!=', $user->id)->where('role_id', $this->role['Bar Admin'])->where('assigned_id', $input['bar'])->count() > 0) {
                        $input['role_id'] = null;
                        return redirect()->back()->withInput($input)->withErrors(['bar' => "This Bar Already has a Admin"]);
                    }
                    $input['assigned_id'] = $input['bar'];
                    break;
                default:
                    $input['assigned_id'] = 0;
            }
        }

        $user->update($input);

        if (auth()->user()->role_id < $this->role['Bar Admin']) {
            return redirect()->back()->with('success', "User Updated Successfully");
        } else {
            return redirect(route('dashboard'))->with('success', "User Updated Successfully");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!$this->isAuthorized($user)) {
            abort(404);
        }

        if ($user->profile_image && file_exists(public_path('images/users/' . $user->profile_image))) {
            unlink(public_path('images/users/') . $user->profile_image);
        }
        $user->delete();
        return response()->json(['status' => 1]);
    }

    public function isAuthorized($user)
    {
        $loginUser = auth()->user();
        if ($loginUser->role_id < $user->role_id || $user->role_id == 0  || $loginUser->id == $user->id || $loginUser->id == 1) {
            return true;
        }
        return false;
    }

    public function editpassword(Request $request, $id)
    {
        $user = User::find($id);
        if (!$this->isAuthorized($user)) {
            abort(404);
        }

        $formAttributes = ['url' => route('users.verify', $user->id), 'method' => 'POST', 'role' => 'form', 'files' => true, "autocomplete" => "off"];
        return view('users.update-password', ['title' => 'Update Password', 'user' => $user, 'formAttributes' => $formAttributes]);
    }

    public function verify(Request $request, $id)
    {
        $input = $request->all();
        $user = User::find($id);

        $this->validate($request, [
            'current_password' => ['required', 'min:8'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'min:8'],
        ]);
        if (!Hash::check($input['current_password'], $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Incorrect Current Password']);
        }

        try {
            $request->session()->put('otp', array(
                'pin' => rand(000000, 999999),
                'expire_time' => time() + 2 * 60,
            ));
            $data = array('user' => $user);
            Mail::send(['html' => 'mail.verify'], $data, function ($message) use ($user) {
                $message->to($user->email, $user->name)->subject('Verfication for password update');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
        } catch (\Exception $e) {
            // Log the error
        }

        $user->update_password = $input['password'];

        $formAttributes = ['url' => route('users.update', $user->id), "method" => 'PUT', 'role' => 'form', 'files' => true,  "autocomplete" => "off"];
        return view('users.verify', ['title' => 'Verify', 'user' => $user, 'formAttributes' => $formAttributes, 'success' => 'OTP has been sent to your email']);
        //dd($user);
    }

    public function getUsers(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('profile_image', function ($user) {
                $image = $user->profile_image ? asset('/public/images/users/' . $user->profile_image) : asset('/public/images/avatar.png');
                return "<img src='" . $image . "' height='50' width='50'/>";
            })
            ->editColumn('barName', function ($user) {
                $bar = Bar::find($user->assigned_id);
                if ($bar && $user->role_id == $this->role['Bar Admin']) {
                    return $bar->name;
                }
                return 'N/A';
            })
            ->editColumn('name', fn ($user) => $user->name)
            ->editColumn('email', fn ($user) => $user->email)
            ->editColumn('role_id', fn ($user) => $user->role_id == 0 ? 'User' : $user->role->role_name)
            ->editColumn('approved', function ($user) {
                if ($user->approved == 1) {
                    return "<label class='badge bg-success'>Approved</label>";
                } else {
                    return "<label class='badge bg-warning'>Not Approved</label>";
                }
            })
            // ->editColumn('barName', function ($user) {
            //     if (isset($user->barName)) {
            //         return $user->barName;
            //     } else {
            //         return 'NA';
            //     }
            // })
            // ->editColumn('created_at', fn ($user) => Carbon::parse($user->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($user) {
                return "<a href='" . route('users.edit', $user->id) . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>
                <a href='javascript:;' class='btn btn-outline-danger delete_" . $user->id . "' data-url='" . route('users.destroy', $user->id) . "'  onclick='deleteRecorded(" . $user->id . ")'><i class='fas fa-trash'></i></a>";
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $dataTableQuery = User::select('users.*', 'b.name as barName')->leftjoin('bars as b', 'b.user_id', '=', 'users.id');
        // $dataTableQuery = User::leftjoin('bars', 'bars.id', '=', 'users.assigned_id')->leftjoin('countries as c', 'c.id', '=', 'bars.country');


        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('users.created_at', [$from, $to]);
        }

        // if (isset($input['date']) && $input['date'] != '') {
        //     $dataTableQuery->whereDate('components.created_at', '=', $input['date']);
        // }


        if (isset($input['role_id']) && $input['role_id'] != '') {
            $dataTableQuery->where('users.role_id', $input['role_id']);
        }

        if (isset($input['approved']) && $input['approved'] != '') {
            $dataTableQuery->where('users.approved', $input['approved']);
        }
        // if (isset($input['bar']) && $input['bar'] != '') {
        //     $dataTableQuery->where('b.type', $input['bar']);
        // }

        $user = auth()->user();
        if ($user->role_id <= $this->role['Super Admin']) {
            $dataTableQuery->where('users.role_id', '>=',  0);
        } else {
            $dataTableQuery->where('users.role_id', '>=', $user->role_id);
        }
        // if (!isset($input['role_id'])) {
        //     /// Show users role below their role
        //         // if ($user->role_id <= $this->role["Super Admin"]) {
        //             // if (isset($input['country']) && $input['country'] != '') {
        //             //     $dataTableQuery->where('b.country', $input['country']);
        //             // }
        //             // if (isset($input['city']) && $input['city'] != '') {
        //             //     $dataTableQuery->where('b.city', $input['city']);;
        //             // }
        //             // if (isset($input['bar']) && $input['bar'] != '') {
        //             //     $dataTableQuery->where('b.id', $input['bar']);;
        //             // }
        //         // }
        //     if ($user->role_id == $this->role["Regional Admin"]) {
        //         $countryIds = Region::find($user->assigned_id)->countries()->pluck('id')->toArray();
        //         $bars = Bar::whereIn('country', $countryIds)->get();
        //         $barIds = $bars->pluck('id')->toArray();
        //         $userIds = $bars->pluck('user_id')->toArray();
        //         $dataTableQuery->where('users.role_id', $this->role['National Admin'])->whereIn('users.assigned_id', $countryIds);
        //         $dataTableQuery->orWhere('users.role_id', $this->role['Account Admin'])->whereIn('users.id', $userIds);
        //         $dataTableQuery->orWhere('users.role_id', $this->role['Bar Admin'])->whereIn('users.assigned_id', $barIds);
             
        //     }

        //     if ($user->role_id == $this->role["National Admin"]) {
        //         $bars = Bar::where('country', $user->assigned_id)->get();
        //         $barIds = $bars->pluck('id');
        //         $userIds = $bars->pluck('user_id');
        //         $dataTableQuery->where('users.role_id', '>', $user->role_id)
        //             ->whereIn('users.id', $userIds) 
        //             ->orWhereIn('users.assigned_id', $barIds);
        //     }

        //     if ($user->role_id == $this->role['Account Admin']) {
        //         $bars = Bar::where('user_id', $user->id)->pluck('id');
        //         // $dataTableQuery->where('users.role_id', '>=', $user->role_id)->where('b.user_id', $user->id);
        //         $dataTableQuery->whereIn('assigned_id', $bars);
        //     }
           
        // }

        if ($user->role_id == $this->role['Account Admin']) {
            $bars = Bar::where('user_id', $user->id)->pluck('id');
            // $dataTableQuery->where('users.role_id', '>=', $user->role_id)->where('b.user_id', $user->id);
            $dataTableQuery->where('b.user_id', $user->id);
            if(!isset($input['country']) || $input['country'] == '' || !isset($input['city']) || $input['city'] == '') {
                $dataTableQuery->orWhereIn('users.assigned_id', $bars);
            }
        }

        if ($user->role_id == $this->role["Regional Admin"]) {
            $countryIds = Region::find($user->assigned_id)->countries()->pluck('id')->toArray();
            $bars = Bar::whereIn('country', $countryIds)->get();            
            $barIds = $bars->pluck('id')->toArray();
            $userIds = $bars->pluck('user_id')->toArray();
            if((!isset($input['bar']) || $input['bar'] == '') && (!isset($input['country']) || $input['country'] == '') && (!isset($input['city']) || $input['city'] == '')) {
                $dataTableQuery->whereIn('users.assigned_id', $countryIds);
                $dataTableQuery->orWhereIn('users.id', $userIds);
                $dataTableQuery->orWhereIn('users.assigned_id', $barIds);
            }            
        }

        if (isset($input['country']) && $input['country'] != '') {
            $dataTableQuery->where('b.country', $input['country']);
        }
        if (isset($input['city']) && $input['city'] != '') {
            $dataTableQuery->where('b.city', $input['city']);;
        }
        if (isset($input['bar']) && $input['bar'] != '') {            
            $dataTableQuery->where('b.id', $input['bar'])->orWhere('users.assigned_id', $input['bar']);
        }

        

        if ($user->role_id == $this->role["National Admin"]) {
            $bars = Bar::where('country', $user->assigned_id)->get();
            $barIds = $bars->pluck('id');
            $userIds = $bars->pluck('user_id');
            $dataTableQuery->whereIn('users.id', $userIds) 
                ->orWhereIn('users.assigned_id', $barIds);
        }


        return  $dataTableQuery;
    }
}
