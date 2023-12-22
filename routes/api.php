<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\AuthController;

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

Route::post('/login', [AuthController::class, 'login']);
Route::apiResource('/categories', CategoryController::class)->only([
    'index'
]);
Route::apiResource('/sub-categories', CategoryController::class)->only([
    'index'
]);
Route::apiResource('/discounts', CategoryController::class)->only([
    'index'
]);
Route::apiResource('/items', CategoryController::class)->only([
    'index'
]);
Route::apiResource('/menus', CategoryController::class)->only([
    'index'
]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/categories/valid-parents', [CategoryController::class, 'getValidParentCategories']);
    Route::apiResource('/categories', CategoryController::class)->only([
        'store'
    ]);
    Route::apiResource('/sub-categories', CategoryController::class)->only([
        'store'
    ]);
    Route::apiResource('/discounts', CategoryController::class)->only([
        'store'
    ]);
    Route::apiResource('/items', CategoryController::class)->only([
        'store'
    ]);
    Route::apiResource('/menus', CategoryController::class)->only([
        'store'
    ]);
});
