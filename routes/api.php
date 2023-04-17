<?php

use App\Http\Controllers\Beverage\BeverageController;
use App\Http\Controllers\BeverageType\BeverageTypeController;
use App\Http\Controllers\Companies\ProductionCompaniesController;
use App\Http\Controllers\Genre\GenreController;
use App\Http\Controllers\Movie\MovieController;
use App\Http\Controllers\Movie\MovieTrashController;
use App\Http\Controllers\Rank\RankController;
use App\Http\Controllers\Schema\SchemaController;
use App\Http\Controllers\Showtime\ShowtimeController;
use App\Http\Controllers\Theater\TheaterController;
use App\Http\Controllers\Ticket\TicketController;
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
    Route::prefix('schemas')->group(function(){
        Route::get('','index');
        Route::get('/{schema}','show');
    });
});

Route::prefix('movies/trashed')->group(function(){
    Route::get('',[MovieTrashController::class,'trash']);
    Route::get('/{movie}/restore',[MovieTrashController::class,'restoreMovie']);
    Route::delete('/{movie}/delete',[MovieTrashController::class,'forceDeleteMovie']);
    Route::get('/restore',[MovieTrashController::class,'restoreAllTrash']);
    Route::delete('/delete',[MovieTrashController::class,'forceDeleteAllTrash']);
});

Route::get('/production-companies',[ProductionCompaniesController::class,'index']);
Route::apiResource('/genres',GenreController::class);
Route::apiResource('/movies',MovieController::class);
Route::apiResource('/showtimes',ShowtimeController::class);
Route::apiResource('/tickets',TicketController::class);
Route::apiResource('/theaters',TheaterController::class);
Route::apiResource('/beverages',BeverageController::class);
Route::apiResource('/beverage-types',BeverageTypeController::class);

Route::get('ranks',[RankController::class,'index']);

Route::get('/debug', function(){
    //debug your code here
    
});
