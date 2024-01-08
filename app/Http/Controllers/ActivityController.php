<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Exports\ActivityExport;
use App\Imports\ActivityImport;
use App\Policies\ActivityPolicy;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ActivityDivisionImport;
use App\Exports\CustomActivityTemplateExport;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datakegiatan = Activity::all();
        $kegiatans = Division::pluck('name', 'id');
        return view('activity.activity',compact('datakegiatan', 'kegiatans'));
    }

    public function activityexport()
    {
        return Excel::download(new ActivityExport,'data-kegiatan.xlsx');
    }

    public function downloadTemplate()
    {
        return Excel::download(new CustomActivityTemplateExport, 'custom_activity_template.xlsx');
    }

    public function activityimport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataActivity', $nameFile);

        Excel::import(new ActivityDivisionImport, public_path('/DataActivity/'.$nameFile));
        return redirect('activity')->with('success', 'Data Berhasil Di Import!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('activity.add-activity');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Activity::create([
            'name'=>$request->name,
            'finance_code'=>$request->finance_code,
            'division_id'=>$request->division,
        ]);

        return redirect('activity')->with('success', 'Tambah Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Activity $activity, string $id)
    {
        $this->authorize('update', $activity);
        $kegiatan = Activity::findorfail($id);
        return view('activity.edit-activity', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Activity::findorfail($id);
        $kegiatan->update($request->all());

        return redirect('activity')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Activity $activity, string $id)
    {
        $this->authorize('delete', $activity);
        $kegiatan = Activity::findorfail($id);
        $kegiatan->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }

}
