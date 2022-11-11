<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Carbon\Carbon;
use App\Models\Enquiry;
use Exception;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Mail;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('enquiry.index', [
            'title' => 'Enquiry',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {        
        $content = Content::where('page', 'contact')->pluck("value", "name");
        
        return view('enquiry', [
            'content' => $content,
            'formAttributes' => [
                'url' => route('enquiry.store'), 
                'method' => 'POST',
            ]
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
            "name" => 'required',        
            "email" => 'required|email',
            "phone" => 'required|min:10',
            "bar_name" => 'required',            
            "message" => 'required',            
        ]);

        $input = $request->all();

        try {
            $data = array('enquiry' => $input);
            Mail::send(['html' => 'mail.enquiry'], $data, function ($message) {
                $message->to(env('MAIL_TO_ADDRESS'), env('MAIL_TO_NAME'))->subject('Enquiry Form');
                $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            });
        } catch(Exception $e) {
            dd($e);
        } 
        
        $input['status'] = 0;        
        Enquiry::create($input);
        print_r($input);
        return redirect()->back()->with(['success' => "Enquiry Form submitted successfully."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function show(Enquiry $enquiry)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function edit(Enquiry $enquiry)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $requestItem = Enquiry::find($id);
        $requestItem->update($input);
        return response()->json([
            'status' => 1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enquiry  $enquiry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return response()->json(['status' => 1]);
    }

    public function getEnquiries(Request $request)
    {
        return Datatables::make($this->getForDataTable($request->all()))
            ->escapeColumns(['id'])
            ->editColumn('name', fn ($enquiry) => $enquiry->name)
            ->editColumn('email', fn ($enquiry) => $enquiry->email)
            ->editColumn('phone', fn ($enquiry) => $enquiry->phone)
            ->editColumn('bar_name', fn ($enquiry) => $enquiry->bar_name)
            ->editColumn('created_at', fn ($enquiry) => Carbon::parse($enquiry->created_at)->format('F d, Y'))
            ->editColumn('status', function($enquiry) {
                $class = 'bg-secondary';
                if($enquiry->status == '1') {
                    $class="bg-success";
                }
                return '<form action="'.route("enquiry.update", $enquiry->id).'" method="PUT" class="status-update"><div class="form-group">
                    <div class="input-group">
                        <select name="status" id="status" class="form-control '.$class.'">
                            <option value="0" '.($enquiry->status == '0' ? 'selected' : '').' class="bg-secondary">Pending</option>
                            <option value="1" '.($enquiry->status == '1' ? 'selected' : '').' class="bg-success">Reviewed</option>
                        </select>
                    </div>
                </div></form>';
            })
            ->addColumn('actions', function ($enquiry) {
                return '<a href="javascript:;" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-default-'.$enquiry->id.'">View Message</a>
                <div class="modal fade" id="modal-default-'.$enquiry->id.'">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">                        
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Name : </strong>'.$enquiry->name.'</p>
                            <p><strong>Email : </strong>'.$enquiry->email.'</p>
                            <p><strong>Phone number : </strong>'.$enquiry->phone.'</p>
                            <p><strong>Name of the restaurant : </strong>'.$enquiry->bar_name.'</p>
                            <p><strong>Address : </strong>'.$enquiry->bar_address.'</p>
                            <p><strong>Name of the city : </strong>'.$enquiry->bar_city.'</p>
                            <p><strong>Country name : </strong>'.$enquiry->bar_country.'</p>
                            <p><strong>Message:</strong></p>
                            <p>'.$enquiry->message.'</p>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                <!-- /.modal -->
                ';
            })
            ->make(true);
    }

    public function getForDataTable($input)
    {
        $dataTableQuery = Enquiry::query()->orderBy('id', 'desc');

        if (isset($input['date']) && $input['date'] != '') {
            $from = explode(' - ', $input['date'])[0];
            $to = explode(' - ', $input['date'])[1];
            $from = date('Y-m-d', strtotime($from));
            $to = date('Y-m-d', strtotime($to));
            $dataTableQuery->whereBetween('enquiries.created_at', [$from, $to]);
        }

        return  $dataTableQuery;
    }
}
