<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
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

Route::get('/news', [NewsController::class, 'all']);
Route::post('/news', [NewsController::class, 'store']);
Route::get('/filter', [NewsController::class, 'filter']);
Route::get('/news/{id}', [NewsController::class, 'index']);


Route::get('/categories', [CategoryController::class, 'all']);
Route::post('/categories', [CategoryController::class, 'store']);
