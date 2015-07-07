<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VideosController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$videos = Video::all();
		return view('videos.index', compact('videos'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('videos.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		echo implode(" ",$input);
		//Video::create( $input );
 
		//return Redirect::route('videos.index')->with('message', 'Video created');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($video)
	{
		return view('videos.show', compact('video'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($video)
	{
		return view('videos.edit', compact('video'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($video)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($video)
	{
		//
	}

}
