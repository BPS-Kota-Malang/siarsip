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
        $allEmployees = Employee::all();
        $divisions = Division::all();
        $users = User::all();

        return view('employee.employee',compact('allEmployees','divisions', 'users'));
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
       // Validasi form
        $request->validate([
        'nama' => 'required',
        'division_name' => 'required',
        'NIP' => 'required',
        'email' => ['required', 'email', 'regex:/^[a-zA-Z0-9._%+-]+@bps\.go\.id$/'],
        'pangkat' => 'required',
        'role' => 'required',
    ]);

        // Ambil username dari email menggunakan regex
        preg_match('/^[a-zA-Z0-9._%+-]+/', $request->email, $matches);
        $username = $matches[0];

        // Buat atau dapatkan pengguna berdasarkan email
        $user = User::firstOrCreate([
            'email' => $request->email,
        ], [
            'name' => $request->nama,
            'username' => $username,
            'password' => bcrypt('3573'), // Password default 3573
            'role' => $request->role,
    ]);

        // Temukan divisi berdasarkan nama
        $division = Division::where('name', $request->division_name)->first();

        // Jika divisi tidak ditemukan, buat baru
        if (!$division) {
            $division = Division::create([
                'name' => $request->division_name,
                'code' => uniqid(),
            ]);
        }

        // Simpan data pegawai
        $pegawai = Employee::create([
            'nama' => $request->nama,
            'division_id' => $division->id,
            'NIP' => $request->NIP,
            'user_id' => $user->id,
            'pangkat' => $request->pangkat,
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
        $divisions = Division::all();
        $users = User::all();
        return view('employee.edit-employee', compact('pegawai', 'divisions',  'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pegawai = Employee::findorfail($id);
        $pegawai->update([
            'nama' => $request->nama,
            'division_id' => $request->division_id,
            'NIP' => $request->NIP,
            'user_id' => $request->user_id,
            'pangkat' => $request->pangkat,
        ]);

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
