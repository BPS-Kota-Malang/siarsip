<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class ArchiveController extends Controller
{
    public function index()
    {
        $dataUpload = Archive::all();
        $kegiatans = Activity::pluck('name', 'id');
        return view('uploads.upload', compact('dataUpload', 'kegiatans'));
    }

    public function create()
    {
        return view('uploads.add-file');
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'phase' => 'required',
            'preview_link' => 'required',
            'file_content' => 'required|mimes:pdf,doc,docx',
        ]);

        $data = [
            'activity_id' => $request->input('activity_id'),
            'phase' => $request->input('phase'),
            'preview_link' => $request->input('preview_link'),
        ];

        if ($request->hasFile('file_content')) {
            $file = $request->file('file_content');
            $activityName = Activity::find($data['activity_id'])->name;
            $fileName = $activityName . '_' . Str::slug($data['phase']) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/folder-upload', $fileName);

            $data['file_path'] = 'folder-upload/' . $fileName; // Sesuaikan dengan storage:link
            $data['file_content'] = $fileName;
            $data['download_link'] = 'storage/app/public/folder-upload/' . $fileName; // Sesuaikan dengan storage:link
        }

        Archive::create($data);

        return redirect()->route('archive')->with('success', 'File berhasil diunggah.');
    }


    public function downloadFile($id)
    {
        $data = Archive::find($id);

        if ($data && $data->file_content) {
            $filePath = storage_path('app/public/folder-upload/' . $data->file_content);

            // Pastikan file ada sebelum mencoba mendownload
            if (Storage::exists('public/folder-upload/' . $data->file_content)) {
                return response()->download($filePath, $data->file_content);
            }
        }

        // Jika file tidak ditemukan atau file_content null, redirect atau berikan respons error
        return redirect()->route('archive')->with('error', 'File tidak ditemukan.');
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
        $upload = Archive::findorfail($id);
        $upload->update($request->all());

        return redirect('archive')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $upload = Archive::findorfail($id);
        $upload->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
