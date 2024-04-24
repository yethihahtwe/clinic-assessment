<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DomainController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\SubdomainController;
use App\Http\Controllers\Api\ClinicController;
use App\Http\Controllers\Api\AssessorController;

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
Route::post('login', [LoginController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('{id}/clinics', [ClinicController::class, 'index']);

    Route::get('{id}/assessors', [AssessorController::class, 'index']);
    Route::get('domains', [DomainController::class, 'index']);
    Route::get('subdomains', [SubdomainController::class, 'index']);
    Route::get('questions', [QuestionController::class, 'index']);
});
