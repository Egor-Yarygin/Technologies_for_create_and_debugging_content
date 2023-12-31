<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\MainController;

Route::get('/app_for_task1', [MainController::class, 'showApp']);

// Роут для отображения данных
Route::get('/data_for_task1', [MainController::class, 'showData']);

// Роут для отображения формы
Route::get('/form_for_task1', [MainController::class, 'showForm']);

// Роут для POST-запроса
Route::post('/post', [MainController::class, 'post']);
