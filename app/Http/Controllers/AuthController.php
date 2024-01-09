<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Cviebrock\EloquentSluggable\Services\SlugService;

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

        $remember = true;

        if (Auth::attempt(['username' => $request->username, 'password' => $request->password], $remember)) {
            $user = Auth::user();
            $request->session()->put('user_id', $user->id);

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
            'username' => ['required', 'max:225'],
            'email' => [
                'required',
                'email',
                'regex:/^[A-Za-z0-9._%+-]+@bps\.go\.id$/',
            ],
            'password' => 'required|min:5|max:255',
        ], [
            'required' => ':attribute harus diisi.',
            'email' => ':attribute harus berupa email yang valid dari domain BPS.',
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
                $user->tokens()->delete();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect('/login')->with(['status' => __($status)])
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function logout(Request $request)
    {
        $guard = 'web';

        Session::flush();

        Auth::guard($guard)->logout();

        return redirect('/login')->with('success', 'Terimakasih sudah logout! Silakan login kembali.');
    }

    public function checkSlug(Request $request)
    {
        $email = $request->input('email');
        $emailParts = explode('@', $email);
        $username = count($emailParts) > 0 ? $emailParts[0] : '';

        return response()->json(['username' => $username]);
    }
}
