<?php

use App\Http\Controllers\StudentCardController;
use Illuminate\Support\Facades\Route;

/** prefix student-cards */
Route::get('/create', [StudentCardController::class, 'create'])->name('create');
Route::post('/', [StudentCardController::class, 'store'])->name('store');
