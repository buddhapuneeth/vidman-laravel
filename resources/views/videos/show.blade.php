@extends('app')

@section('content')
 <p>
	This is where {{$video['title']}} lives here
	<strong>Page under construction</strong>
	<video width="320" height="240" controls>
									<source src="/resources/videos/{{$video['vid_url']}}" type="video/mp4">
									Your browser does not support the video tag.
							</video>
	</p>

	{!! link_to_route('videos.edit', 'Edit', array($video->slug), array('class' => 'btn btn-primary')) !!}
@endsection