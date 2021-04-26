<?php

use App\Http\Controllers\CalenderController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CalenderController::class, 'index']);
Route::post('/', [CalenderController::class, 'search'])->name('search');
