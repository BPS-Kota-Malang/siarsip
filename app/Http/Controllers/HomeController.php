<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Upload;
class HomeController extends Controller
{
    public function index()
    {
        return view('uploads.welcomee');

    }
    public function upload(Request $request){
    //     //Menggunakan Facades Storage
    // // $path =Storage::putFile('public', $request->file('image'));
    //     //$path=$request->file('image')->store('file-dokumen');
    //     $path=$request->file('image')->storeAs('public','gambar');
    //     dd($path);

    try{
        if($request->hasFile('image')){

            $files=$request->file('image');
            foreach ($files as $file) {

                $filename = time();
                $extension = $file->getClientOriginalExtension();
                $size= $file->getSize();
                $newName= $filename.'.'.$extension;
             Storage::putFileAs('foto', $file, $newName);

                $data=[
                    'path'=> 'storage/'.$newName,
                    'size' => $size
                ];

                 Upload::create($data);

            }

    }

    return 'succes';
}
    catch(Exception $e){
    }

    }
}
