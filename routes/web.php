<?php

use Illuminate\Support\Facades\Route;

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

// /news: Displays a list of news items (handled by the index action of the NewsController)
Route::get('/news', 'NewsController@index')->name('news.index');

// /news/{newsItem}: Displays a specific news item (handled by the show action of the NewsController)
Route::get('/news/{newsItem}', 'NewsController@show')->name('news.show');

// /news: Creates a new news item (handled by the store action of the NewsController)
Route::post('/news', 'NewsController@store')->name('news.store');

// /news/{newsItem}: Updates an existing news item (handled by the update action of the NewsController)
Route::patch('/news/{newsItem}', 'NewsController@update')->name('news.update');

// /news/{newsItem}: Deletes an existing news item (handled by the destroy action of the NewsController)
Route::delete('/news/{newsItem}', 'NewsController@destroy')->name('news.destroy');