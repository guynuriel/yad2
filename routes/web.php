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
$ads_controller = 'App\Http\Controllers\AdsController@';

Route::get('/', $ads_controller.'index')->name('index');

// middleware('guest'); 


//עמוד יצירה
Route::get('/ads/create', $ads_controller.'create')->name('ads.create');

// פקודת יצירת דאטה
Route::post('/', $ads_controller.'store')->name('ads.store');

// תצוגת עמוד ספציפי
Route::get('/ads/{id}', $ads_controller.'show');

// תצוגת עמוד עריכה
Route::get('/ads/{id}/edit', $ads_controller.'edit');

// פקודת עדכון
Route::put('/ads/{id}', $ads_controller.'update');

// פקודת מחיקה
Route::delete('/ads/{id}', $ads_controller.'destroy');

// החזרת תמונות לפופ אפ בעמוד הראשי
Route::get('/ajax/popupimgs', $ads_controller.'get_images');


Auth::routes([
    'register' => true,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
