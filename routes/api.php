<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/stations', [StationController::class, 'index'])->name('apiIndexStations');
Route::post('/stations', [StationController::class, 'store'])->name('apiStoreStations');
Route::get('/stations/{id}', [StationController::class, 'show'])->name('apiShowStations');
Route::put('/stations/{id}', [StationController::class, 'update'])->name('apiUpdateStations');
Route::delete('/stations/{id}', [StationController::class, 'destroy'])->name('apiDestroyStations');