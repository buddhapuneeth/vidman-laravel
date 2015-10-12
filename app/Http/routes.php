<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
// Provide controller methods with object instead of ID
Route::model('videos', 'Video');
Route::get('/', 'WelcomeController@index');
Route::get('home', 'HomeController@index');
Route::get('/logout', 'VideosController@logout');
Route::get('resources/videos/{class}/{instructor}/{file}', 'ResourceController@getVideo');
Route::post('/videos/search/{search}','VideosController@search');
Route::resource('videos', 'VideosController');
/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
Route::bind('videos', function($value, $route){
		return App\Video::whereSlug($value)->first();
	});
