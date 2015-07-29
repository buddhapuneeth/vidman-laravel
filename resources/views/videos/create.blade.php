@extends('app')
 
@section('content')

    {!! Form::model(new App\Video, array(
            'route' => 'videos.store', 
            'class' => 'form-horizontal', 
            'novalidate' => 'novalidate', 
            'files' => true)
            ) 
    !!}
                
            @include('videos/partials/_form', ['submit_text' => 'Upload'])
        
    
    {!! Form::close() !!}
@endsection