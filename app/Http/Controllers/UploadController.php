<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Upload;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function index()
    {
        $dataUpload = Upload::all();
        return view('uploads.upload',compact('dataUpload'));
    }

    public function create()
    {
        $kegiatans = Kegiatan::pluck('name', 'id');
        return view('uploads.add-file', compact('kegiatans'));
    }

    public function store(Request $request)
    {
        Upload::create([
            'activity'=>$request->activity,
            'preview_link'=>$request->preview_link,
            'download_link'=>$request->download_link,
            // 'id_user'=>$request->id_user,

        ]);

        return redirect('archive')->with('success', 'Tambah Data Berhasil!');
    }

    public function edit(string $id)
    {
        $upload = Upload::findorfail($id);
        return view('uploads.edit-file', compact('upload'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $upload= Upload::findorfail($id);
        $upload->update($request->all());

        return redirect('archive')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $upload= Upload::findorfail($id);
        $upload->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
