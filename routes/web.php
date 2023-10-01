<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MetaInfoController;
use App\Http\Controllers\MetaTagController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminAdminLoginedMiddleware;
use Illuminate\Support\Facades\Route;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

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
    'middleware' => ['auth']
], function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('profile', [UserController::class, 'profile'])->name('profile');
    Route::get('edit-password', [UserController::class, 'editPassword'])->name('edit-password');
    Route::post('update-password', [UserController::class, 'updatePassword'])->name('update-password');

    Route::resource('tags', MetaTagController::class);
    Route::resource('blogs', BlogController::class);
    Route::resource('rooms', RoomController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class)->middleware(AdminAdminLoginedMiddleware::class);

    Route::group(['prefix' => 'meta-info'], function () {
        Route::get('info', [MetaInfoController::class, 'index'])->name('metaInfo.index');
        Route::post('info', [MetaInfoController::class, 'store'])->name('metaInfo.store');

        Route::get('slide', [MetaInfoController::class, 'slides'])->name('metaInfo.slide');
        Route::post('slide', [MetaInfoController::class, 'storeSlides'])->name('metaInfo.storeSlide');
    });

    Route::delete('media/{media}', [MediaController::class, 'delete'])->name('delete-media');
});
