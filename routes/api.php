<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [\App\Http\Controllers\Api\BlogController::class, 'getToken'])->name('api.get_token');
Route::middleware(['auth:sanctum', 'throttle:10,1'])->group(function () {
    Route::apiResource('/blogs', \App\Http\Controllers\Api\BlogController::class);
});
