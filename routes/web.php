<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasteController;
//Route pubblica ritorna la home welcome
Route::get('/', function () {
    return view('welcome');
});
Route::middleware('guest')->group(function () {

    //Route Registrazione
    Route::get('/register',[App\Http\Controllers\AuthController::class,'show_register_form'])->name('register');//gli sto dicendo di accedere alla funzione name() e quella funzione gli assegnarà il nome al suo interno alla route
    Route::post('/register',[App\Http\Controllers\AuthController::class,'register'])->name('register.submit');

    //Route Login
    Route::get('/login',[App\Http\Controllers\AuthController::class,'show_login_form'])->name('login');
    Route::post('/login',[App\Http\Controllers\AuthController::class,'login'])->name('login.submit');

    //Route Email
    Route::get('/email',[App\Http\Controllers\AuthController::class,'show_email_form'])->name('email');
    Route::post('/email',[App\Http\Controllers\AuthController::class,'email'])->name('email.submit');

    //Route Password reset
    Route::get('/password',[App\Http\Controllers\AuthController::class,'show_password_reset_form'])->name('password.reset');
    Route::post('/password',[App\Http\Controllers\AuthController::class,'password'])->name('password.submit');


});

//Autenticazione
Route::middleware('auth')->group(function () {

    //Route Pastebin o 'Mbizzica'
    Route::get('/paste/create',[App\Http\Controllers\PasteController::class,'create'])->name('paste.create');
    Route::get('/paste/{paste:slug}',[App\Http\Controllers\PasteController::class,'show'])->name('paste.show');
    Route::post('/paste/store',[App\Http\Controllers\PasteController::class,'store'])->name('paste.store');
    //Route::delate('/paste/{paste}',[App\Http\Controllers\PasteController::class,'destroy'])->name('paste.destroy');

    Route::get('/home',[App\Http\Controllers\AuthController::class,'show_home_form'])->name('home');

    Route::post('/logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout.submit');
});
