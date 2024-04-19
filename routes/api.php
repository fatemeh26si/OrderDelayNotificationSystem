<?php

use App\Http\Controllers\Api\V1\User\DelayReportController;
use App\Http\Controllers\Api\V1\Agent\DelayReportController as AgentDelayReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::middleware([/*'user'*/])->prefix('/v1')->name('v1.')->group(function () {
    Route::post('/delay-report', [DelayReportController::class, 'submitDelayReport'])->name('submit-delay-report');
});

Route::middleware([/*'agent'*/])->prefix('/v1/agent')->name('v1.agent.')->group(function () {
    Route::prefix('/delay-report')->name('delay-report.')->group(function () {
        Route::post('/request-assign', [AgentDelayReportController::class, 'requestAssign'])->name('request-assign-delay-report');
        Route::get('/vendor', [AgentDelayReportController::class, 'vendorDelayReport'])->name('get-vendors-delay-report');
    });
});
