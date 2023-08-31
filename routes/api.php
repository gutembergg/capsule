<?php

use App\Http\Controllers\Api\Courses\SubscribeController;
use App\Http\Controllers\Api\Events\IndexController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('events', IndexController::class)->name('events');
    Route::put('subscribe', SubscribeController::class)->name('subscribe');
});
