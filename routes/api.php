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

Route::post("auth/login","AuthController@login");
Route::post("auth/register","AuthController@register");
Route::get('users',"UserController@index");
Route::get("users/profile","UserController@profile")->middleware("auth:api");
Route::get("users/{id}","UserController@profileById")->middleware("auth:api");

Route::post("post","PostContorller@store")->middleware("auth:api");
Route::patch("post/update/{post}","PostContorller@update")->middleware("auth:api");
Route::delete("post/delete/{post}","PostContorller@destroy")->middleware("auth:api");