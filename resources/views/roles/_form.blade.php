<fieldset>
<legend>{{$formLegend}}</legend>
<div class="form-group">
{!! Form::label('user', 'Username:') !!}
{!! Form::text('user', null, ['class'=> 'form-control', 'placeholder'=>'Enter Asurite ID']) !!}
</div>
<div class="form-group">
{!! Form::label('role', 'Role:') !!}
{!! Form::select('role', array('faculty' => 'Faculty', 'admin' => 'Administrator'), null,['class'=>'form-control']) !!}
{!! Form::hidden('route', $routename) !!}
</div>
{!! Form::submit($submitMesg, ['class'=>'btn btn-primary']) !!}
</fieldset>
