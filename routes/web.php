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

Route::group(['prefix' => '' , 'middleware' => 'auth'], function () {
    Route::get('/post/create', 'PostController@create');
    Route::post('/post/store', 'PostController@store');
    Route::post('/post/update/{id}', 'PostController@update');
    Route::get('/post/edit/{id}', 'PostController@edit');
    // Route::get('/verify', 'PostController@verify');
    Route::delete('/post/delete/{id}', 'PostController@destroy');
    // Route::post('/post/verify/{id}', 'PostController@ok');
    Route::get('/index', 'PostController@index')->name('post.index');
    Route::get('/contact', 'ContactController@index');
    Route::delete('/contact/delete/{id}', 'ContactController@destroy');
});



Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
