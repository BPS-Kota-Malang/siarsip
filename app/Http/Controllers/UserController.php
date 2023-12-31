<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        return view('index');
        // dd(auth()->user()->role);
    }

    public function showProfile()
    {
        return view('user-profile');
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:225'],
            'username' => ['required', 'min:3', 'max:10'],
            'email' => [
                'required',
                'email',
                'regex:/^[A-Za-z0-9._%+-]+@bps\.go\.id$/',
            ],
        ], [
            'required' => ':attribute harus diisi.',
            'email' => ':attribute harus berupa email yang valid dari domain BPS.',
            'min' => 'panjang :attribute minimal :min karakter.',
        ]);

        preg_match('/^[a-zA-Z0-9._%+-]+/', $request->email, $matches);
        $username = $matches[0];

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => Str::ucfirst($validator->errors()->first()),
                'data' => null
            ]);
        }

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
            'username' => $username,
            'email' => $request->email,
        ]);
        return redirect('user-profile')->with('success', 'Profile Berhasil Update!');
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|min:5|max:255',
            'confirm_password' => 'required|same:new_password',
        ], [
            'required' => ':attribute harus diisi.',
            'min' => 'panjang :attribute minimal :min karakter.',
            'same' => ':attribute tidak cocok dengan new password.',
        ]);

        if ($validator->fails()) {
            return redirect('user-profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::findOrFail(Auth::user()->id);

        // Memeriksa apakah current password sesuai dengan password di database
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect('user-profile')
                ->withErrors(['current_password' => 'Current password tidak sesuai.'])
                ->withInput();
        }

        // Update password jika current password sesuai
        $user->update([
            'password' => bcrypt($request->new_password),
        ]);

        return redirect('user-profile')->with('success', 'Password Berhasil Diperbarui!');
    }

    public function activity()
    {
        return view('activity.activity');
    }

    public function division()
    {
        return view('division.division');
    }

    public function archive()
    {
        return view('uploads.upload');
    }

    public function employee()
    {
        return view('employee.employee');
    }
}
