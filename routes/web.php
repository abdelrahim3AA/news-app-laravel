<?php

use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\PostController;
use App\Http\Controllers\Website\IndexController;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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

/// Website
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::group(['prefix' => '/website', 'as' => 'website.'], function() {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    // This handles displaying the categories index page
    Route::get('/categories', [\App\Http\Controllers\Website\CategoryController::class, 'index'])->name('categories.index');
    // This handles displaying the single category page
    Route::get('/categories/{category}', [\App\Http\Controllers\Website\CategoryController::class, 'show'])->name('categories.show');
    // This handles displaying the single post page
    Route::get('/posts/{post}', [\App\Http\Controllers\Website\PostController::class,'show'])->name('posts.show');
});

/// Dashboard
Route::group(['prefix'  => 'dashboard', 'as' => 'dashboard.', 'middleware' => ['auth', 'CheckUserStatus']], function () {

    Route::get('/', function() {
        return view('dashboard.index');
    })->name('index');

    Route::get('/settings', [SettingController::class, 'index'])->name('settings');

    Route::post('/settings/update/{setting}', [SettingController::class, 'update'])
    ->name('settings.update');
    
    Route::resources([
        'users' => UserController::class,
        'categories' => CategoryController::class,
        'posts' => PostController::class,
    ]);

});

require __DIR__.'/auth.php';