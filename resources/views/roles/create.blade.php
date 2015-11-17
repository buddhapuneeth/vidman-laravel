@extends('app')

@section('content')
<div class="container" style="padding:20px;">
	{!! Form::open(['url'=>'roles']) !!}
		@include('roles._form', ['submitMesg'=>'Add User', 'formLegend'=>'Create User', 'routename'=>'create'])
	{!! Form::close() !!}

</div>

@endsection
