<?php

use App\Http\Controllers\AdvancedController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'advanced',
    'as' => 'advanced.',
    'middleware' => 'auth'
], function () {
    Route::get('index', [AdvancedController::class, 'index'])->name('index');
});
