@extends('app')

@section('content')
<div class="jumbotron">
@if ( !$comments->count() )
        You have no comments

@endif
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
{!! Form::open(array('class'=>'form-horizontal','action'=>'CommentsController@filter','method' => 'get')) !!}
{!! csrf_field() !!}

{!! Form::label('Posts:', null) !!}
{!! Form::radio('posts', 'all', $selections['posts_all'],['id' => 'all'])!!}
{!! Form::label('All', 'All') !!}
{!! Form::radio('posts', 'comments', $selections['posts_comments'],['id' => 'comments'])!!}
{!! Form::label('Only comments', 'Only comments') !!}
{!! Form::radio('posts', 'replies', $selections['posts_replies'],['id' => 'replies'])!!}
{!! Form::label('Only replies', 'Only replies') !!}
<br>
{!! Form::label('Status:', null) !!}
{!! Form::radio('status', '2', $selections['status_all'],['id' => 'all'])!!}
{!! Form::label('All', 'All') !!}
{!! Form::radio('status', '0', $selections['status_hide'],['id' => 'hidden'])!!}
{!! Form::label('Hidden', 'Hidden') !!}
{!! Form::radio('status', '1', $selections['status_visible'],['id' => 'visible'])!!}
{!! Form::label('Visible', 'visible') !!}
{!! Form::radio('status', '-1', $selections['status_spam'],['id' => 'spam'])!!}
{!! Form::label('Spam', 'Spam') !!}
{!! Form::text('item_slug', $item_slug, array('id' =>'item_slug' , 'class'=>'hidden')) !!}
<br>
{!! Form::label('Start date', 'Start date')!!}
{!! Form::date('start',$selections['start'], array('id'=>'start_date', 'class'=>'datepicker') ) !!}
{!! Form::label('End date', 'End date')!!}
{!! Form::date('end', $selections['end'], array('id'=>'end_date', 'class'=>'datepicker')) !!}

<br>
{!! Form::submit('Filter',['style'=>"outline:none; font-weight:bold; color:#990033"]) !!}
{!! Form::close() !!}
</div>
<ul class = "list-group">



@foreach ($comments as $comment)

      <li class="list-group-item">
      <span class="badge">{{$comment['class']}}</span>
      <div class="row">

        <div class="cols-xs-8" style="position:relative; overflow:auto;">
          <strong><p>
            @if( $comment['parent'] != NULL)
            Reply to : {{ $comment['par_com']}} <br/>
            Reply for : {{ $comment['par_user']}} <br/>
            @endif
            Instructor: {{ $comment['instructor'] }} <br/>
            Student: {{ $comment['student'] }} <br/>
            Comment: {{ $comment['comment'] }} <br/>
            @if( $comment['show_status'] == 1)
            Status: Visible
            @elseif ( $comment['show_status'] == 0)
            Status: Hidden
            @else
            Status: Spam
            @endif
            {!! Form::open(array('class'=>'form-horizontal','method' => 'post','action'=>'CommentsController@editCommentStatus')) !!}
						{!! Form::text('id1', $comment['id'], array('id' =>'id1' , 'class'=>'hidden')) !!}
            {!! Form::text('slug', $comment['slug'], array('id' =>'slug' , 'class'=>'hidden')) !!}
            {!! Form::text('show_status', $comment['show_status'], array('id' =>'show_status' , 'class'=>'hidden')) !!}
            {!! Form::label('Move to:', null) !!}
            @if( $comment['show_status'] == 1)
            {!! Form::radio('change_status', 'visible', true,['id' => 'visible'])!!}
            {!! Form::label('Visible', 'Visible') !!}
            {!! Form::radio('change_status', 'hide', false,['id' => 'hidden'])!!}
            {!! Form::label('Hide', 'Hide') !!}
            {!! Form::radio('change_status', 'spam', false,['id' => 'spam'])!!}
            {!! Form::label('Spam', 'Spam') !!}
            @elseif ( $comment['show_status'] == 0)
            {!! Form::radio('change_status', 'hide', true,['id' => 'hidden'])!!}
            {!! Form::label('Hide', 'Hide') !!}
            {!! Form::radio('change_status', 'visible', false,['id' => 'visible'])!!}
            {!! Form::label('Visible', 'Visible') !!}
            {!! Form::radio('change_status', 'spam', false,['id' => 'spam'])!!}
            {!! Form::label('Spam', 'Spam') !!}
            @else
            {!! Form::radio('change_status', 'spam', true,['id' => 'spam'])!!}
            {!! Form::label('Spam', 'Spam') !!}
            {!! Form::radio('change_status', 'visible', false,['id' => 'visible'])!!}
            {!! Form::label('Visible', 'visible') !!}
            {!! Form::radio('change_status', 'hide', false,['id' => 'hidden'])!!}
            {!! Form::label('Hide', 'Hide') !!}
            @endif
            {!! Form::text('posts_all',$selections['posts_all'] ,array( 'id' => 'posts_all', 'class'=>'hidden')) !!}
            {!! Form::text('posts_comments',$selections['posts_comments'] ,array( 'id' => 'posts_comments', 'class'=>'hidden')) !!}
            {!! Form::text('posts_replies',$selections['posts_replies'] ,array( 'id' => 'posts_replies', 'class'=>'hidden')) !!}
            {!! Form::text('status_all',$selections['status_all'] ,array( 'id' => 'status_all', 'class'=>'hidden')) !!}
            {!! Form::text('status_hide',$selections['status_hide'] ,array( 'id' => 'status_hide', 'class'=>'hidden')) !!}
            {!! Form::text('status_visible',$selections['status_visible'] ,array( 'id' => 'status_visible', 'class'=>'hidden')) !!}
            {!! Form::text('status_spam',$selections['status_spam'] ,array( 'id' => 'status_spam', 'class'=>'hidden')) !!}
            {!! Form::text('item_slug', $item_slug, array('id' =>'item_slug' , 'class'=>'hidden')) !!}
            {!! Form::text('start',$selections['start'], array('id' => 'start', 'class'=>'hidden')) !!}
            {!! Form::text('end',$selections['end'],array('id' => 'end', 'class'=>'hidden')) !!}
						{!! Form::submit('Change Status',['style'=>"outline:none; font-weight:bold; color:#990033"]) !!}
						{!! Form::close() !!}

          </p></strong>
        </div>
      </div>
    </li>

@endforeach
</ul>
{{ $comments->appends(Input::except('page'))->render()}}
<script type = "text/javascript">
function filter_comments(){
    console.log("in method");
    var spam = document.getElementById('spam');
    if(spam.checked){
      console.log("spam is checked")
    }
    $.ajax({
      type: "POST",
      async:false,
      url: 'CommentsController/filter',
      dataType: 'json',
      data: {'parent':id},
      success: function(data) {
          console.log("Show replies call is successful");
          console.log(data);
      }
  })
}
// $(function() {
//    $( "#datepicker" ).datepicker();
//  });
$(document).ready(function () {

    $('.datepicker').datepicker({});

});
$(document).ready(function () {
       $("#start_date").datepicker({
           dateFormat: 'yy/mm/dd'
       });
   });
</script>




@endsection
