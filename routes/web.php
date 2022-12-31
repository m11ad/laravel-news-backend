<?php

use Illuminate\Support\Facades\Route;
use App\NewsItem;
use App\Http\Controllers\NewsController;

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

Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news.index');
Route::get('/news/{newsItem}', 'App\Http\Controllers\NewsController@show')->name('news.show');
Route::post('/news', 'App\Http\Controllers\NewsController@store')->name('news.store');
Route::patch('/news/{newsItem}', 'App\Http\Controllers\NewsController@update')->name('news.update');
Route::delete('/news/{newsItem}', 'App\Http\Controllers\NewsController@destroy')->name('news.destroy');
Route::get('/news/create', 'App\Http\Controllers\NewsController@create')->name('news.create');
Route::get('/news/{newsItem}/edit', 'App\Http\Controllers\NewsController@edit')->name('news.edit');