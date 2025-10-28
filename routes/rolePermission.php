<?php

use App\Http\Controllers\RolePermissionsController;
use Illuminate\Support\Facades\Route;

Route::prefix('role-permission')->group(function () {
    // role & permissions route
    // role route
    Route::get('/roles', [RolePermissionsController::class, 'roleList'])->name('roles');
    Route::get('/role.modal', [RolePermissionsController::class, 'roleModal'])->name('role.add');
    Route::post('/role.storeRole', [RolePermissionsController::class, 'storeRole'])->name('role.storeRole');
    Route::post('/role.updateRole', [RolePermissionsController::class, 'updateRole'])->name('role.updateRole');
    Route::post('/role.deleteRole', [RolePermissionsController::class, 'deleteRole'])->name('role.deleteRole');

    Route::get('/permission', [RolePermissionsController::class, 'permissionList'])->name('permission');
    Route::get('/permission.modal', [RolePermissionsController::class, 'permissionModal'])->name('permission.add');
    Route::post('/permission.storePermission', [RolePermissionsController::class, 'storePermission'])->name('permission.storepermission');
    Route::post('/permission.updatePermission', [RolePermissionsController::class, 'updatePermission'])->name('permission.updatePermission');
    Route::post('/permission.deletePermission', [RolePermissionsController::class, 'deletePermission'])->name('permission.deletePermission');
});
