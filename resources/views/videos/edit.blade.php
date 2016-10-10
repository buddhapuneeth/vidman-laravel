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
					$classField = $video->class;
					$sub = substr($classField,0,3);
					$num = substr($classField,3,6);
					$year = $video->year;
					$semester = $video->semester;
					$topic = $video->topic;
					$unit = $video->unit;
					// $('#unit').append('<options>'+One+'<options>');
					// $('#unit').append('<options>'+Two+'<options>');
					//$('#unit').val('One');

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
                            {!! Form::select('sub', array('MAT' => 'MAT', 'APM' => 'APM', 'MTE' => 'MTE', 'STP' => 'STP', 'Other' => 'Other'), $sub, array('id' => 'sub','class' => 'col-lg-2')) !!}
                            {!! Form::number('num', $num, array('id'=>'num','class'=>'col-lg-6', 'style'=>'max-width:70%;','min'=>'100', 'max'=>'999')) !!}
			     									{!! Form::text('user', $user, array('class'=>'hidden')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('topic', 'Topic:', array('class' => 'col-lg-2 control-label')) !!}
														{!! Form::select('topic',  array('None','Other'),$topic , array('id' =>'topic', 'class' => 'col-lg-2')) !!}
                            {!! Form::text('othertopic', null, array('id' =>'othertopic', 'placeholder'=>'enter new topic' , 'class'=>'hidden')) !!}
                        </div>
												<div class="form-group">
                            {!! Form::label('unit', 'Unit:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('unit',array('None'),null,array('id' =>'unit', 'class' => 'col-lg-2')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Keywords:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('tags', null, array('class'=>'col-lg-8', 'placeholder' => 'Optional comma seperated words - "integrals, line" ')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('semester', 'Semester', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('semester', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), $semester, array('class' => 'col-lg-3')) !!}
                            {!! Form::select('year', array('2010' => 2010, '2011' => 2011, '2012' => 2012, '2013' => 2013,'2014' => 2014,'2015' =>2015, '2016' =>2016, '2017' =>2017,'2018' => 2018, '2019' =>2019, '2020' =>2020, '2021' =>2021, '2022' =>2022, '2023' =>2023, '2024' =>2024, '2025' =>2025, '2026' =>2026, '2027' =>2027, '2028' =>2028, '2029' =>2029, '2030' =>2030), $year, array('class' => 'col-lg-3')) !!}
                        </div>
			<div class="form-group">
                            {!! Form::label('desc', 'Description:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::textarea('description', null, array('class'=>'col-lg-8', 'rows'=>'5', 'style'=>'max-width:100%;', 'placeholder' => 'Optional description to the video. This will be displayed below the video in the web page.')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit('Apply', ['class'=>'cols-lg-4 col-lg-offset-2 btn btn-primary']) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>



            <script type="text/javascript">
						$num = 100;
 						$sub = "MAT";
						$courseTitle = "MAT100";
								window.onload = function(){assignments();};
									function assignments(){
										$num = '<?=$num?>';
    								$sub = '<?=$sub?>';
										var courseTitle = $sub+$num;
										$('#unit').empty();
										<?php foreach($units as $unitItem){ ?>
            					if(courseTitle == '<?=$unitItem -> course?>')
             					{
               					var unitName = "<?=$unitItem -> unit?>";
               					unitName = unitName.replace(/'/g, "''");
              					$('#unit').append('<option>'+unitName+'</option>');
             					}
          					<?php } ?>
										$('#unit').val('<?=$unit?>');
										$('#topic').empty();
										$('#topic').append('<option>None</option>');
					          $('#topic').append('<option>Other</option>');
										<?php foreach($topics as $topicItem){ ?>
            					if(courseTitle == '<?=$topicItem -> class?>')
             					{
               					var topicName = "<?=$topicItem -> topic?>";
               					topicName = topicName.replace(/'/g, "''");
              					$('#topic').append('<option>'+topicName+'</option>');
             					}
          					<?php } ?>
										$('#topic').val('<?=$topic?>');
									}
									// code from create.blade.php
									$('#num').on('change', function(e) {
				                console.log("in method num");
				          console.log(e.target.value);
				          $num = e.target.value;
				          console.log($sub);
				          console.log($num);
				          var courseTitle = $sub+$num;
				          console.log("Title " +courseTitle);
				          $('#topic').empty();
				          $('#topic').append('<option>None</option>');
				          $('#topic').append('<option>Other</option>');
				          // additional code
				          <?php foreach($topics as $topic){ ?>
				            if(courseTitle == '<?=$topic -> class?>')
				             {
				               var topicName = "<?=$topic -> topic?>";
				               topicName = topicName.replace(/'/g, "''");
				              $('#topic').append('<option>'+topicName+'</option>')
				              console.log("<?=$topic -> topic?>");
				             }
				          <?php } ?>
				          $('#unit').empty();
				          <?php foreach($units as $unit){ ?>
				            if(courseTitle == '<?=$unit -> course?>')
				            {
				              var unitName = "<?=$unit -> unit?>";
				              unitName = unitName.replace(/'/g, "''");
				              $('#unit').append('<option>'+unitName+'</option>')
				            }
				          <?php } ?>
				            });
				      $('#sub').on('change', function(e) {
				                console.log("in method sub");
				                console.log(e.target.value);
				          $sub = e.target.value;
				          console.log($sub);
				                console.log($num);
				                var courseTitle = $sub+$num;
				                console.log("Title " +courseTitle);
				                $('#topic').empty();
				                $('#topic').append('<option>None</option>');
				                $('#topic').append('<option>Other</option>');
				                // additional code
				                <?php foreach($topics as $topic){ ?>
				                  if(courseTitle == '<?=$topic -> class?>')
				                   {
				                     var topicName = "<?=$topic -> topic?>";
				                     topicName = topicName.replace(/'/g, "''");
				                    $('#topic').append('<option>'+topicName+'</option>')
				                    console.log("<?=$topic -> topic?>");
				                   }
				                <?php } ?>
				                $('#unit').empty();
				                <?php foreach($units as $unit){ ?>
				                  if(courseTitle == '<?=$unit -> course?>')
				                  {
				                    var unitName = "<?=$unit -> unit?>";
				                    unitName = unitName.replace(/'/g, "''");
				                    $('#unit').append('<option>'+unitName+'</option>')
				                  }
				                <?php } ?>
				            });
				      $('#topic').on('change', function(e) {
				                console.log("in method topic");
				                console.log(e.target.value);
				                if(e.target.value == "Other")
				                $('#othertopic').removeAttr('class');
				                else
				                $('#othertopic').attr('class','hidden');
				            });
										// end new code
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
