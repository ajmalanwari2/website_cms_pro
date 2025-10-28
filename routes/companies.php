<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role_or_permission:Company - All Company|Company - Add New Company|Company - View Company|Company - Edit Company|Company - Delete Company|Company - Pdf All Company']], function () {
    Route::prefix('company')->group(function () {
        Route::get('/companies', [CompanyController::class, 'index'])->name('companies');
        Route::get('/add-company-add', [CompanyController::class, 'companyModal'])->name('broker.add');
        Route::post('/add-company', [CompanyController::class, 'store'])->name('company.store');
        Route::get('/view-company/{id}', [CompanyController::class, 'view'])->name('company.view');
        Route::post('/update-company', [CompanyController::class, 'update'])->name('company.update');
        Route::post('/delete_company', [CompanyController::class, 'destroy'])->name('deleteCompany')->middleware('role_or_permission:Company - Delete Company');
    });
});
