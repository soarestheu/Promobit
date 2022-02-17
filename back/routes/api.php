<?php

use Illuminate\Http\Request;

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

Route::group(['prefix' => 'base'], function(){

    Route::get('/', function(){
        return response()->json(["status" => "Online e rt"]);
    });
    
    Route::post('auth/login', 'AuthController@login');
    Route::get('/exportar', 'TagController@getDownload');

    Route::group(['middleware' => ['apiJwt']], function(){
        Route::get('me', "AuthController@me");
        Route::post('/product/verify', "ProductController@verifyTag");
        Route::resource("user", "UserController");
        Route::resource("product", "ProductController");
        Route::resource("tag", "TagController");
        Route::post('auth/logout', 'AuthController@logout');
    });
});