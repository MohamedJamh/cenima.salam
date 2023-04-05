<?php

use App\Http\Controllers\Beverage\BeverageController;
use App\Http\Controllers\BeverageType\BeverageTypeController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\Schema\SchemaController;
use App\Http\Controllers\Theater\TheaterController;
use App\Models\Genre;
use App\Models\Image;
use App\Models\Movie;
use Illuminate\Http\Request;
use App\Models\ProductionCompany;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\HomeController;
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

Route::controller(HomeController::class)->group(function(){
    Route::prefix('home')->group(function(){
        Route::get('/popularMovie','popularMovie');
        Route::get('/upcomingMovie','upcomingMovies');
        Route::get('/premierMovie','premierMovies');
    });
});

Route::controller(SchemaController::class)->group(function(){
    Route::prefix('schema')->group(function(){
        Route::get('','index');
        Route::get('/{schema}','show');
    });
});

Route::apiResource('/genre',GenreController::class);
Route::apiResource('/movie',MovieController::class);
Route::apiResource('/theater',TheaterController::class);
Route::apiResource('/beverage',BeverageController::class);
Route::apiResource('/beverage-type',BeverageTypeController::class);

Route::get('/debug', function(){
    //debug your code here
    
});
