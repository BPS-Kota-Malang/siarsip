<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/index', function () {
    return view('index');
});

Route::post('/logout', [AuthController::class, 'logout']);
Route::get('/logout', function () {
    return view('auth.logout');
})->name('logout');

Route::get('/user-profile', [UserController::class, 'showProfile'])->name('user-profile');
Route::post('/user-profile', [UserController::class, 'update_profile']);
Route::get('/user-profile', function () {
    return view('user.user-profile');
})->name('user-profile');

Route::get('/kegiatan',[App\Http\Controllers\KegiatanController::class, 'index'])->name('kegiatan');
Route::get('/add-kegiatan',[App\Http\Controllers\KegiatanController::class, 'create'])->name('add-kegiatan');
Route::post('/save-kegiatan',[App\Http\Controllers\KegiatanController::class, 'store'])->name('save-kegiatan');
Route::get('/edit-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'edit'])->name('edit-kegiatan');
Route::post('/update-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'update'])->name('update-kegiatan');
Route::get('/delete-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'destroy'])->name('delete-kegiatan');
