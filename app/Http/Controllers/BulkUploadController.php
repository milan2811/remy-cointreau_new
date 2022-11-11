<?php

namespace App\Http\Controllers;

use Excel;
use Illuminate\Http\Request;
use App\Models\JacketCategories;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BulkUpload\TermsImport;

class BulkUploadController extends Controller
{
    public function index()
    {
        return view('bulk-upload.index', [
            'title' => 'Bulk upload',
        ]);
    }
    public function uploadData(Request $request)
    {
       
        try {
            $import = new TermsImport();
            $import->onlySheets('drink', 'category', 'ingredients', 'brands');
            Excel::import($import, request()->file('file'), \Maatwebsite\Excel\Excel::XLSX);
            return redirect()->route('bulk.upload')->with('success', 'Bulk uploaded successfully');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $failure->row(); // row that went wrong
                $failure->attribute(); // either heading key (if using heading row concern) or column index
                $failure->errors(); // Actual error messages from Laravel validator
                $failure->values(); // The values of the row that has failed.
                return redirect()->route('bulk.upload')->with('error', $failure->errors());
            }
        }
    }
}
