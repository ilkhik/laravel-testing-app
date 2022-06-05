<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\TestsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingsController;

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



Route::middleware('auth')->group(function () {
    Route::get('/', [MainPageController::class, 'getMainPage']);
    
    Route::prefix('/tests')->group(function () {
        Route::get('', [TestsController::class, 'findAll']);
        
        Route::get('/create', [TestsController::class, 'getCreateTestPage'])->middleware('admin');
        Route::post('/create', [TestsController::class, 'createNewTest'])->middleware('admin');
        
        Route::get('/{id}', [TestsController::class, 'getById']);
        Route::post('/{id}', [TestsController::class, 'takeTest']);
    });
    
    Route::prefix('/users')->middleware('admin')->group(function () {
        Route::get('', [UsersController::class, 'getUsersPage']);
        Route::post('/{id}/role', [UsersController::class, 'changeRole']);
    });
    
    Route::prefix('/settings')->group(function () {
        Route::get('', [SettingsController::class, 'getSettingsPage']);
        Route::post('/password', [SettingsController::class, 'changePassword']);
    });
});


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'getLoginPage']);
    Route::post('/login', [LoginController::class, 'authenticate']);
    
    Route::get('/signup', [SignUpController::class, 'getSignupPage']);
    Route::post('/signup', [SignUpController::class, 'signUp']);
});


Route::get('/logout', [LoginController::class, 'logout']);