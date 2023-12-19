<?php

use App\Http\Controllers\DivisionController;
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

Route::get('/forgot-password', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::get('/index', function () {
    return view('index');
});

Route::middleware(['web'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/user-profile', [UserController::class, 'showProfile'])->name('user-profile');
Route::post('/user-profile', [UserController::class, 'update_profile']);
Route::get('/user-profile', function () {
    return view('user.user-profile');
})->name('user-profile');


Route::get('/activity',[App\Http\Controllers\ActivityController::class, 'index'])->name('activity');
Route::get('/add-activity',[App\Http\Controllers\ActivityController::class, 'create'])->name('add-activity');
Route::post('/save-activity',[App\Http\Controllers\ActivityController::class, 'store'])->name('save-activity');
Route::get('/edit-activity,{id}',[App\Http\Controllers\ActivityController::class, 'edit'])->name('edit-activity');
Route::post('/update-activity,{id}',[App\Http\Controllers\ActivityController::class, 'update'])->name('update-activity');
Route::get('/delete-activity,{id}',[App\Http\Controllers\ActivityController::class, 'destroy'])->name('delete-activity');


//upload file
Route::get('/archive',[App\Http\Controllers\UploadController::class, 'index'])->name('archive');
Route::get('/add-file',[App\Http\Controllers\UploadController::class, 'create'])->name('add-file');
Route::post('/save-file',[App\Http\Controllers\UploadController::class, 'store'])->name('save-file');
Route::get('/edit-file,{id}',[App\Http\Controllers\UploadController::class, 'edit'])->name('edit-file');
Route::post('/update-file,{id}',[App\Http\Controllers\UploadController::class, 'update'])->name('update-file');
Route::get('/delete-file,{id}',[App\Http\Controllers\UploadController::class, 'destroy'])->name('delete-file');

Route::resource('division', DivisionController::class);
