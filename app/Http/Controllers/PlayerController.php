<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Xavrsl\Cas\Facades\Cas;
use Illuminate\Http\Request;
use App\Helpers\AuthHelper;

class PlayerController extends Controller {
	public function playVideo($classname, $instructorname, $filename){
		$path = "https://miro.asu.edu/videos/vidman".'/'.$classname.'/'.$instructorname.'/'.$filename;
		return view('videos.player',compact('path'));
	}
}
