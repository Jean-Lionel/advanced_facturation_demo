<?php

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clients', [CacheAdvancedController::class, 'clients']);
Route::apiResource('user', App\Http\Controllers\Api\UserController::class);
Route::apiResource('organisation', App\Http\Controllers\Api\OrganisationController::class);
Route::apiResource('member', App\Http\Controllers\Api\MemberController::class);
Route::apiResource('transaction-type', App\Http\Controllers\Api\TransactionTypeController::class);
Route::apiResource('transaction', App\Http\Controllers\Api\TransactionController::class);

Route::apiResource('transaction-file', App\Http\Controllers\Api\TransactionFileController::class);

Route::apiResource('notification', App\Http\Controllers\Api\NotificationController::class);
