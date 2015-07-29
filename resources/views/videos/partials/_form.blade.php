
<div class = "container">
    <div class = "row">
        <div class = "col-xs-6">
                <fieldset>
                    <legend>
                        {{$submit_text}} Video
                    </legend>
                    <div class="form-group">
                        {!! Form::label('Video:', null, array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::file('lvideo', array('id'=>'lvideo','class'=>'btn primary'))   !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('title', 'Title:', array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::text('title', null, array('class'=>'col-lg-10', 'placeholder' => 'Appropriate title to the video')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('instructor', 'Instructor:', array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::text('instructorlast', null, array('class'=>'col-lg-5', 'placeholder'=>'last name')) !!}
                        {!! Form::text('instructorfirst', null, array('class'=>'col-lg-5', 'placeholder'=>'first name')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('class', 'Class:', array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::text('class', '', array('class'=>'col-lg-10', 'placeholder' => 'MAT267, MAT265, etc')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('topic', 'Topic:', array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::text('topic', null, array('class'=>'col-lg-10', 'placeholder' => 'Limits, Derivatives, etc')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('semester', 'Semester', array('class' => 'col-lg-2 control-label')) !!}
                        {!! Form::select('semester', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), null, array('class' => 'col-lg-2')) !!}
                        {!! Form::select('semester', array(2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030), null, array('class' => 'col-lg-2')) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit($submit_text, ['class'=>'cols-lg-2 col-lg-offset-2 btn btn-primary']) !!}
                    </div>
                </fieldset>
    
        </div>

    

        <div class = "col-xs-6">
           
            <div id = "videoholder" class="panel panel-default" style="overflow:auto;">
                <div class="panel-heading">Video File</div>
                <div id="videobox"></div>
            </div>
            <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
            <script type="text/javascript">

                function renderVideo(file) {
                  // generate a new FileReader object
                  var reader = new FileReader();
                  url = 

                  // inject an image with the src url
                  reader.onload = function(event) {
                    the_url = event.target.result
                    $('#videobox')//.html('<video controls><source src="' + the_url + '" type="video/mp4"> </video>');
                   .html('<div data-swf="//releases.flowplayer.org/6.0.3/flowplayer.swf" class="flowplayer no-toggle play-button color-light" data-ratio="0.416"> <video> <source type="video/mp4" src="'+ the_url +'"></video> </div>');
                    
                    

                  }
                 
                  // when the file is read it triggers the onload event above.
                  reader.readAsDataURL(file);
                }
                 
                // handle input changes
                $("#lvideo").change(function() {
                    console.log(this.files)
                    
                    // grab the first image in the FileList object and pass it to the function
                    renderVideo(this.files[0])
                });
            </script>
        </div>
    </div>
</div>