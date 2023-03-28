<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FeedsController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SocialShareButtonsController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('login', [AuthController::class, 'index']);
Route::post('post-login', [AuthController::class, 'postLogin']);
Route::get('registration', [AuthController::class, 'registration']);
Route::post('post-registration', [AuthController::class, 'postRegistration']);
Route::get('dashboard', [AuthController::class, 'dashboard']);
Route::get('logout', [AuthController::class, 'logout']);
//FEEDS ROUTES
Route::get('/feeds', [FeedsController::class, 'feedForm'])->middleware('check');
Route::post('/feeds-store', [FeedsController::class, 'storeFeedsData']);
Route::get('/feeds-show', [FeedsController::class, 'fetchFeedsData'])->middleware('check');

//like, comments ,share routes

Route::post('/like', [FeedsController::class, 'likeFeedsPosts']);

Route::get('/social-media-share', [SocialShareButtonsController::class,'ShareWidget']);

Route::get('/feeds-details/{id}', [FeedsController::class, 'feedsDetails'])->name('details.show');

Route::post('/comment-store', [CommentController::class, 'commentStore']);