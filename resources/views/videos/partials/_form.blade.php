
<div class = "container">
    <div class = "row">
        <div class = "cols-sm-4">
            <div class="form-group">
                {!! Form::label('Lecture Video:') !!}
                {!! Form::file('lvideo', array('id'=>'lvideo','class'=>'btn primary'))   !!}
            </div>

            <div class="form-group">
                {!! Form::label('vid_name', 'Name:') !!}
                {!! Form::text('vid_name') !!}
            </div>
            <div class="form-group">
                {!! Form::label('slug', 'Slug:') !!}
                {!! Form::text('slug') !!}
            </div>
            <div class="form-group">
                {!! Form::label('instructor', 'Instructor:') !!}
                {!! Form::text('instructor') !!}
            </div>
            <div class="form-group">
                {!! Form::label('class', 'Class:') !!}
                {!! Form::text('class') !!}
            </div>
            <div class="form-group">
                {!! Form::label('topic', 'Topic:') !!}
                {!! Form::text('topic') !!}
            </div>
            <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title') !!}
            </div>

            <div class="form-group">
                {!! Form::label('semester', 'Semester') !!}
                {!! Form::select('semester', array('Fall' => 'Fall', 'Spring' => 'Spring', 'Summer' => 'Summer'), null, array('class' => 'drop-down')) !!}
                {!! Form::text('year', null, array('type' => 'number', 'size' => '4', 'min' => '1990', 'max'=>(date("Y") +  5), 'value' => date("Y"))) !!}
            </div>

        </div>
        <div class = "cols-sm-4">
            <div id = "videoholder" style="display:inline;"></div>
            <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.3.min.js"></script>
            <script type="text/javascript">

                function renderImage(file) {
                  // generate a new FileReader object
                  var reader = new FileReader();

                  // inject an image with the src url
                  reader.onload = function(event) {
                    the_url = event.target.result
                    $('#videoholder').html('<video width="320" height="240" controls><source src="' + the_url + '" type="video/mp4"> </video>')
                  }
                 
                  // when the file is read it triggers the onload event above.
                  reader.readAsDataURL(file);
                }
                 
                // handle input changes
                $("#lvideo").change(function() {
                    console.log(this.files)
                    
                    // grab the first image in the FileList object and pass it to the function
                    renderImage(this.files[0])
                });
            </script>
        </div>
    </div>

    <div class="form-group">
        {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
    </div>
</div>