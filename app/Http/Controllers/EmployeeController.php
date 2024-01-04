<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use App\Models\Division;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CustomEmployeeTemplateExport;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datapegawai = Employee::all();
        $divisions = Division::all();
        $users = User::all();
        return view('employee.employee',compact('datapegawai','divisions', 'users'));
    }

    public function employeeexport()
    {
        return Excel::download(new EmployeeExport,'data-pegawai.xlsx');
    }

    public function downloadCustomTemplate()
    {
        return Excel::download(new CustomEmployeeTemplateExport, 'custom_employee_template.xlsx');
    }

    public function employeeimport(Request $request)
    {
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move('DataEmployee', $nameFile);

        Excel::import(new EmployeeImport, public_path('/DataEmployee/'.$nameFile));
        return redirect('employee')->with('success', 'Data Berhasil Di Import!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.add-employee');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Buat user baru
    $newUser = User::create([
        'email' => $request->email,
        'username' => $request->username,
        'password' => bcrypt($request->password),
    ]);

    // Buat pegawai dengan merujuk ke user yang baru dibuat
    $pegawai = Employee::create([
        'nama' => $request->nama,
        'division_id' => $request->division_id,
        'NIP' => $request->NIP,
        'pangkat' => $request->pangkat,
        'user_id' => $newUser->id, // Ambil id user yang baru dibuat
    ]);

    return redirect('employee')->with('success', 'Tambah Data Berhasil!');

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
        $pegawai = Employee::findorfail($id);
        return view('employee.edit-employee', compact('pegawai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Employee::findorfail($id);
        $pegawai->update();

        return redirect('employee')->with('success', 'Data Berhasil Update!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pegawai = Employee::findorfail($id);
        $pegawai->delete();

        return back()->with('info', 'Data Berhasil Dihapus!');
    }
}
