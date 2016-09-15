@extends('app')

@section('content')

    {!! Form::model(new App\Video, array(
            'route' => 'videos.store',
            'class' => 'form-horizontal',
            'novalidate' => 'novalidate',
            'files' => true)
            )
    !!}
                <?php
  $userRole = AuthHelper::authenticate();
  $user = Cas::user();
?>

           <!-- @include('videos/partials/_form', ['submit_text' => 'Upload'])  -->
  <div class="hidden">{{AuthHelper::authenticate()}}</div>
    <div class = "container" style="padding:10px;">
    <div class="row" style="padding:10px">
        <div calss="col-xs-12" style="margin:auto;" >
            <div class="hidden" id="progress-box" style="max-width:100%;padding-left:0px; margin:auto; width:750px;">
    <div class="panel-heading"><p id="panel-heading" class="text-muted">Loading.........</p></div>
        <center><div id="videoplayer" style="max-width:100%; height:auto; padding:10px;">
  <div class="container-fluid" >
      <div class="progress">
          <div class="progress-bar" id="progress-bar" style="width: 0%"></div>
      </div>
    </div></div></div></center>
    </div>
            </div>
            <div class="col-xs-12" >
            <div class="panel panel-default" style="max-width:100%; width:750px; padding:10px; margin:auto;overflow:auto;">
                <div class="panel-body">
                    <fieldset>
                        <legend>
                            Upload Video
                        </legend>
                        <div>
                      </div>
                        <div class="form-group", style='max-width:100%;' >
                            {!! Form::label('Video:', null, array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::file('video', array('id'=>'video'))   !!}
                        </div>

                        <div class="form-group" , style='max-width:100%;'>
                            {!! Form::label('title', 'Title:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('title', null, array('class'=>'col-lg-8', 'require'=> '','style'=>'max-width:80%;', 'placeholder' => 'Appropriate title to the video')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('instructor', 'Instructor:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('instructorlast', null, array('class'=>'col-lg-4', 'placeholder'=>'last name')) !!}
                            {!! Form::text('instructorfirst', null, array('class'=>'col-lg-4', 'placeholder'=>'first name')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('class', 'Class:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('sub', array('MAT' => 'MAT', 'APM' => 'APM', 'MTE' => 'MTE', 'STP' => 'STP', 'Other' => 'Other'), 'MAT', array('id' =>'sub', 'class' => 'col-lg-2')) !!}
                            {!! Form::number('num', 100, array('id' =>'num', 'class'=>'col-lg-6', 'style'=>'max-width:70%;','min'=>'100', 'max'=>'999')) !!}
                            {!! Form::text('user', $user, array('class'=>'hidden')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('topic', 'Topic:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('topic',  array('None','Other'), 'None', array('id' =>'topic', 'class' => 'col-lg-2')) !!}
                            {!! Form::text('othertopic', null, array('id' =>'othertopic', 'placeholder'=>'enter new topic' , 'class'=>'hidden')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('tags', 'Keywords:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('tags', null, array('class'=>'col-lg-8', 'style'=>'max-width:100%;', 'placeholder' => 'Optional comma seperated words - "integrals, line" ')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('semester', 'Semester', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('semester', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), 'Spring', array('class' => 'col-lg-3')) !!}
                            {!! Form::select('year', array('2010' => 2010, '2011' => 2011, '2012' => 2012, '2013' => 2013,'2014' => 2014,'2015' =>2015, '2016' =>2016, '2017' =>2017,'2018' => 2018, '2019' =>2019, '2020' =>2020, '2021' =>2021, '2022' =>2022, '2023' =>2023, '2024' =>2024, '2025' =>2025, '2026' =>2026, '2027' =>2027, '2028' =>2028, '2029' =>2029, '2030' =>2030), 2016, array('class' => 'col-lg-3')) !!}
                        </div>
      <div class="form-group", style='max-width:100%;'>
                            {!! Form::label('desc', 'Description:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::textarea('description', null, array('class'=>'col-lg-8', 'rows'=>'5', 'style'=>'max-width:100%;', 'placeholder' => 'Optional description to the video. This will be displayed below the video in the web page.')) !!}
                        </div>
                        <div class="form-group", style='max-width:100%;'>
                            {!! Form::submit('Upload', ['class'=>'cols-lg-4 col-lg-offset-2 btn btn-primary']) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>


            <script type="text/javascript">

    //-------------------------------------------------------------------------------------------------------


  var reader;
  var progress = document.getElementById('progress-bar');

  function renderVideo(file) {
                  // generate a new FileReader object

                  // inject an image with the src url
                  reader.onload = function(event) {
                    the_url = event.target.result;
                    $('#videoplayer').html('<video controls preload="metadata"><source src="' + the_url + '" type="video/mp4"> </video>');
                  }

                  // when the file is read it triggers the onload event above.
                  reader.readAsDataURL(file);
                }

  function abortRead() {
    reader.abort();
  }

  function errorHandler(evt) {
    switch(evt.target.error.code) {
      case evt.target.error.NOT_FOUND_ERR:
        alert('File Not Found!');
        break;
      case evt.target.error.NOT_READABLE_ERR:
        alert('File is not readable');
        break;
      case evt.target.error.ABORT_ERR:
        break; // noop
      default:
        alert('An error occurred reading this file.');
    };
  }

  function updateProgress(evt) {
    // evt is an ProgressEvent.
    if (evt.lengthComputable) {
      var percentLoaded = Math.round((evt.loaded / evt.total) * 100);
      // Increase the progress bar length.
      if (percentLoaded < 100) {
        progress.style.width = percentLoaded + '%';
        //progress.textContent = percentLoaded + '%';
    if (percentLoaded > 99){
      window.alert('Loaded 100%');
       document.getElementById('panel-heading').innerHTML = 'Loading Complete. Please process with Upload';
    }
      }

    }
  }
  function changeLoadingText(){
    document.getElementById('panel-heading').className = 'text-success';
    document.getElementById('panel-heading').innerHTML='Loading Complete. Please proceed with Upload';
  }

  function handleFileSelect(evt) {
    // Reset progress indicator on new file selection.
    progress.style.width = '0%';
   // progress.textContent = '0%';

    reader = new FileReader();
    reader.onerror = errorHandler;
    reader.onprogress = updateProgress;
    reader.onabort = function(e) {
      alert('File read cancelled');
    };
    reader.onloadstart = function(e) {
      document.getElementById('progress-box').className='panel panel-default ';
    };
    reader.onload = function(e) {
      // Ensure that the progress bar displays 100% at the end.
      progress.style.width = '100%';
      //progress.textContent = '100%';
      setTimeout(changeLoadingText, 1);
      the_url = e.target.result;
      $('#videoplayer').html('<video controls preload="metadata"><source src="' + the_url + '" type="video/mp4"> </video>');
    }

    // Read in the image file as a binary string.
    reader.readAsDataURL(evt.target.files[0]);
  }

  document.getElementById('video').addEventListener('change', handleFileSelect, false);


    //-------------------------------------------------------------------------------------------------------
                // handle input changes
/*
                $("#video").change(function() {
                    console.log(this.files)

                    // grab the first image in the FileList object and pass it to the function
                    handleFileSelect()
                });
*/
            </script>

  </div>





    {!! Form::close() !!}
    <script>
    $num = 100;
    $sub = "MAT";
    $courseTitle = "MAT100";

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

          console.log(`<?php foreach ($topics as $topic) { echo $topic -> topic; }?>`);
          <?php foreach($topics as $topic){ ?>
            if(courseTitle == '<?=$topic -> course?>')
             {
              $('#topic').append('<option><?=$topic -> topic?></option>')
              console.log('<?=$topic -> topic?>');
             }
          <?php } ?>
            });
      $('#sub').on('change', function(e) {
                console.log("in method sub");
                console.log(e.target.value);
          $sub = e.target.value;
          console.log($sub);
                console.log($num);
            });
      $('#topic').on('change', function(e) {
                console.log("in method topic");
                console.log(e.target.value);
                if(e.target.value == "Other")
                $('#othertopic').removeAttr('class');
                else
                $('#othertopic').attr('class','hidden');
            });
    </script>
@endsection
