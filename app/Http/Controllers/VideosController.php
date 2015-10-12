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
			'semester' => 'required',
			'year' => 'required',
			'topic' => 'required',
			'class' => 'required',
			'year' => 'required'
		);

	protected $file_rules = array(
			'video' => 'required');

	protected $messages = array(
			'title.required' => 'Error: Title is a mandatory field',
			'instructorlast.required' => 'Error: Instructor Last Name is a mandatory field',
			'instructorfirst.required' => 'Error: Instructor First Name is a mandatory field',
			'semester.required' => 'Error: Semester is a mandatory field', 
			'topic.required'=> 'Error: Topic is a mandatory field',
			'class.required' => 'Error: Topic is a mandatory field',
			'year.required' => 'Error: Semester/Year is a mandatory field',
			'video.required' => 'Error: Please choose a Video to upload',
			'year.required' => 'Error: Please select a year'
 		);
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$videos = Video::orderBy('id', 'DESC')->get();
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


	public function search(Request $request){
		$squery = '%'.(string)$request->input('search'). '%';
		print_r($squery);
		$videos = Video::where('instructor','like', $squery)->orWhere('title', 'like', $squery)->orderBy('id', 'DESC')->get();
	print_r("size of videos is ".sizeof($videos));
	foreach($videos as $vid)	{	
	print_r($vid->title);}
	return view('videos.index', compact('videos'));
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
			$this->validate($request, $this->file_rules, $this->messages);			
	
			$instructorname = $request->input('instructorlast'). " "  . $request->input('instructorfirst');
			$instructor =  strtolower($request->input('instructorlast'). "" .substr($request->input('instructorfirst'), 0, 1). "" . substr($request->input('instructorfirst'), -1));
			$vid_slug = preg_replace('/\s+/', '', $request->input('title')) .'-'. $instructor .'-'. $request->input('class');
			$vid_name = strtolower(preg_replace('/\s+/', '', $request->input('title')). '.' . $request->file('video')->getClientOriginalExtension());
			$video_req = array(
					'slug' => $vid_slug,
					'topic' => $request->input('topic'),
					'class' => $request->input('class'),
					'instructor' => $instructorname,
					'vid_url' => $request->input('class').'/'. $instructor . '/'.$vid_name,
					'title' => $request->input('title'),
					'isVerified' => FALSE,
					'created_at' => date("Y-m-d"),
					'created_by' => $request->input('user'),
					'tags' => $request->input('tags'),
					'semester' => $request->input('semester'),
					'year'=>  $request->input('year'),
					'description'=> $request->input('description')
				);


		
		$newvid = new Video($video_req);
			
		$newvid->save();
 		print_r($newvid);

 		$request->file('video')->move(
        base_path() . '/resources/uploaded_videos/' . $request->input('class') . '/' . $instructor . '/', $vid_name
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
		$old_video = $video->vid_url;
		$vidupdated = FALSE;
		$this->validate($request, $this->rules, $this->messages);

                        $instructorname = $request->input('instructorlast'). " "  . $request->input('instructorfirst');
                        $instructor =  strtolower($request->input('instructorlast'). "" .substr($request->input('instructorfirst'), 0, 1). "" . substr($request->input('instructorfirst'), -1));
                        $vid_slug = preg_replace('/\s+/', '', $request->input('title')) .'-'. $instructor .'-'. $request->input('class');
			$vid_name = "";
			$msg = "";

			// video object
			$videdit = array(
                                        'slug' => $vid_slug,
                                        'topic' => $request->input('topic'),
                                        'class' => $request->input('class'),
                                        'instructor' => $instructorname,                                  
                                        'title' => $request->input('title'),
                                        'isVerified' => FALSE,
                                        'updated_at' => date("Y-m-d"),
                                        'updated_by' => 'ravi',//Cas::getCurrentUser(),
                                        'tags' => $request->input('tags'),
                                        'semester' => $request->input('semester'),
					'year' => $request->input('year'),
					'description' => $request->input('description')
                                );
			//if the video file is changed
			if($request->file('video')){
				$vidupdated = TRUE;
				$vid_name = strtolower(preg_replace('/\s+/', '', $request->input('title')). '.' . $request->file('video')->getClientOriginalExtension());
				$videdit['vid_url'] = $request->input('class').'/'. $instructor . '/'.$vid_name;
			}

		// update the video object
		$video->update($videdit);
		print_r($video);

		if($vidupdated){
		$msg = "File changed";
		unlink(video_base_path.'/'.$old_video);	
		$request->file('video')->move(
        base_path() . '/resources/uploaded_videos/' . $request->input('class') . '/' . $instructor . '/', $vid_name
        );
	}
	else{
		$msg = "File not changed";
	}


                return Redirect::route('videos.show', $vid_slug)->with('message', "Video updated sucessfully. ".$msg);
		
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

	public function logout(){
		return view('videos.logout');
	}

}
