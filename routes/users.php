<?php

use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/index', [UsersController::class, 'index'])->name('users');
Route::post('/store', [UsersController::class, 'store'])->name('user.store');
Route::get('/view/{id}', [UsersController::class, 'view'])->name('user.view');
Route::post('/update', [UsersController::class, 'update'])->name('user.update');
Route::post('/changestatus', [UsersController::class, 'changeStatus'])->name('user.changestatus');
Route::post('/storeRole', [UsersController::class, 'storeRole'])->name('user.storeRole');
Route::delete('/removeRole/{uid}/{rid}', [UsersController::class, 'deleteUserRole'])->name('user.removeRole');
