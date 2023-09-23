<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetaInfoController;
use App\Http\Controllers\MetaTagController;
use App\Http\Controllers\RoomController;
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


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'login']);

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => ['auth', AdminAdminLoginedMiddleware::class]
], function () {
    Route::resource('tags', MetaTagController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('rooms', RoomController::class);

    Route::group(['prefix' => 'meta-info'], function () {
        Route::get('info', [MetaInfoController::class, 'index'])->name('metaInfo.index');
        Route::post('info', [MetaInfoController::class, 'store'])->name('metaInfo.store');

        Route::get('slide', [MetaInfoController::class, 'slides'])->name('metaInfo.slide');
        Route::post('slide', [MetaInfoController::class, 'storeSlides'])->name('metaInfo.storeSlide');
    });
});
