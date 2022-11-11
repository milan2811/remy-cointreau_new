<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('region.index', ['title' => "Regions"]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::pluck('country_name', 'id')->toArray();

        return view('region.form', [
            'title' => 'Regions',
            'region' => null,
            'countries' => $countries,
            'formAttributes' => [
                'url' => route('region.store'),
                'method' => 'POST',
                'files' => true,
            ],
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
            'description' => 'required',
            'country' => 'required',
        ]);

        $input = $request->all();
        $input["country"] = json_encode($input["country"]);

        Region::create($input);
        return redirect()->route('region.index')->with(['success' => 'Region created successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        $countries = Country::pluck('country_name', 'id')->toArray();
        return view('region.form', [
            'title' => 'Regions',
            'region' => $region,
            'countries' => $countries,
            'formAttributes' => [
                'url' => route('region.update', $region),
                'method' => 'PUT',
                'files' => true,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Region $region)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'country' => 'required',
        ]);

        $input = $request->all();
        $input["country"] = json_encode($input["country"]);

        $region->update($input);
        return redirect()->route('region.index')->with(['success' => 'Region updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(['status' => 1]);
    }

    public function getRegions(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('title', fn ($region) => $region->title)
            ->editColumn('created_at', fn ($region) => Carbon::parse($region->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($region) {
                return "<a href='" . route('region.edit', $region->id) . "' class='btn btn-outline-info'><i class='fas fa-pen'></i></a>
                <a href='javascript:;' class='btn btn-outline-danger delete_" . $region->id . "' data-url='" . route('region.destroy', $region->id) . "'  onclick='deleteRecorded(" . $region->id . ")'><i class='fas fa-trash'></i></a>";
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $dataTableQuery = Region::query();

        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('regions.created_at', [$from, $to]);
        }

        return  $dataTableQuery;
    }
}
