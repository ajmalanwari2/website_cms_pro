<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role_or_permission:Location - All Location|Location - Add New Location|Location - View Location|Location - Edit Location|Location - Delete Location|Location - Pdf All Location']], function () {
    Route::prefix('location')->group(function () {
        Route::get('/locations', [LocationController::class, 'index'])->name('locations');
        Route::get('/add-location-add', [LocationController::class, 'locationModal'])->name('location.add');
        Route::post('/add-location', [LocationController::class, 'store'])->name('location.store');
        Route::get('/view-location/{id}', [LocationController::class, 'view'])->name('location.view');
        Route::post('/update-location', [LocationController::class, 'update'])->name('location.update');
        Route::post('/delete_location', [LocationController::class, 'destroy'])->name('deleteLocation')->middleware('role_or_permission:Location - Delete Location');
    });
});
