<?php

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



Route::post('register', 'API\RegisterController@register');
Route::post('login', 'API\RegisterController@login');
Route::resource('posts', 'API\PostController');

Route::get('image/{id}', 'API\PostController@see');




Route::group(['prefix' => '' ], function () {
    Route::get('resturants', 'API\PostController@resturants');
    Route::get('hotels', 'API\PostController@hotels');
    Route::get('cafes', 'API\PostController@cafes');
    Route::get('historic', 'API\PostController@historic');
    Route::get('malls', 'API\PostController@malls');
    Route::get('entertainment', 'API\PostController@entertainment');
});



Route::middleware('auth:api')->group( function(){
    // Route::post('upload', 'API\PostController@store');
    Route::resource('contacts', 'API\ContactController');
} );



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});






