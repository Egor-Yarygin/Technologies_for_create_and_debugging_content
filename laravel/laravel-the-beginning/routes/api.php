<?php

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



use App\Http\Controllers\Controller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;


Route::get('/api/products', [Controller::class, 'index']);
Route::post('/api/products', [Controller::class, 'store']);


Route::apiResource('categories', CategoryController::class);


Route::apiResource('comments', CommentController::class);


Route::apiResource('posts', PostController::class);


Route::apiResource('users', UserController::class);

