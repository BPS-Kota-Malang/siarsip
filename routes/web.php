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
    if (Auth::check()) {
        return redirect('/index');
    }
    return view('auth.login');
});

Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/index');
    }
    return view('auth.login');
})->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', function () {
    if (Auth::check()) {
        return redirect('/index');
    }
    return view('auth.register');
})->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/forgot-password', function () {
    if (Auth::check()) {
        return redirect('/index');
    }
    return view('auth.forgot-password');
})->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware(['auth','web','PreventBackHistory'])->group(function () {
Route::get('/index', function () {
    return view('index');
});

Route::get('/user-profile', function () {
    if (!Auth::check()) {
        return redirect('/login');
    }
    return view('user.user-profile');
})->name('user-profile');
Route::post('/user-profile', [UserController::class, 'update_profile']);

Route::get('/activity',[App\Http\Controllers\ActivityController::class, 'index'])->name('activity');
Route::get('/add-activity',[App\Http\Controllers\ActivityController::class, 'create'])->name('add-activity');
Route::post('/save-activity',[App\Http\Controllers\ActivityController::class, 'store'])->name('save-activity');
Route::get('/edit-activity,{id}',[App\Http\Controllers\ActivityController::class, 'edit'])->name('edit-activity');
Route::put('/update-activity,{id}',[App\Http\Controllers\ActivityController::class, 'update'])->name('update-activity');
Route::delete('/delete-activity,{id}',[App\Http\Controllers\ActivityController::class, 'destroy'])->name('delete-activity');
Route::get('/export-activity',[App\Http\Controllers\ActivityController::class, 'activityexport'])->name('export-activity');
Route::post('/import-activity',[App\Http\Controllers\ActivityController::class, 'activityimport'])->name('import-activity');

//upload file
Route::get('/archive',[App\Http\Controllers\ArchiveController::class, 'index'])->name('archive');
Route::get('/add-file',[App\Http\Controllers\ArchiveController::class, 'create'])->name('add-file');
Route::post('/save-file',[App\Http\Controllers\ArchiveController::class, 'store'])->name('save-file');
Route::get('/edit-file,{id}',[App\Http\Controllers\ArchiveController::class, 'edit'])->name('edit-file');
Route::put('/update-file,{id}',[App\Http\Controllers\ArchiveController::class, 'update'])->name('update-file');
Route::get('/delete-file,{id}',[App\Http\Controllers\ArchiveController::class, 'destroy'])->name('delete-file');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('division', DivisionController::class);

});
