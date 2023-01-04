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



//Simply Remove ->middleware('cache.headers'); if you don't want it do be 1


Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news.index')->middleware('cache.headers');
Route::get('/news/{newsItem}', 'App\Http\Controllers\NewsController@show')->name('news.show')->middleware('cache.headers');
Route::get('/categories/', 'App\Http\Controllers\CategoryController@index')->name('categories.index')->middleware('cache.headers');
Route::get('/categories/{id}', 'App\Http\Controllers\CategoryController@show')->name('categories.show')->middleware('cache.headers');
Route::post('/news', 'App\Http\Controllers\NewsController@store')->name('news.store');
Route::patch('/news/{newsItem}', 'App\Http\Controllers\NewsController@update')->name('news.update');
Route::delete('/news/{newsItem}', 'App\Http\Controllers\NewsController@destroy')->name('news.destroy');
