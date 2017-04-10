@extends('app')

@section('content')



<?php
	$userRole = AuthHelper::authenticate();
	$user = Cas::user();
?>


    <div class="row" style="padding:10px; padding-top:70px;">
        <div calss="col-xs-12" style="margin:auto;" >
            <div class="panel panel-default" style="max-width:100%;padding-left:10px; margin:auto; width:750px;">
        <center><div id="videoplayer" style="max-width:100%; height:auto; padding:10px;">
	<video width="720px" height="auto" controls>
									<source src="{{video_base_path}}/{{$video['vid_url']}}" type="video/mp4">
									Your browser does not support the video tag.
							</video>
	</div>
    </div>
</div>



<div class="container-fluid" style="padding-top:10px;">
	<center><div style="display:block; padding-bottom:10px; width:750px; max-width:100%;">
			@if($userRole == 'admin' || $user == $video['created_by'])
				{!! link_to_route('videos.edit', 'Edit Video Information', array($video->slug), array('class' => 'btn btn-default btn-block', 'style'=>'outline:none; font-weight:bold; color:#2196F3')) !!}
			@endif
		</div></center>

		<center><div style="display:block; padding-bottom:10px; width:750px; max-width:100%;">
				@if($userRole == 'admin')
					{!! Form::model($video, ['method'=>'DELETE', 'action'=>['VideosController@destroy', $video->slug]]) !!}
						{!! Form::hidden('route', 'delete') !!}
						<input class="btn btn-default btn-block" type="submit" name="submit" style="outline:none; font-weight:bold; color:#990033" value="DELETE" onclick="return confirm('Do you wish to delete this video?');return false;" />
					{!! Form::close() !!}
				@endif
			</div></center>
			<center><div style="display:block; padding-bottom:10px; width:750px; max-width:100%;">
					@if($userRole == 'admin')
						<!-- {!! Form::model($video, ['method'=>'GET', 'action'=>['CommentsController@editComment', $video->slug]]) !!}
							<input class="btn btn-default btn-block" type="submit" name="submit" style="outline:none; font-weight:bold; color:#990033" value="MONITOR COMMENTS" />
						{!! Form::close() !!} -->

						{!! Form::open(array('class'=>'form-horizontal','action'=>'CommentsController@editComment','method' => 'get')) !!}
						{!! Form::text('slug', $video['slug'], array('id' =>'slug' , 'class'=>'hidden')) !!}
						{!! Form::submit('MONITOR COMMENTS',['style'=>"outline:none; font-weight:bold; color:#990033",'class'=>"btn btn-default btn-block"]) !!}
						{!! Form::close() !!}

					@endif
				</div></center>

<div class="panel panel-default" style="max-width:100%; padding-left:30px; padding:0px; margin:auto; width:750px;">

	<div class="panel-heading" style="position:relative;">

                            <h3>{{$video['title']}}</h3>

	</div>
	<div class="panel-body">
	<ul class="nav nav-tabs">
  <li class=""><a href="#about" data-toggle="tab" aria-expanded="true" style="outline:none;">About</a></li>
  <li class="active"><a href="#comments" data-toggle="tab" aria-expanded="true"  style="outline:none;">Comments</a></li>
</ul>

        <div id="myTabContent" class="tab-content" >
  <div class="tab-pane fade " id="about">
    <p>{{$video['description']}}.</p>
  </div>
  <div class="tab-pane fade active in" id="comments">

		 <!-- <textarea style="width:90%" rows="3" cols="70"></textarea> -->


{!! Form::open(array('class'=>'form-horizontal','action'=>'CommentsController@addComment','method' => 'post', 'onsubmit'=>"return confirm('Do you really want to post the comment?');")) !!}
		 <div class="form-group">
			 {!! Form::textarea('comment', null, [ 'style'=>'width:90%', 'rows'=>'2', 'cols'=>'70','class' => 'form-control','maxlength'=>'150']) !!}
			 {!! Form::text('slug', $video['slug'], array('id' =>'slug' , 'class'=>'hidden')) !!}
			 {!! Form::text('student',$user, array('id' =>'student' , 'class'=>'hidden')) !!}
			 {!! Form::text('class', $video['class'], array('id' =>'class' , 'class'=>'hidden')) !!}
			 {!! Form::text('instructor', $video['instructor'], array('id' =>'instructor' , 'class'=>'hidden')) !!}
			 {!! Form::text('title', $video['title'], array('id' =>'title' , 'class'=>'hidden')) !!}
	 </div>
	 <div class="form-group" align="left">
			 {!! Form::submit('Post as '.$user) !!}
	 </div>
 {!! Form::close() !!}

	@foreach ($comments as $comment)
		@if($comment['show_status']== 1 && $comment['parent']==null)
			{!! Form::label('by', 'Comment from '.$comment['student'].':', array('class' => 'col-lg-2 control-label')) !!}
			{!! Form::textarea('Comment', $comment['comment'], [ 'style'=>'width:90%', 'rows'=>'2', 'cols'=>'70','readonly' => 'true']) !!}


			{!! Form::model($video, ['method'=>'GET', 'action'=>['CommentsController@showReplies']]) !!}
			<div class="form-group" align="left">
				{!! Form::text('parent', $comment['id'], array('id' =>'parent' , 'class'=>'hidden')) !!}
				{!! Form::submit('Show replies') !!}
				</div>
				{!! Form::close() !!}
			<br>
			<br>
		@endif
	@endforeach


		 <!-- <button type="button">Post as {{$user}}</button> -->
		<!-- {!! Form::textarea('Comments', null,['size' => '70x3'], array('class'=>'col-lg-8', 'require'=> '', 'placeholder' => 'Type your comments here')) !!} -->
  </div>

	</div>


</div>
</div>
</div>
</div>
</div>

@endsection
