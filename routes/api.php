<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CustomerContactController;
use App\Http\Controllers\Api\CustomerFeedbackController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\MetaInfoController;
use App\Http\Controllers\Api\MetaTagController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Api\RoomController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
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

Route::apiResource('rooms', RoomController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', MetaTagController::class)->only('index', 'show');
Route::apiResource('blogs', BlogController::class)->only('index', 'show');

Route::post('reservations', [ReservationController::class, 'store']);
Route::post('customer-contact', [CustomerContactController::class, 'store']);
Route::post('customer-feedback', [CustomerFeedbackController::class, 'store']);

Route::get('meta-info', [MetaInfoController::class, 'index']);
Route::get('home', [HomeController::class, 'index']);

Route::get('locations', [LocationController::class, 'index']);
Route::get('locations/{code}', [LocationController::class, 'search']);
Route::get('link', function () {
    Artisan::call('storage:link');
});