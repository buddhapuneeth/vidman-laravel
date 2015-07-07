@extends('app')
 
@section('content')
    <h2>Upload a Video</h2>
 
    {!! Form::model(new App\Video, ['route' => ['videos.store']]) !!}
        @include('videos/partials/_form', ['submit_text' => 'Upload'])
    {!! Form::close() !!}
@endsection