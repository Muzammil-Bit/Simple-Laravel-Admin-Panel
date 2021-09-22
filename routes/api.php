<?php

use App\Http\Controllers\API\ArticleController;
use App\Http\Controllers\API\PollsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'ensure.request.is.from.app'], function () {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{article_id}', [ArticleController::class, 'show']);

    Route::post('/polls', [PollsController::class, 'index']);
});
