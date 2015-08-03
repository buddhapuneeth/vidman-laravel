@extends('app')

@section('content')
 <div>
 	<h3>Page under construction</h3>
	This is where <strong>{{$video['title']}}</strong> lives
	
	<video width="320" height="240" controls>
									<source src="/resources/videos/{{$video['vid_url']}}" type="video/mp4">
									Your browser does not support the video tag.
							</video>
	</div>

	{!! link_to_route('videos.edit', 'Edit', array($video->slug), array('class' => 'btn btn-primary')) !!}
@endsection