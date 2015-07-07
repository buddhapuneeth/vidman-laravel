@extends('app')

@section('content')
 <p>
	This is where {{$video['vid_name']}} lives 
	</p>

	{!! link_to_route('videos.edit', 'Edit', array($video->slug), array('class' => 'btn btn-info')) !!}
@endsection