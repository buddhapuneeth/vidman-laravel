<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Video;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Xavrsl\Cas\Facades\Cas;
use Illuminate\Http\Request;


class VideosController extends Controller {

	protected $rules = array(
			'title' => 'required',
			'instructorlast' => 'required',
			'instructorfirst' => 'required',
			'sem' => 'required',
			'topic' => 'required',
			'class' => 'required',
			'year' => 'required',
			'video' => 'required'
		);

	protected $messages = array(
			'title.required' => 'Error: Title is a mandatory field',
			'instructorlast.required' => 'Error: Instructor Last Name is a mandatory field',
			'instructorfirst.required' => 'Error: Instructor First Name is a mandatory field',
			'sem.required' => 'Error: Semester is a mandatory field', 
			'topic.required'=> 'Error: Topic is a mandatory field',
			'class.required' => 'Error: Topic is a mandatory field',
			'year.required' => 'Error: Semester/Year is a mandatory field',
			'video.required' => 'Error: Please choose a Video to upload'
 		);
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
	public function store(Request $request)
	{
			
			//Input Validation
			$this->validate($request, $this->rules, $this->messages);
			
			$instructor =  $request->input('instructorlast'). "" .substr($request->input('instructorfirst'), 0, 1). "" . substr($request->input('instructorfirst'), -1);
			$vid_name = $request->input('title') .'-'. $instructor .'-'. $request->input('class');
			$video_req = array(
					'slug' => $vid_name,
					'topic' => $request->input('topic'),
					'class' => $request->input('class'),
					'instructor' => $request->input('instructor'),
					'vid_url' => $request->input('title'). '.' . $request->file('video')->getClientOriginalExtension(),
					'title' => $request->input('title'),
					'isVerified' => FALSE,
					'created_at' => date("Y-m-d"),
					'created_by' => 'ravi',//Cas::getCurrentUser(),
					'tags' => $request->input('tags'),
					'semester' => $request->input('sem') . $request->input('year')
				);


		
		$newvid = new Video($video_req);
			
		$newvid->save();
 		print_r($newvid);

 		$request->file('video')->move(
        base_path() . '/resources/uploaded_videos/' . $request->input('class') . '/' . $instructor . '/', $newvid->vid_url
        );

		
		return Redirect::route('videos.index')->with('message', 'Video Uploaded');
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
	public function update($video, Request $request)
	{
		$input = array_except(Input::all(), '_method');
		
		$videdit = array(
					'vid_name' => $request->input('vid_name'),
					'topic' => $request->input('topic'),
					'class' => $request->input('class'),
					'instructor' => $request->input('instructor'),
					'title' => $request->input('title'),
					'isVerified' => FALSE,
					'created_at' => date("Y-m-d"),
					'created_by' => 'ravi',//Cas::getCurrentUser(),
					'tags' => '',
					'semester' => $request->input('sem') . $request->input('year')
				);



		$video->update($videdit);
		print_r($video);
		

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
