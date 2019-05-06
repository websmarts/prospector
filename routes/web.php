<?php

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

Route::get('/','WelcomeController@index')->name('welcome');

Auth::routes();

// a GET logout for convenience while developing
Route::get('/logout','Auth\LoginController@logout');

Route::middleware('auth')->get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->get('/campaign', 'CampaignController@index')->name('campaign');
Route::middleware('auth')->post('/campaign', 'CampaignController@store')->name('create_campaign');
