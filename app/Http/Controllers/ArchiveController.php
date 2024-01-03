<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


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
        $data = [
            'activity_id' => $request->input('activity_id'),
            'phase' => $request->input('phase'),
            'preview_link' => $request->input('preview_link'),
            'download_link' => $request->input('download_link'),
            'file_content' => $request->input('file_content_name'), // Sesuaikan dengan nama kolom yang benar
        ];

        // Proses pengunggahan file
        if ($request->hasFile('file_content')) {
            $file = $request->file('file_content');

            // Ambil nama kegiatan berdasarkan ID
            $activityName = Activity::find($data['activity_id'])->name;


            // Format nama file
            // $fileName = $data['activity_id'] . '_' . Str::slug($data['phase']) . '_' . $activityName . '.' . $file->getClientOriginalExtension();
            $fileName = $activityName.'_'.Str::slug($data['phase']). '.'.$file->getClientOriginalExtension();

            // Simpan file di direktori dengan nama file yang dihasilkan
            $path = $file->storeAs('folder-upload', $fileName, 'public');

            // Simpan path file dan konten file ke dalam data
            $data['file_path'] = $path;
            $data['file_content'] = $fileName;
        }

        // Simpan data ke database atau lakukan operasi lain sesuai kebutuhan
        Archive::create($data);

        // Redirect atau kembalikan respons ke halaman yang sesuai
        return redirect()->route('archive')->with('success', 'File berhasil diunggah.');
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
