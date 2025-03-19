<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CacheAdvancedController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('clients', [CacheAdvancedController::class, 'clients']);
    Route::apiResource('users', App\Http\Controllers\Api\UserController::class);
    Route::apiResource('organisations', App\Http\Controllers\Api\OrganisationController::class);
    Route::apiResource('members', App\Http\Controllers\Api\MemberController::class);
    Route::apiResource('transaction_types', App\Http\Controllers\Api\TransactionTypeController::class);
    Route::apiResource('transactions', App\Http\Controllers\Api\TransactionController::class);
    Route::apiResource('transaction_files', App\Http\Controllers\Api\TransactionFileController::class);
    Route::apiResource('notifications', App\Http\Controllers\Api\NotificationController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});


