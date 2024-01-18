<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegistrationController;
use App\Http\Controllers\API\ProductListController;
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

Route::as('auth:')->group(function (){
    Route::post('/register', RegistrationController::class)->name('register');
    Route::post('/login', LoginController::class)->name('login');
});

Route::middleware('auth:sanctum')->group(function (){
    Route::as('products')->get('/products', ProductListController::class)->name('list');
});
