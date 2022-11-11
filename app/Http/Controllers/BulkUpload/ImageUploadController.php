<?php

namespace App\Http\Controllers\BulkUpload;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;


class ImageUploadController extends Controller
{
    public function index()
    {
        return view('bulk-upload.images-upload',[
            'title' => "Image Upload",
        ]);
    }
    public function uploadImages(Request $request)
    {
        if ($request->hasfile('file')) {
            $existsFiles = [];
            $uploadedFiles = [];
            foreach ($request->file('file') as $file) {
                $name = $file->getClientOriginalName();
                $size = $file->getSize();
                $path = 'public/images/terms/picture';
                if (!file_exists($path . $name)) {
                    $file->move($path, $name);
                    $uploadedFiles[] = [
                        'name' => $name,
                        'src' =>  url('/').'/'.$path . '/'.$name,
                        'size' =>  $size,
                    ];
                } else {
                    $existsFiles[] = $name;
                }
            }
            return response()->json(['status' => 1, 'existsFiles' => $existsFiles, 'uploadedFiles' => $uploadedFiles]);
        } else {
            return response()->json(['status' => 0, 'msg' => 'Please Select Images']);
        }
    }
}
