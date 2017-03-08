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
//Route::model('comments','Comment');
//Route::get('api/admin', ['as' => 'admin', 'middleware'=>'ajax', 'uses' => 'RoleController@index']);
Route::get('/', function(){
	return view('welcome');
});
//Route::get('home', 'HomeController@index');
Route::get('/logout', 'VideosController@logout');
Route::get('resources/videos/{class}/{instructor}/{file}', 'ResourceController@getVideo');
Route::get('/videos/search','VideosController@search');
Route::resource('videos', 'VideosController');
Route::get('/videos/class/{class}', 'VideosController@getClass');
Route::get('/menu','MenuController@menuList');
Route::get('/play/{class}/{instructor}/{file}','PlayerController@playVideo');
#Route::resource('comments', 'CommentsController');

Route::post('addComment', array('uses' => 'CommentsController@addComment'));
Route::post('addReply', array('uses' => 'CommentsController@addReply'));
Route::get('editComment', array('uses' => 'CommentsController@editComment'));
Route::post('editCommentStatus', array('uses' => 'CommentsController@editCommentStatus'));
Route::get('showReplies', array('uses' => 'CommentsController@showReplies'));
Route::get('showComments', array('uses' => 'CommentsController@showComments'));
Route::get('filter', array('uses' => 'CommentsController@filter'));
//Route::post('filter', array('uses' => 'CommentsController@filter'));
//Route::get('/videos/CommentsController/showReplies','CommentsController@showReplies');
//Route::get('/editComments/{slag}','CommentsController@editComment');
// Route::bind('comments', function($value, $route){
// 		return App\Comment::whereSlug($value)->first();
// 	});
//Route::post('/comments/store', 'CommentsController@store');
// Route::post('comments', [
// 	    'as' => 'comments.store',
// 	    'uses' => 'CommentsController@store',
// 	]);
//changed from remote edit
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

// added by buddha for dynamic dropdown - start
// Route::get('api/dropdown', function(){
//   $input = Input::get('class');
//
// 	$res = "Introduction";
// 	return Response::$res;
// });
// added by buddha for dynamic dropdown - end
