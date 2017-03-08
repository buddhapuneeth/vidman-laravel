@extends('app')

@section('content')


<?php
	$userRole = AuthHelper::authenticate();
	$user = Cas::user();

?>

@if ( !$comments->count() )
        There are no replies

@endif

<ul class = "list-group">
@foreach ($comments as $comment)
		@if($comment['show_status']== 1)
      <li class="list-group-item">
      <span class="badge">{{$comment['class']}}</span>
      <div class="row">

        <div class="cols-xs-8" style="position:relative; overflow:auto;">
          <strong><p>
            {!! Form::label('by', 'Reply from '.$comment['student'].':', array('class' => 'col-lg-2 control-label')) !!}
            {!! Form::textarea('Reply', $comment['comment'], [ 'style'=>'width:90%', 'rows'=>'2', 'cols'=>'70','readonly' => 'true']) !!}
          </p></strong>
        </div>
      </div>
    </li>
		@endif
	@endforeach
</ul>




{!! Form::open(array('class'=>'form-horizontal','action'=>'CommentsController@addReply','method' => 'post', 'onsubmit'=>"return confirm('Do you really want to reply?');")) !!}
 <div class="form-group">
{!! Form::textarea('com', null, [ 'style'=>'width:90%', 'rows'=>'2', 'cols'=>'70','class' => 'form-control','maxlength'=>'150']) !!}

{!! Form::text('student',$user, array('id' =>'student' , 'class'=>'hidden')) !!}
{!! Form::text('parent', $parent, array('id' =>'parent' , 'class'=>'hidden')) !!}
</div>
<div class="form-group" align="left">
{!! Form::submit('Reply as '.$user) !!}
</div>
{!! Form::close() !!}

@endsection
