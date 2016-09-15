@extends('app')

@section('content')


<div class="container" style="position:relative; background-color:#fff;">

<h3> List of videos</h3>

<!--<div class="container videos-results">-->

	@if ( !$videos->count() )
	        You have no videos
	@else
		<ul class = "list-group">




		@foreach ($videos as $video)

					<li class="list-group-item">
					<!--<a href="{{route('videos.show', $video->slug) }}">	-->
					<span class="badge">{{$video['class']}}</span>
					<div class="row">
						<div class="col-xs-4 video-wrapper">

							<a href="{{ URL::route('videos.show', $video['slug']) }}">
							<video width="320" height="240" preload="metadata"  >
									<source src="{{video_base_path}}/{{$video['vid_url']}}" type="video/mp4">
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
								<div class="hidden">{{$userRole = AuthHelper::authenticate()}}</div>
								@if($userRole == 'admin' || $userRole == 'faculty')
								<div class="well well-sm"><p class="text-primary"><strong>{{video_absolute_path}}/{{$video['vid_url']}}<strong></p></div>
								@endif
						</div>
					</div>

					<!-- </a> -->
				</li>

		@endforeach


		</ul>
		<center>{!! $videos->render() !!}</center>
	@endif
</div>
<!-- </div> -->
@endsection
