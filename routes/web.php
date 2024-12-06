<?php

use App\Http\Controllers\Auth\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/_register', [RegisterUserController::class, 'showRegistrationPage'])->name('show.register');
Route::post('/auth/_register', [RegisterUserController::class, 'processRegistration'])->name('process.register');

Route::get('/auth/_login', []);
Route::post('/auth/_login', []);
