<?php

use Illuminate\Support\Facades\Route;
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

// $key = 'AIzaSyCc8JSGe1HhAcuPrJlP4Bk2-q9mUjaSzf0';

// $geocode = 'https://maps.googleapis.com/maps/api/geocode/json?address='.$TEXT.',+IL&key=';

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

