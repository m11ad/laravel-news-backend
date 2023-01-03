<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\NewsItem;
use App\Http\Controllers\NewsController;
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


// Route::apiResource('news', 'App\Http\Controllers\NewsController');
Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news.index');
Route::get('/news/{newsItem}', 'App\Http\Controllers\NewsController@show')->name('news.show');
Route::post('/news', 'App\Http\Controllers\NewsController@store')->name('news.store');
Route::patch('/news/{newsItem}', 'App\Http\Controllers\NewsController@update')->name('news.update');
Route::delete('/news/{newsItem}', 'App\Http\Controllers\NewsController@destroy')->name('news.destroy');
