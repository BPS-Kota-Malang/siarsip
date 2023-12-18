<?php

use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;

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

Route::get('/kegiatan',[App\Http\Controllers\KegiatanController::class, 'index'])->name('kegiatan');
Route::get('/add-kegiatan',[App\Http\Controllers\KegiatanController::class, 'create'])->name('add-kegiatan');
Route::post('/save-kegiatan',[App\Http\Controllers\KegiatanController::class, 'store'])->name('save-kegiatan');
Route::get('/edit-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'edit'])->name('edit-kegiatan');
Route::post('/update-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'update'])->name('update-kegiatan');
Route::get('/delete-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'destroy'])->name('delete-kegiatan');


//upload file
Route::get('/archive',[App\Http\Controllers\UploadController::class, 'index'])->name('archive');
Route::get('/add-file',[App\Http\Controllers\UploadController::class, 'create'])->name('add-file');
Route::post('/save-file',[App\Http\Controllers\UploadController::class, 'store'])->name('save-file');
Route::get('/edit-file,{id}',[App\Http\Controllers\UploadController::class, 'edit'])->name('edit-file');
Route::post('/update-file,{id}',[App\Http\Controllers\UploadController::class, 'update'])->name('update-file');
Route::get('/delete-file,{id}',[App\Http\Controllers\UploadController::class, 'destroy'])->name('delete-file');

