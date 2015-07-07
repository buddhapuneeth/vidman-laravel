@extends('app')

@section('content')
<h3> List of videos</h3>
	
	@if ( !$videos->count() )
	        You have no projects
	@else
		<ul>
			@foreach ($videos as $video) 
				<li>
					<a href="{{route('videos.show', $video->slug) }}">	
							<video width="320" height="240" controls>
									<source src="resources/videos/{{$video['vid_name']}}" type="video/mp4">
									Your browser does not support the video tag.
							</video>
					</a>
				</li>
			@endforeach
		</ul>
	@endif
	 <p>
        {!! link_to_route('videos.create', 'Create Project') !!}
    </p>
@endsection
