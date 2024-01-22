<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Activity;
use App\Models\Division;
use App\Models\Phase;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Response;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        $activities = Activity::all();
        $phases = Phase::all();
        $zones = Zone::all();

        /**
         * Add URL To Preview
         */
        // $preview_link = Storage::url('public/'.$division.'/'.$filename);

        return view('file.upload', compact('files', 'activities', 'phases', 'zones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'phase_id' => 'required',
            'file_content' => 'required',
        ]);

        $userId = Auth::id();
        $uuid = Str::orderedUuid();

        $data = [
            'activity_id' => $request->input('activity_id'),
            'phase_id' => $request->input('phase_id'),
            'zone_id' => $request->input('zone_id'),
            'user_id' => $userId,
            'uuid' => $uuid
        ];

        if ($request->hasFile('file_content')) {
            $files = $request->file('file_content');
            $division = Activity::find($request->activity_id)->division->name;
            Storage::disk('local')->makeDirectory($division);
            foreach ($files as $file) {
                $now = Carbon::now();

                $fileName = $now->format('Ymd') . '_' . $file->getClientOriginalName();

                // $path = $file->storeAs('public/folder-upload', $fileName);
                // $path = $file->storeAs('public/'.$division, $fileName);
                $path = Storage::putFileAs('public/'.$division, $file, $fileName);

                $archiveData = [
                    'activity_id' => $data['activity_id'],
                    'phase_id' => $data['phase_id'],
                    'zone_id' => $data['zone_id'],
                    'user_id' => $data['user_id'],
                    'uuid' => $data['uuid'],
                    // 'preview_link' => 'storage/folder-upload/' . $fileName,
                    'file_name' => $fileName,
                ];

                File::create($archiveData);
            }
        }

        return redirect()->route('file.index')->with('success', 'File berhasil diunggah.');
    }

    /**
     * Download File
     *
     * @param File $file
     * @return void
     */

     public function downloadFile($id)
     {
        $data = File::find($id);
        $division = $data->activity->division->name;
        // dd($data);
        if ($data && $data->file_name) {
            $filePath = storage_path($data->file_name);

            // // dd($filePath);
            // // Pastikan file ada sebelum mencoba mendownload
            if (Storage::disk('public')->exists($division.'/'.$data->file_name)) {
            //     dd($data->file_name);
            //     return response()->download($filePath, $data->file_name);
            return Storage::download('public/'.$division.'/'.$data->file_name);

            }
        }

        // Jika file tidak ditemukan atau file_content null, redirect atau berikan respons error
        return redirect()->route('file.index')->with('error', 'File tidak ditemukan.');
     }

     /**
      * Preview File
      *
      * @param [type] $id
      * @return void
      */
    // public function previewFile($id)
    //  {
    //     $data = File::find($id);
    //     $division = $data->activity->division->name;
    //     // dd($data);
    //     if ($data && $data->file_name) {
    //         $filePath = storage_path($data->file_name);
    //         $filename = $data->file_name;
    //         // // dd($filePath);
    //         // // Pastikan file ada sebelum mencoba mendownload
    //         if (Storage::disk('public')->exists($division.'/'.$filename)) {
    //         //     dd($filename);
    //         //     return response()->download($filePath, $filename);
    //             // return Storage::url('public/'.$division.'/'.$filename);
    //             $preview_link = Storage::url('public/'.$division.'/'.$filename);
    //             $mimeType = Storage::mimeType('public/'.$division.'/'.$filename);
    //             // return asset($preview_link);
    //             // dd($mimeType);
    //             // return view('file.preview', compact('preview_link', 'mimeType'));

    //             return response()->file(public_path($preview_link));
    //         }
    //     }

    //     // Jika file tidak ditemukan atau file_content null, redirect atau berikan respons error
    //     return redirect()->route('file.index')->with('error', 'File tidak ditemukan.');
    //  }

     public function previewFile($uuid)
    //  public function previewFile($id)
     {
         $data = File::where('uuid', $uuid)->first();
        //  $data_model = File::find($data['id']);
        // $division = $data->activity_id;
        $division = $data->activity->division->name;
        // dd($data);
        // dd($data, $division);
        if ($data && $data->file_name) {
            $filePath = storage_path($data->file_name);
            $filename = $data->file_name;
            // // dd($filePath);
            // // Pastikan file ada sebelum mencoba mendownload
            if (Storage::disk('public')->exists($division.'/'.$filename)) {
            //     dd($filename);
            //     return response()->download($filePath, $filename);
                // return Storage::url('public/'.$division.'/'.$filename);
                $preview_link = Storage::url('public/'.$division.'/'.$filename);
                $mimeType = Storage::mimeType('public/'.$division.'/'.$filename);
                // return asset($preview_link);
                // dd($mimeType);
                // return view('file.preview', compact('preview_link', 'mimeType'));

                return response()->file(public_path($preview_link));
            }
        }

        // Jika file tidak ditemukan atau file_content null, redirect atau berikan respons error
        return redirect()->route('file.index')->with('error', 'File tidak ditemukan.');
     }


    /**
     * Display the specified resource.
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(File $file, Request $request, string $id)
    {
        $file = File::findorFail($id);
        try {
            $this->authorize('update', $file);

            $request->validate([
                'activity_id' => 'required',
                'phase_id' => 'required',
                'file_content' => 'required',
            ]);

            // Update only the necessary fields
            $file->update([
                'activity_id' => $request->input('activity_id'),
                'phase_id' => $request->input('phase_id'),
                'zone_id' => $request->input('zone_id'),
            ]);
           /**
            * Melakukan pengecheckan jika mengupload File baru
            */
            if ($request->hasFile('file_content')) {

                $division = Activity::find($$file->activity_id)->division->name;

                if (Storage::disk('public')->exists($division.'/'.$file->file_name)){
                    Storage::disk('public')->delete($division.'/'.$file->file_name);
                }

                $new_file = $request->file('file_content');
                Storage::disk('local')->makeDirectory($division);

            }

            return redirect()->route('file.index')->with('success', 'Arsip berhasil dirubah.');
        } catch (AuthorizationException $e) {
            return redirect()->route('file.index')->with('error', 'Akses hapus arsip ditolak!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $archive = File::with('activity')->find($id);
        try {
            $this->authorize('delete', $archive);

            // Lanjutkan dengan operasi penghapusan jika otorisasi berhasil
            $archive->delete();

            return redirect()->route('file.index')->with('success', 'Arsip berhasil dihapus.');
        } catch (AuthorizationException $e) {
            return redirect()->route('file.index')->with('error', 'Akses hapus arsip ditolak!');
        }

    }
}
