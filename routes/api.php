<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\AuthController;

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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

    Route::post('/reset', [ResetController::class, 'reset'])->name('home')->name('home');

    Route::post('/createcustomer', [CustomersController::class, 'store'])->name('home');

    Route::get('/createcustomer', [CustomersController::class, 'show'])->name('home');

    Route::delete('/createcustomer', [CustomersController::class, 'delete'])->name('home');


    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/register', [AuthController::class, 'store'])->name('home');