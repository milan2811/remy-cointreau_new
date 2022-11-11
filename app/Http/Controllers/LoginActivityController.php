<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Models\LoginActivity;
use Yajra\Datatables\Datatables;

class LoginActivityController extends Controller
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
        return view("login-activity.index", [
            'title' => 'Login Activity'
        ]);
    }

    public function getLoginActivity(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('role_name', fn ($user) => $user->role_name)
            ->editColumn('barName', function ($user) {
                if (isset($user->barName) && !empty($user->barName)) {
                    return $user->barName;
                } else {
                    return 'N/A';
                }
            })
            ->editColumn('created_at', fn ($user) => Carbon::parse($user->created_at)->format('F d, Y H:i:s'))
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $user = auth()->user();
        $dataTableQuery = LoginActivity::select('login_activities.*', 'users.name as name', 'users.role_id as role_id', 'roles.role_name as role_name', 'bars.name as barName')
            ->leftjoin('users', 'users.id', '=', 'login_activities.user_id')
            ->leftjoin('roles', 'users.role_id', '=', 'roles.role');
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $dataTableQuery->leftjoin('bars', 'users.assigned_id', '=', 'bars.id')
                ->where('bars.id', $user->assigned_id);
        } else {
            $dataTableQuery->leftjoin('bars', 'users.id', '=', 'bars.user_id');
        }
        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $dataTableQuery->whereIn('country', $ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->whereIn('bars.country', $ids);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $dataTableQuery->where('bars.user_id', $user->id);
        }
        return  $dataTableQuery;
    }
}
