<?php

use Illuminate\Support\Facades\Auth;
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
$ads_controller = 'App\Http\Controllers\AdsController@';
$favorites_controller = 'App\Http\Controllers\FavoritesController@';


Route::get('/', $ads_controller.'index')->name('index');
// middleware('guest'); 

//עמוד יצירה
Route::get('/ads/create', $ads_controller.'create')->name('ads.create');

// פקודת יצירת דאטה
Route::post('/', $ads_controller.'store')->name('ads.store');

// תצוגת עמוד ספציפי
Route::get('/ads/{id}', $ads_controller.'show')->where('id', '[0-9]+');;

// תצוגת עמוד עריכה
Route::get('/ads/{id}/edit', $ads_controller.'edit')->where('id', '[0-9]+');

// פקודת עדכון
Route::put('/ads/{id}', $ads_controller.'update')->where('id', '[0-9]+');

// פקודת מחיקה
Route::delete('/ads/{id}', $ads_controller.'destroy')->where('id', '[0-9]+');

// החזרת תמונות לפופ אפ בעמוד הראשי
Route::get('/ajax/popupimgs', $ads_controller.'get_images');

Route::get('/favorites', $favorites_controller.'index');
Route::get('/favorites/like/{ad_id}', $favorites_controller.'like')->name('favorites.like');

Auth::routes([
    'register' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



