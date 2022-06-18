<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
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

Route::post('register','App\Http\Controllers\Api\AuthController@register');
Route::post('login','App\Http\Controllers\Api\AuthController@login');


Route::post('user/update/password',[UserController::class,'updatePassword']);
Route::post('user/update/profile','App\Http\Controllers\Api\UserController@updateProfile');

