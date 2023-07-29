<?php

use App\Http\Controllers\QuestionController;
use App\Http\Controllers\DataSetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/get-questions', [QuestionController::class, 'index']);

Route::post('store-user', [UserController::class, 'store']);

Route::post('data-set/store', [DataSetController::class, 'store']);
Route::get('data-set/export', [DataSetController::class, 'export']);
Route::get('data-set/get-score/{user_id}', [DataSetController::class, 'getScore']);