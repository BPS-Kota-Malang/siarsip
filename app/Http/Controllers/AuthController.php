<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'username' => 'required',
        'password' => 'required',
    ], [
        'required' => ':attribute harus diisi.',
    ]);

    if ($validator->fails()) {
        return redirect('/login')
            ->withErrors($validator)
            ->withInput();
    }

    $user = User::where('username',$request->username)->first();

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $token = $user->createToken("auth-token")->plainTextToken;
            Auth::login($user);
            return redirect('/index')->with('success', 'Login berhasil!');
    } else {
        return redirect('/login')
            ->withErrors(['username' => 'Username atau password salah.'])
            ->withInput();
    }
}

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => ['required', 'min:3', 'max:225'],
        'username' => ['required', 'min:3', 'max:10'],
        'email' => 'required|email',
        'password' => 'required|min:5|max:255',
    ], [
        'required' => ':attribute harus diisi.',
        'email' => ':attribute harus berupa email yang valid.',
        'min' => 'panjang :attribute minimal :min karakter.',
    ]);

    if ($validator->fails()) {
        return redirect('/register')
            ->withErrors($validator)
            ->withInput();
    }

    if (User::where('username', $request->username)->exists() || User::where('email', $request->email)->exists()) {
        return redirect('/register')
            ->withErrors(['username' => 'Username atau email sudah digunakan.'])
            ->withInput();
    }

    $user = User::create([
        'name' => $request->name,
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
}

    }
