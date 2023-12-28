<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datakegiatan = Activity::all();
        return view('activity.activity',compact('datakegiatan'));
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
            'division'=>$request->division,
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
    public function edit(string $id)
    {
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
    public function destroy(string $id)
    {
        $kegiatan = Activity::findorfail($id);
        $kegiatan->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }

}
