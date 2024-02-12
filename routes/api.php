<?php

use App\Http\Controllers\Api\V1\BookController as BookV1;
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

Route::apiResource('v1/books', BookV1::class)
    ->only(['index', 'show', 'destroy', 'update', 'store'])
    ->middleware('auth:sanctum');

Route::post('login', [App\Http\Controllers\Api\LoginController::class, 'login']);