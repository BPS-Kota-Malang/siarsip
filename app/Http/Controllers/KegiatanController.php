<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datakegiatan = Kegiatan::all();
        return view('kegiatan.kegiatan',compact('datakegiatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        return view('kegiatan.add-kegiatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        Kegiatan::create([
            'name'=>$request->name,
            'finance_code'=>$request->finance_code,
            'division'=>$request->division,
        ]);

        return redirect('kegiatan')->with('success', 'Tambah Data Berhasil!');
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
        $kegiatan = Kegiatan::findorfail($id);
        return view('kegiatan.edit-kegiatan', compact('kegiatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kegiatan = Kegiatan::findorfail($id);
        $kegiatan->update($request->all());

        return redirect('kegiatan')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = Kegiatan::findorfail($id);
        $kegiatan->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
