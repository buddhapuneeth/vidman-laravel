@extends('app')

@section('content')

	{!! Form::model($video, array(
            'method' => 'patch',
	    'route' => ['videos.update', $video->slug],
            'class' => 'form-horizontal',
            'novalidate' => 'novalidate',
            'files' => true)
            )
    !!}


        <!--  @include('videos/partials/_form', ['submit_text' => 'Edit'])  -->

        <?php
		$userRole = AuthHelper::authenticate();
        	$instructor = preg_split('#\s+#', $video->instructor, 2);
		$user = Cas::user();
    ?>

        <div class = "container" style="padding:10px;">
	@if($userRole == 'admin' || $user ==  $video->created_by)
    <div class="row" style="padding:10px">
        <div calss="col-xs-12" style="margin:auto;" >
            <div class="panel panel-default" style="max-width:100%;padding-left:10px; margin:auto; width:750px;">
        <center><div id="videoplayer" style="max-width:100%; height:auto; padding:10px;">
        	<video id="vid" preload="metadata"  controls><source src="{{video_base_path}}/{{$video['vid_url']}}" type="video/mp4" id="vid-src"> </video>
        </div></center>
    </div>
            </div>
            <div calss="col-xs-12" >
            <div class="panel panel-default" style="max-width:100%; width:750px; padding:10px; margin:auto;overflow:hidden;">
                <div class="panel-body">
                    <fieldset>
                        <legend>
                            Edit Video Information
                        </legend>
                        <div class="form-group">
                            {!! Form::label('Video:', null, array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::file('video', array('id'=>'video'))   !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('title', 'Title:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('title', null, array('class'=>'col-lg-8', 'require'=> '', 'placeholder' => 'Appropriate title to the video')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('instructor', 'Instructor:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('instructorlast', $instructor[0], array('class'=>'col-lg-4', 'placeholder'=>'last name')) !!}
                            {!! Form::text('instructorfirst', $instructor[1], array('class'=>'col-lg-4', 'placeholder'=>'first name')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('class', 'Class:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('sub', array('MAT' => 'MAT', 'APM' => 'APM', 'MTE' => 'MTE', 'STP' => 'STP', 'Other' => 'Other'), 'MAT', array('class' => 'col-lg-2')) !!}
                            {!! Form::number('num', null, array('class'=>'col-lg-6', 'style'=>'max-width:70%;','min'=>'100', 'max'=>'999')) !!}
			     {!! Form::text('user', $user, array('class'=>'hidden')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('topic', 'Topic:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('topic', null, array('class'=>'col-lg-8', 'placeholder' => 'Limits, Derivatives, etc')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('semester', 'Semester', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('semester', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), null, array('class' => 'col-lg-3')) !!}
                            {!! Form::select('year', array(2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030), null, array('class' => 'col-lg-3')) !!}
                        </div>
			<div class="form-group">
                            {!! Form::label('desc', 'Description:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::textarea('description', null, array('class'=>'col-lg-8', 'style'=>'max-width:100%;', 'placeholder' => 'Optional description to the video. This will be displayed below the video in the web page.')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('tags', null, array('class'=>'col-lg-8', 'placeholder' => 'Optional comma seperated words - "integrals, line" ')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Apply', ['class'=>'cols-lg-4 col-lg-offset-2 btn btn-primary']) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>



            <script type="text/javascript">

                function renderVideo(file) {
                  // generate a new FileReader object
                  var reader = new FileReader();
                  url =

                  // inject an image with the src url
                  reader.onload = function(event) {
                    the_url = event.target.result
                    $('#videoplayer video source').attr('src', the_url);
                    $('#vid').load();

                  }

                  // when the file is read it triggers the onload event above.
                  reader.readAsDataURL(file);
                }

                // handle input changes
                $("#video").change(function() {
                    console.log(this.files)

                    // grab the first image in the FileList object and pass it to the function
                    renderVideo(this.files[0])
                });
            </script>

	@else
		<h3> You Don't have Access to this page</h3>

	@endif

</div>

    {!! Form::close() !!}
@endsection
