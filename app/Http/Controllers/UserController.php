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
    public function showProfile()
    {
        return view('user-profile');
    }

    public function update_profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'min:3', 'max:225'],
            'username' => ['required', 'min:3', 'max:10'],
            'email' => 'required|email',
        ], [
            'required' => ':attribute harus diisi.',
            'email' => ':attribute harus berupa email yang valid.',
            'min' => 'panjang :attribute minimal :min karakter.',
            ]);

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
            'username' => $request->username,
            'email' => $request->email,
        ]);
        return redirect('user-profile')->with('success', 'Profile Berhasil Update!');
    }
}

