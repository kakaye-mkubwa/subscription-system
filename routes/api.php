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

// login
Route::post('/login', [\App\Http\Controllers\UserController::class, 'login']);
// register
Route::post('/register', [\App\Http\Controllers\UserController::class, 'register']);
// list users

Route::middleware('auth:sanctum')->group(function (){
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('subscription-websites', \App\Http\Controllers\SubscriptionWebsitesController::class);
    Route::resource('user-subscriptions', \App\Http\Controllers\UserSubscriptionController::class);
    Route::resource('cancel-requests', \App\Http\Controllers\CancellationRequestsController::class);
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class);
    Route::resource('payments', \App\Http\Controllers\PaymentsController::class);
    Route::resource('posts', \App\Http\Controllers\PostsController::class);
    Route::resource('user-subscriptions', \App\Http\Controllers\UserSubscriptionController::class);
});
