<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\RequestItem;
use App\Models\Item;
use App\Models\ItemsRelationship;
use App\Models\Term;
use App\Models\Bar;
use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;

class RequestItemController extends Controller
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
        return view('requests.item', [
            'title' => 'Ingredient/Brand Request',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('requests.item-form', [
            'title' => 'Ingredient/Brand Request',
            'requestType' => $request->get('request'),
            'formAttributes' => [
                'url' => route('request.store'),
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
            'username' => 'required',
            'bar_id' => 'required',
            'email' => 'required|email',
            'request_for' => 'required',
        ]);

        $input = $request->all();
        $input['status'] = null;

        $input["object_id"] = 0;

        // if($input['request_for'] == 'item') {
        //     $this->validate($request, [
        //         'name' => 'required|string',
        //         'slug' => 'required|string|unique:items',
        //         'category' => 'required',
        //         // 'brand' => 'required',
        //         'ingredients' => 'required',
        //         'media_type' => 'required|string',
        //         'price' => 'required|array',
        //     ]);
        //     $input["object_id"] = ItemController::createItem($input)->id;
        // } else {
        $this->validate($request, [
            'name' => 'required',
            'type' => "required"
        ]);
        $input['parent'] = isset($input['parent']) && $input['parent'] ? $input['parent'] : 0;
        $term = new TermController;
        $created = $term->createTerm($input);
        if ($created == false) {
            return redirect()->back()->withInput($input)->withErrors(['name' => 'Name Already Exist']);
        }
        $input["object_id"] = $created->id;
        // }

        RequestItem::create($input);

        return redirect()->back()->with([
            'title' => 'Request an Item',
            'formAttributes' => [
                'url' => route('request.store'),
                'method' => 'POST',
            ],
            'success' => "Request Form Submitted Successfully",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function show(RequestItem $requestItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $requestItem = RequestItem::find($id);
        if (!$requestItem || !$requestItem->object) {
            return redirect(route('request.index'))->with('error', "Item Not Found");
        }
        $relationShipCollection = null;
        $selectedIngredients = null;
        $brands = null;
        $relationships = [];

        if ($requestItem->request_for == 'item') {
            $relationShipCollection = ItemsRelationShip::with('term')->where('item_id', $requestItem->object->id)->get();
            $selectedIngredients = $relationShipCollection->where('term.type', 'ingredients')->pluck("term")->toArray();

            $brands = $relationShipCollection->where('term.type', '!=', 'category')->where('term.type', '!=', 'ingredients')->pluck("term");
            foreach ($relationShipCollection as $relationship) {
                $relationships[] = $relationship->term_id;
            }
        }


        return view('requests.item-form', [
            'title' => 'Request an ingredientes / marca',
            'requestItem' => $requestItem,
            'requestType' => $requestItem->request_for,
            'relationships' => $relationships,
            'selectedBrands' => $brands,
            'selectedIngredients' => $selectedIngredients,
            'formAttributes' => [
                'url' => route('request.update', $requestItem->id),
                'method' => 'PUT',
                'files' => true,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $input = $request->all();
        $requestItem = RequestItem::find($id);

        $this->validate($request, [
            'name' => 'required',
            'type' => "required"
        ]);
        $input['parent'] = isset($input['parent']) && $input['parent'] ? $input['parent'] : 0;
        $term = new TermController;
        $input["slug"] = $term->slug($input['name']);
        $check = Term::where('slug', $input['slug'])->where('type', $input['type'])->count();        
        if ($check > 1) {
            return redirect()->back()->withInput($input)->withErrors(['name' => "Name Already Exist"]);
        }
        Term::find($requestItem->object_id)->update($input);

        if (!$request->expectsJson()) {
            $input['status'] = $input['status'] == 'Approve' ? 1 : 0;
            if($input['status'] == 1) {
                try{                    
                    $data = array('data' => $requestItem, 'term' => Term::find($requestItem->object_id));
                    
                    Mail::send(['html' => 'mail.request_approved'], $data, function ($message) use ($requestItem) {
                        $message->to($requestItem->email, $requestItem->username)->subject('Request is Approved');
                        $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    });
                } catch(\Exception $e) {
                    // Handle Errors                    
                } 
            }
        }

        $requestItem->update($input);
        // if($requestItem->request_for == 'item') {
        //     $item = Item::find($requestItem->object_id);
        //     if($item) {
        //         $item->update($input);
        //     }
        // } else {
        $term = Term::find($requestItem->object_id);
        if ($term) {
            $term->update($input);
        }
        // }
        if ($request->expectsJson()) {
            return response()->json([
                'status' => 1,
            ]);
        }

        return redirect(route('request.index'))->with('success', "Status Updated Successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RequestItem  $requestItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        RequestItem::find($id)->delete();
        return response()->json(['status' => 1]);
    }

    public function getRequests(Request $request)
    {
        $type = ['brands' => 'Liqueurs brand', 'ingredients' => 'Non-alcoholic ingredients', 'category' => 'Liqueurs category'];
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('bar', fn ($requestItem) => $requestItem->bar ? $requestItem->bar->name : 'N/A')
            ->editColumn('name', fn ($requestItem) => $requestItem && $requestItem->object ? $requestItem->object->name : 'N/A')
            ->editColumn('request_for', fn ($requestItem) => $type[$requestItem->request_for])
            ->editColumn('status', function ($requestItem) {
                if ($requestItem->status === null) {
                    return '<a href="javascript:void(0)" class="h4 approve" data-url="' . route('request.update', $requestItem->id) . '"><i class="fas fa-check text-success p-2"></i></a>
                    <a href="javascript:void(0)" class="h4 text-danger reject" data-url="' . route('request.update', $requestItem->id) . '"><i class="fas fa-times-circle p-2"></i></a>';
                }
                if ($requestItem->status == 1) {
                    return '<span class="h4"><i class="fas fa-check text-success"></i></span>';
                }
                if ($requestItem->status == 0) {
                    return '<span class="h4"><i class="fas fa-times-circle text-danger"></i></span>';
                }
                // $class = 'bg-secondary';
                // if($requestItem->status == 'Approved') {
                //     $class="bg-success";
                // }
                // if($requestItem->status == 'Rejected') {
                //     $class = "bg-danger";
                // }
                // return '<form action="'.route("request.update", $requestItem->id).'" method="PUT" class="status-update"><div class="form-group">
                //     <div class="input-group">
                //         <select name="status" id="status" class="form-control '.$class.'">
                //             <option value="Pending" '.($requestItem->status == 'Pending' ? 'selected' : '').' class="bg-secondary">Pending</option>
                //             <option value="Approved" '.($requestItem->status == 'Approved' ? 'selected' : '').' class="bg-success">Approved</option>
                //             <option value="Rejected" '.($requestItem->status == 'Rejected' ? 'selected' : '').' class="bg-danger">Rejected</option>
                //         </select>
                //     </div>
                // </div></form>';
            })
            ->editColumn('created_at', fn ($requestItem) => Carbon::parse($requestItem->created_at)->format('F d, Y'))
            ->addColumn('actions', function ($requestItem) {
                if (isset($requestItem->object)) {

                    return '<a href="' . route('request.edit', $requestItem->id) . '" class="btn btn-outline-info">View</a>';
                } else {
                    return "<a href='javascript:;' class='btn btn-outline-danger delete_" . $requestItem->id . "' data-url='" . route('request.destroy', $requestItem->id) . "'  onclick='deleteRecorded(" . $requestItem->id . ")' title='Item is not available'><i class='fas fa-trash'></i></a>";
                }
                // return '<a href="'.route('request.edit', $requestItem->id).'" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default-'.$requestItem->id.'">View Message</a>
                // <div class="modal fade" id="modal-default-'.$requestItem->id.'">
                //     <div class="modal-dialog">
                //     <div class="modal-content">
                //         <div class="modal-header">
                //         <h4 class="modal-title">'.$requestItem->subject.'</h4>
                //         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                //             <span aria-hidden="true">&times;</span>
                //         </button>
                //         </div>
                //         <div class="modal-body">
                //         <p>'.$requestItem->message.'</p>
                //         </div>
                //     </div>
                //     <!-- /.modal-content -->
                //     </div>
                //     <!-- /.modal-dialog -->
                // </div>
                // <!-- /.modal -->
                // ';
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $user = auth()->user();
        $dataTableQuery = RequestItem::query()->with('bar');

        if ($user->role_id == $this->role['Regional Admin']) { // is Regional Admin
            $ids = Region::where('id', $user->assigned_id)->first()->countries()->pluck('id');
            $bar_ids = Bar::whereIn('country', $ids)->pluck('id');
            $dataTableQuery->whereIn('bar_id', $bar_ids);
        }
        if ($user->role_id == $this->role['National Admin']) { // is National Admin
            $ids = Country::where('id', $user->assigned_id)->pluck('id');
            $bar_ids = Bar::whereIn('country', $ids)->pluck('id');
            $dataTableQuery->whereIn('bar_id', $bar_ids);
        }
        if ($user->role_id == $this->role['Account Admin']) { // is Account Admin
            $bar_id = Bar::where('user', $user->id)->pluck('id');
            $dataTableQuery->whereIn('bar_id', $bar_id);
        }
        if ($user->role_id == $this->role['Bar Admin']) { // is Bar / Restaurant Admin
            $bar_id = Bar::where('id', $user->assigned_id)->pluck('id');
            $dataTableQuery->where('bar_id', $bar_id);
        }

        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('request_items.created_at', [$from, $to]);
        }

        return  $dataTableQuery;
    }
}
