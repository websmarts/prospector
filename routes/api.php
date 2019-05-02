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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
    //     return $request->user();
    
    // });


Route::middleware('auth:api')->get('/', 'Api\\IndexController@index');  

Route::middleware('auth:api')->get('/prospect/{prospect}', 'Api\\ProspectController@fetch');
Route::middleware('auth:api')->patch('/prospect/{prospect}', 'Api\\ProspectController@update');

Route::middleware('auth:api')->post('/activity/', 'Api\\ActivityController@store');
Route::middleware('auth:api')->patch('/activity/{activity}', 'Api\\ActivityController@update');

Route::middleware('auth:api')->post('/contact/', 'Api\\ContactController@store');
Route::middleware('auth:api')->patch('/contact/{contact}', 'Api\\ContactController@update');

// Route::middleware('auth:api')->get('/tasksdue', 'Api\\TasksController@due');
