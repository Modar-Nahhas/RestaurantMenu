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
//Route::apiResource('/categories', CategoryController::class)->only([
//    'index'
//]);
//Route::apiResource('/sub-categories', SubCategoryController::class)->only([
//    'index'
//]);
//Route::apiResource('/discounts', DiscountController::class)->only([
//    'index'
//]);
//Route::apiResource('/items', ItemController::class)->only([
//    'index'
//]);
//Route::apiResource('/menus', MenuController::class)->only([
//    'index'
//]);
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/categories/valid-parents', [CategoryController::class, 'getValidParentCategories']);
    Route::get('/categories/valid-items', [CategoryController::class, 'getValidItemCategories']);
    Route::apiResource('/categories', CategoryController::class)->except([
        'destroy'
    ]);
    Route::apiResource('/sub-categories', SubCategoryController::class)->only([
        'index', 'store'
    ]);
    Route::apiResource('/discounts', DiscountController::class)->except([
        'destroy'
    ]);
    Route::apiResource('/items', ItemController::class)->only([
        'index', 'store'
    ]);
    Route::apiResource('/menus', MenuController::class)->only([
        'index', 'store', 'update'
    ]);
});
