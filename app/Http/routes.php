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
Route::model('roles', 'Role');
//Route::get('api/admin', ['as' => 'admin', 'middleware'=>'ajax', 'uses' => 'RoleController@index']);
Route::get('/', function(){
	return view('welcome');
});
Route::get('home', 'HomeController@index');
Route::get('/logout', 'VideosController@logout');
Route::get('resources/videos/{class}/{instructor}/{file}', 'ResourceController@getVideo');
Route::post('/videos/search/{search}','VideosController@search');
Route::resource('videos', 'VideosController');

/*
Route::post('register', function(){
	alert("inside routes");
	if(Request::ajax()){
		return Response::json(Request::all());
	}
});
*/
/*Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);*/
Route::bind('videos', function($value, $route){
		return App\Video::whereSlug($value)->first();
	});
/*//Admin routes
Route::get('admin/index', function() {
  return View::make('admin');
});*/
//Route::controller('admin/index', 'AdminController');
/* Roles Routes
Route::get('/roles', 'RolesController@index');
Route::get('/roles/create', 'RolesController@create');
Route::get('/roles/{id}', 'RolesController@show');
Route::post('roles', 'RolesController@store');
*/


Route::resource('roles', 'RolesController' );

Route::bind('roles', function($value, $route){
		return App\Role::findOrFail($value);
	});
