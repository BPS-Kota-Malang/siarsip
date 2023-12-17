<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/kegiatan',[App\Http\Controllers\KegiatanController::class, 'index'])->name('kegiatan');
Route::get('/add-kegiatan',[App\Http\Controllers\KegiatanController::class, 'create'])->name('add-kegiatan');
Route::post('/save-kegiatan',[App\Http\Controllers\KegiatanController::class, 'store'])->name('save-kegiatan');
Route::get('/edit-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'edit'])->name('edit-kegiatan');
Route::post('/update-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'update'])->name('update-kegiatan');
Route::get('/delete-kegiatan,{id}',[App\Http\Controllers\KegiatanController::class, 'destroy'])->name('delete-kegiatan');

