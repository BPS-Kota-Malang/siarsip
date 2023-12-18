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

Route::get('/activity',[App\Http\Controllers\ActivityController::class, 'index'])->name('activity');
Route::get('/add-activity',[App\Http\Controllers\ActivityController::class, 'create'])->name('add-activity');
Route::post('/save-activity',[App\Http\Controllers\ActivityController::class, 'store'])->name('save-activity');
Route::get('/edit-activity,{id}',[App\Http\Controllers\ActivityController::class, 'edit'])->name('edit-activity');
Route::post('/update-activity,{id}',[App\Http\Controllers\ActivityController::class, 'update'])->name('update-activity');
Route::get('/delete-activity,{id}',[App\Http\Controllers\ActivityController::class, 'destroy'])->name('delete-activity');

