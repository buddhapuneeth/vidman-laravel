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
    {!! Form::submit($submit_text, ['class'=>'btn primary']) !!}
</div>