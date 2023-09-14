<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetaTagController;
use App\Http\Middleware\AdminAdminLoginedMiddleware;
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

Route::get('/', function () {
    return view('master');
});
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LoginController::class, 'logout']);

Route::group([
    // 'middleware' => ['auth', AdminAdminLoginedMiddleware::class]
], function () {
    Route::resource('tags', MetaTagController::class);
    Route::resource('blogs', BlogController::class);
});
