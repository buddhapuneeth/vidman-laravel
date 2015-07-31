
<div class = "container">
    <div class = "row">
        <div class = "col-xs-6">
            <div class="panel panel-default">
                <div class="panel-body">
                    <fieldset>
                        <legend>
                            {{$submit_text}} Video
                        </legend>
                        <div class="form-group">
                            {!! Form::label('Video:', null, array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::file('video',  array('id'=>'video','class'=>'btn btn-default'))   !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('title', 'Title:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('title', null, array('class'=>'col-lg-8', 'require'=> '', 'placeholder' => 'Appropriate title to the video')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('instructor', 'Instructor:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('instructorlast', null, array('class'=>'col-lg-4', 'placeholder'=>'last name')) !!}
                            {!! Form::text('instructorfirst', null, array('class'=>'col-lg-4', 'placeholder'=>'first name')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('class', 'Class:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('class', '', array('class'=>'col-lg-8', 'placeholder' => 'MAT267, MAT265, etc')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('topic', 'Topic:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('topic', null, array('class'=>'col-lg-8', 'placeholder' => 'Limits, Derivatives, etc')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('semester', 'Semester', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::select('sem', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), null, array('class' => 'col-lg-3')) !!}
                            {!! Form::select('year', array(2015, 2016, 2017, 2018, 2019, 2020, 2021, 2022, 2023, 2024, 2025, 2026, 2027, 2028, 2029, 2030), null, array('class' => 'col-lg-3')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('tags', 'Tags:', array('class' => 'col-lg-2 control-label')) !!}
                            {!! Form::text('tags', null, array('class'=>'col-lg-8', 'placeholder' => 'Optional comma seperated words - "integrals, line" ')) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::submit($submit_text, ['class'=>'cols-lg-2 col-lg-offset-2 btn btn-primary']) !!}
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

    

        <div class = "col-xs-6" style="text-align:center;">
           
            
            <div id="videoplayer" ></div>
            
            <script type="text/javascript">

                function renderVideo(file) {
                  // generate a new FileReader object
                  var reader = new FileReader();
                  url = 

                  // inject an image with the src url
                  reader.onload = function(event) {
                    the_url = event.target.result
                    $('#videoplayer').html('<video controls><source src="' + the_url + '" type="video/mp4"> </video>');
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
        </div>
    </div>
</div>