<?php

use App\Http\Controllers\AdvancedController;
use App\Http\Controllers\Api\MemberController;
use App\Http\Controllers\Api\OrganisationController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'advanced',
    'as' => 'advanced.',
    'middleware' => 'auth'
], function () {
    Route::get('index', [AdvancedController::class, 'index'])->name('index');
    Route::resource('organisations', OrganisationController::class);
    Route::resource('members', MemberController::class);
});
