<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//route resource
Route::get('/UsuariosExports' , [\App\Http\Controllers\UsuariosController::class,'export'])->name('export');
Route::get('generate-pdf', [\App\Http\Controllers\UsuariosController::class,'generatePDF'])->name('generate-pdf');
Route::resource('/usuarios', \App\Http\Controllers\UsuariosController::class);
Route::resource('/posts', \App\Http\Controllers\PostController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
