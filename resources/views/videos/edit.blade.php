@extends('app')
 
@section('content')
    <h2>Edit Video</h2>
 
    {!! Form::model($video, ['method' => 'PATCH', 'route' => ['videos.update', $video->slug]]) !!}
        @include('videos/partials/_form', ['submit_text' => 'Edit'])
    {!! Form::close() !!}
@endsection