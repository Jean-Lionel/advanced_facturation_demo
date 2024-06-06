<?php

// use App\Http\Controllers\Hrm\EmployeeController;

use App\Http\Controllers\Hrm\BankController;
use App\Http\Controllers\Hrm\PayslipController;
// use App\Http\Controllers\Hrm\LeaveController;
// use App\Http\Controllers\Hrm\RetenueController;
// use App\Http\Controllers\Hrm\BankController;
// use App\Http\Controllers\Hrm\PosteController;
// use App\Http\Controllers\Hrm\DepartementController;
// use App\Http\Controllers\Hrm\TypeLeaveController;
// use App\Http\Controllers\Hrm\TypeRetenueController;
// use App\Http\Controllers\Hrm\IndeminityController;
use App\Http\Controllers\Hrm\BranchController;
use App\Http\Controllers\Hrm\TypeCotationController;
use App\Http\Controllers\Hrm\CotationController;
use App\Http\Controllers\Hrm\DepartementController;
use App\Http\Controllers\Hrm\EmployeeController;
use App\Http\Controllers\Hrm\IndeminityController;
use App\Http\Controllers\Hrm\LeaveController;
use App\Http\Controllers\Hrm\PosteController;
use App\Http\Controllers\Hrm\RetenueController;
use App\Http\Controllers\Hrm\TypeLeaveController;
use App\Http\Controllers\Hrm\TypeRetenueController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::resource('employee', EmployeeController::class);
    

    Route::get('payslip', [PayslipController::class, 'index'])->name('payslip.index');
    Route::get('payslip/show/{id}', [PayslipController::class, 'payslip'])->name('payslip.show');
    Route::get('payslip/report/salary', [PayslipController::class, 'payslip_report'])->name('payslip.reportSalary');
    Route::get('payslip/report/inss', [PayslipController::class, 'inss_report'])->name('payslip.reportInss');
    Route::get('payslip/report/ipr', [PayslipController::class, 'ipr_report'])->name('payslip.reportIpr');
    Route::post('payslip/generate', [PayslipController::class, 'generate'])->name('payslip.generate');
    Route::post('payslip/pay', [PayslipController::class, 'changeStatusToPayed'])->name('payslip.pay');
    Route::delete('payslip/delete', [PayslipController::class, 'destroy'])->name('payslip.delete');
    Route::post('payslip/regenerate', [PayslipController::class, 'regenerate'])->name('payslip.regenerate');

    Route::resource('leave', LeaveController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('cotation', CotationController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('retenue', RetenueController::class)->except([
        'create', 'edit'
    ]);

    Route::resource('poste', PosteController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('departement', DepartementController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('typeLeave', TypeLeaveController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('typeCotation', TypeCotationController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('typeRetenue', TypeRetenueController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('indeminity', IndeminityController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('bank', BankController::class)->except([
        'create', 'show', 'edit'
    ]);

    Route::resource('branch', BranchController::class)->except([
        'create', 'show', 'edit'
    ]);
});