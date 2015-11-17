@extends('app')

@section('content')

<div class="container" style="padding:20px;">
	{!! Form::model($role, ['method'=>'PATCH', 'action'=>['RolesController@update', $role->id]]) !!}
		@include('roles._form', ['submitMesg'=>'Apply Changes', 'formLegend'=>'Update User Role', 'routename'=>'create'])
	{!! Form::close() !!}

</div>

@endsection
