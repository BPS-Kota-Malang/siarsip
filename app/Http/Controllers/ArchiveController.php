<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Archive;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function index()
    {
        $dataUpload = Archive::all();
        $kegiatans = Activity::pluck('name', 'id');
        return view('uploads.upload',compact('dataUpload','kegiatans'));

    }

    public function create()
    {
        return view('uploads.add-file');
    }

    public function store(Request $request)
    {
        Archive::create([
            'activity_id'=>$request->activity_id,
            'preview_link'=>$request->preview_link,
            'download_link'=>$request->download_link,
            // 'id_user'=>$request->id_user,

        ]);

        return redirect('archive')->with('success', 'Tambah Data Berhasil!');
    }

    public function edit(string $id)
    {
        $upload = Archive::findorfail($id);
        return view('uploads.upload', compact('upload'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $upload= Archive::findorfail($id);
        $upload->update($request->all());

        return redirect('archive')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $upload= Archive::findorfail($id);
        $upload->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
