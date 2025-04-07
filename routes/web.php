<?php

use App\Http\Controllers\Person\PersonController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PersonController::class, 'index']);
Route::post('/add', [PersonController::class, 'store'])->name('people.store');
