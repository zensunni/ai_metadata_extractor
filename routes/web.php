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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});


App::bind('App\Services\GoogleCloudVision', function(){
  return new \App\Services\GoogleCloudVision(config('services.google_cloud_vision.key'));
});

// UI routes
Route::get('/images', 'ImagesController@index');
Route::get('/images/create', 'ImagesController@create');
Route::get('/images/{image}', 'ImagesController@show');

Route::post('/images', 'ImagesController@store');
Route::post('/images', 'ImagesController@store');

Route::delete('/images/{image}', 'ImagesController@destroy');
