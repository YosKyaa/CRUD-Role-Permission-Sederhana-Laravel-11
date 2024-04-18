<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FakultasController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserController;
use App\Models\Fakultas;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
  'register' => false, // Registration Routes...
]);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'fakultas'], function () {
    Route::any('/', [FakultasController::class, 'index'])->name('fakultas_index')->middleware('auth');
    Route::get('/data', [FakultasController::class, 'data'])->name('fakultas_data');
    Route::delete('/delete', [FakultasController::class, 'delete'])->name('delete_fakultas');
    Route::any('/edit/{id}', [FakultasController::class, 'edit'])->name('fakultas_edit');
    Route::put('/update/{id}', [FakultasController::class, 'update'])->name('fakultas_update');
  });

Route::group(['prefix' => 'prodi'], function () {
    Route::any('/', [ProdiController::class, 'index'])->name('prodi_index')->middleware('auth');
    Route::get('/data', [ProdiController::class, 'data'])->name('prodi_data');
    Route::delete('/prodi', [ProdiController::class, 'delete'])->name('prodi_delete');
    Route::get('/edit/{id}', [ProdiController::class, 'edit'])->name('prodi_edit');
    Route::put('/update/{id}', [ProdiController::class, 'update'])->name('prodi_update');
  });

  Route::group(['prefix' => 'user'], function () {
    Route::any('/', [UserController::class, 'index'])->name('user.index')->middleware('auth');
    Route::get('/data', [UserController::class, 'data'])->name('user_data');
    Route::delete('/delete', [UserController::class, 'delete'])->name('user_delete');
    Route::get('/edit_user/{id}', [UserController::class, 'edit'])->name('user_edit');
    Route::put('/update_user/{id}', [UserController::class, 'update'])->name('user_update');
    
  });

  
