<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Xavrsl\Cas\Facades\Cas;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;
use App\Topic;

class MenuController extends Controller {

	public function menuList(Request $request){

		// $classes = Video::distinct()->groupBy('class')->get();
		// //$topicsList = Video::distinct()->groupBy('topic')->get();
		// //$topicsList = Topic::distinct()->groupBy('course')->orderBy('priority','ASC')->get();
		// $topicsList = Video::join('topics',function($join){
		// 	$join->on('videos.topic','=','topics.topic')->On('videos.class','=','topics.course');
		// })->groupBy('topics.topic')->orderBy('priority', 'ASC')->get();
		// $menuList = Video::get();
		// $videos = Video::where('instructor','like', $squery)->orWhere('title', 'like', $squery)->orWhere('class', 'like', $squery)->orderBy('id', 'DESC')->paginate(15);
		// $data = Video::join('topics',function($join){
		// 	$join->on('videos.class','=','topics.course') ->on('videos.unit','=','topics.unit');
		// })->groupBy('topics.course')->orderBy('priority', 'ASC')->get();
		$data = Video::orderBy('order','ASC')->get();
	   $classes = Video::distinct()->groupBy('class')->get();
		 $menuList = Topic::orderBy('priority','ASC')->get();
		return view('videos.menu',compact('menuList','classes','data'));
		//return view('videos.menu', compact('videos'))->with('search', $search);
		//return view('videos.menu');
	}
}
