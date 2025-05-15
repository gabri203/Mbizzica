<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PasteController;
//Route pubblica ritorna la home welcome
Route::get('/', function () {
    return view('welcome');
});
//route accessibile ai guest
Route::middleware('guest')->group(function () {

    //Route Registrazione
    Route::get('/register',[App\Http\Controllers\AuthController::class,'show_register_form'])->name('register');//gli sto dicendo di accedere alla funzione name() e quella funzione gli assegnarà il nome al suo interno alla route
    Route::post('/register',[App\Http\Controllers\AuthController::class,'register'])->name('register.submit');

    //Route Login
    Route::get('/login',[App\Http\Controllers\AuthController::class,'show_login_form'])->name('login');
    Route::post('/login',[App\Http\Controllers\AuthController::class,'login'])->name('login.submit');

});

//Autenticazione
Route::middleware('auth')->group(function () {

    //Route Pastebin o 'Mbizzica'
    Route::get('/paste/create',[App\Http\Controllers\PasteController::class,'create'])->name('paste.create');
    Route::get('/paste/{paste:slug}',[App\Http\Controllers\PasteController::class,'show'])->name('paste.show');
    Route::post('/paste/store',[App\Http\Controllers\PasteController::class,'store'])->name('paste.store');

    //Route 2fa
    Route::get('/2fa/abilita',[App\Http\Controllers\AutenticazioneDueFattori::class,'autenticazione_due_fattori'])->name('2fa.abilita');
    Route::post('/2fa',[App\Http\Controllers\AutenticazioneDueFattori::class,'verify2fa'])->name('2fa.submit');

    //profilo
    Route::get('/profile',[App\Http\Controllers\AutenticazioneDueFattori::class,'show_profile'])->name('profile');

    //Route Logout
    Route::post('/logout',[App\Http\Controllers\AuthController::class,'logout'])->name('logout.submit');
});
