<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StationController;
use App\Http\Controllers\Api\VehicleController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/stations', [StationController::class, 'index'])->name('apiIndexStations');
Route::post('/stations', [StationController::class, 'store'])->name('apiStoreStations');
Route::get('/stations/{id}', [StationController::class, 'show'])->name('apiShowStations');
Route::put('/stations/{id}', [StationController::class, 'update'])->name('apiUpdateStations');
Route::delete('/stations/{id}', [StationController::class, 'destroy'])->name('apiDestroyStations');

Route::get('/vehicles', [VehicleController::class, 'index'])->name('apiIndexVehicles');
Route::post('/vehicles', [VehicleController::class, 'store'])->name('apiStoreVehicles');
Route::get('/vehicles/{id}', [VehicleController::class, 'show'])->name('apiShowVehicles');
Route::put('/vehicles/{id}', [VehicleController::class, 'update'])->name('apiUpdateVehicles');
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy'])->name('apiDestroyVehicles');

Route::get('/vehicles/{id}/toll-paid', [VehicleController::class, 'totalTollPaid'])->name('apiTotalTollPaid');