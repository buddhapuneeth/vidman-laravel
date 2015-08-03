@extends('app')

@section('content')
 
<div class="container" style="position:relative;">
	<div style="display:block; float:right;">
        {!! link_to_route('videos.create', 'Upload Video', null, array('class'=>'btn btn-success btn-sm upload-btn')) !!}
    </div>
<h3> List of videos</h3>


<!--<div class="container videos-results">-->
	
	@if ( !$videos->count() )
	        You have no videos
	@else
		<ul class = "list-group">


@for ($i = 1; $i <= 10; $i++)

		@foreach ($videos as $video) 
				
					<li class="list-group-item">
					<!--<a href="{{route('videos.show', $video->slug) }}">	-->
					<span class="badge">{{$video['class']}}</span>
					<div class="row">
						<div class="col-xs-4 video-wrapper">

							<a href="{{ URL::route('videos.show', $video['slug']) }}">
							<video width="320" height="240" controls>
									<source src="/resources/videos/{{$video['class']}}/{{$video['instructor']}}/{{$video['vid_url']}}" type="video/mp4">
									Your browser does not support the video tag.
							</video>
						</a>

						</div>
						<div class="cols-xs-8" style="position:relative; overflow:auto;">
							<a href="{{ URL::route('videos.show', $video['slug']) }}"><h4 >{{ucwords($video['title'])}}</h4></a>
							<strong><p> Topic: {{$video['topic']}} <br/>
								Instructor: {{ $video['instructor'] }} <br/>
								@if ( !$video['updated_at'] )
									Created Date: {{ $video['created_at'] }}
								@else
									Updated Last: {{ $video['updated_at'] }}

								@endif
							</p></strong>
							
								<div class="well well-sm"><p class="text-primary"><strong>https://miro.asu.edu/vidman/resources/videos/{{$video['class']}}/{{$video['instructor']}}/{{$video['vid_url']}}<strong></p></div>
							
						</div>
					</div>
							
					<!-- </a> -->
				</li>
			
		@endforeach

@endfor
		</ul>
	@endif
</div>
<!-- </div> -->
@endsection
