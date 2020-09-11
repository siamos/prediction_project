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

Route::get('/v1/predictions', 'PredictionsController@index');
Route::get('/v1/predictions/{prediction}', 'PredictionsController@show');
Route::post('/v1/predictions', 'PredictionsController@store');
Route::put('/v1/predictions/{prediction}/status', 'PredictionsController@update');
Route::delete('/v1/predictions/{prediction}', 'PredictionsController@delete');