<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

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

    $remember = true; // Sesuaikan dengan kebutuhan Anda

    if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
        $user = Auth::user();

        // Membuat dan menyimpan token "remember me"
        $token = $user->createToken("auth-token")->plainTextToken;
        $user->update(['remember_token' => $token]);

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

// Menampilkan form reset password
public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset-password')->with(
            ['email' => $request->email, 'token' => $token]
        );
    }

public function showLinkRequestForm(Request $request)
    {
        return view('auth.forgot-password');
    }
// Mengirim email tautan reset password
public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status)])
                    : back()->withErrors(['email' => __($status)]);
    }

// Menangani proses reset password
public function resetPassword(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:6',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
                'remember_token' => Str::random(60),
            ])->save();
            // Hapus token "remember me" setelah reset password
            $user->tokens()->delete();
        }
    );

    return $status == Password::PASSWORD_RESET
                ? redirect('/login')->with(['status' => __($status)])
                : back()->withErrors(['email' => [__($status)]]);
}

public function logout(Request $request)
{
    $guard = 'web'; // Sesuaikan dengan guard yang digunakan

    // Hapus seluruh cookie sesi
    Session::flush();

    // Logout pengguna
    Auth::guard($guard)->logout();

    return redirect('/login')->with('success', 'Terimakasih sudah logout! Silakan login kembali.');
}

}