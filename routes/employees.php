<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role_or_permission:Employee - All Employee|Employee - Add New Employee|Employee - View Employee|Employee - Edit Employee|Employee - EnableDisable Employee|Employee - Delete Employee|Employee - Pdf All Employee']], function () {
    Route::prefix('employee')->group(function () {
        Route::get('/index', [EmployeeController::class, 'index'])->name('employees');
        Route::get('/add', [EmployeeController::class, 'employeeModal'])->name('employee.add')->middleware('role_or_permission:Employee - Add New Employee');
        Route::post('/store-employee', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/view-employee/{id}', [EmployeeController::class, 'view'])->name('employee.view');
        Route::post('/update-employee', [EmployeeController::class, 'update'])->name('employee.update');
        Route::post('/enableDisable', [EmployeeController::class, 'enableDisableEmployee'])->name('enable-disable-employee');
        Route::post('/delete_employee', [EmployeeController::class, 'destroy'])->name('deleteEmployee')->middleware('role_or_permission:Employee - Delete Employee');
    });
});
