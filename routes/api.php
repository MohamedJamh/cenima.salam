<?php

use App\Http\Controllers\Movie\MovieController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\AccountController;

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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::controller(AccountController::class)->group(function(){
    Route::post('request-password','requestPassword');
    Route::post('reset-password','resetPassword')->name('password.reset');
    Route::post('/email/verification-notification','verificationSent');
    Route::get('/email/verify/{id}/{hash}','verificationVerify')->name('verification.verify');
});

Route::controller(MovieController::class)->group(function(){
    Route::prefix('movie')->group(function(){
        Route::get('','popularMovie');
        Route::get('/upcoming','upcomingMovies');
        Route::get('/premier','premierMovies');
    });
});

Route::get('/debug', function(){
    //debug your code here
});
