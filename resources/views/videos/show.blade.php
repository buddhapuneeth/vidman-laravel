@extends('app')

@section('content')
 <p>
	This is where {{$video['vid_name']}} lives 
	resources/videos/{{$video['class']}}/{{$video['instructor']}}/{{$video['vid_name']}}.mp4
	<video width="320" height="240" controls>
									<source src="resources/videos/{{$video['class']}}/{{$video['instructor']}}/{{$video['vid_name']}}.mp4" type="video/mp4">
									Your browser does not support the video tag.
							</video>
	</p>

	{!! link_to_route('videos.edit', 'Edit', array($video->slug), array('class' => 'btn btn-info')) !!}
@endsection