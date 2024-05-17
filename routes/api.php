<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['namespace' => 'API'], function () {

    Route::middleware(['auth:api'])->group(function () {
        Route::get('posts', 'PostsController@index');
        Route::post('posts', 'PostsController@store');
        Route::get('posts/{id}', 'PostsController@show');
        Route::put('posts/{id}', 'PostsController@update');
        Route::delete('posts/{id}', 'PostsController@destroy');
    });

    Route::group(['namespace' => 'Auth'], function () {
        Route::post('login', 'AuthController@login');
        Route::post('register', 'AuthController@register');
        Route::post('logout', 'AuthController@logout');
    });
});
