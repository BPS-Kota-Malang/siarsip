<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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
            'file_content' => 'required',
        ]);

        $userId = Auth::id();
        $data = [
            'activity_id' => $request->input('activity_id'),
            'phase' => $request->input('phase'),
            'user_id' => $userId, // Add user_id to the data array
        ];

        if ($request->hasFile('file_content')) {
            $files = $request->file('file_content');
            $activityName = Activity::find($data['activity_id'])->name;

            foreach ($files as $file) {
                // Menggunakan timestamp sekarang sebagai bagian dari nama file
                $now = Carbon::now();

                // Membuang bagian waktu dari format default
                $fileName = $now->format('Ymd') . '_' . $file->getClientOriginalName();

                // Mengubah format nama file jika diperlukan
                // $fileName = $file->getClientOriginalName();

                $path = $file->storeAs('public/folder-upload', $fileName);

                $archiveData = [
                    'activity_id' => $data['activity_id'],
                    'phase' => $data['phase'],
                    'user_id' => $data['user_id'],
                    'preview_link' => 'storage/folder-upload/' . $fileName,
                    'file_path' => 'folder-upload/' . $fileName,
                    'file_content' => $fileName,
                    // 'download_link' => 'storage/folder-upload/' . $fileName,
                ];

                Archive::create($archiveData);
            }
        }

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


    public function update(Archive $archive, Request $request, string $id)
    {
        $this->authorize('update', $archive);
        $data = Archive::findOrFail($id);

        // Validate request if needed
        $request->validate([
            'activity_id' => 'required',
            'phase' => 'required',
            'file_content' => 'required',
        ]);

        // Update only the necessary fields
        $data->update([
            'activity_id' => $request->input('activity_id'),
            'phase' => $request->input('phase'),
        ]);

        // Check if a new file is being uploaded
        if ($request->hasFile('file_content')) {
            // Delete the old file
            Storage::delete('public/folder-upload/' . $data->file_content);

            // Process the new file
            $file = $request->file('file_content');

            // Menggunakan timestamp sekarang sebagai bagian dari nama file
            $now = now();

            // Membuang bagian waktu dari format default
            $fileName = $now->format('Ymd_His') . '_' . $file->getClientOriginalName();

            // Mengubah format nama file jika diperlukan
            // $fileName = $file->getClientOriginalName();

            $path = $file->storeAs('public/folder-upload', $fileName);

            // Update file-related fields in the database
            $data->update([
                'file_content' => $fileName,
                'preview_link' => url('storage/folder-upload/' . $fileName),
                'file_path' => 'folder-upload/' . $fileName,
            ]);
        }


        return redirect()->route('archive')->with('success', 'Data Berhasil Update!');
    }
    /**
     * Backup Tim
    */
    // public function destroy(Archive $archive, string $id)
    // {
    //     $this->authorize('delete', $archive);
    //     $upload = Archive::findorfail($id);
    //     $upload->delete();
    //     // $archive->delete();

    //     return back()->with('info', 'Data Berhasil Dihapus!');
    // }

    public function destroy(Archive $archive, string $id)
    {
        $this->authorize('delete', $archive);
        $upload = Archive::findorfail($id);
        $upload->delete();
        // $archive->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
