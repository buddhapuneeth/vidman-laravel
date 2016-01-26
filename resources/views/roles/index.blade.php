@extends('app')

@section('content')

<div class="container">
  <h4>Admin Panel</h4>
  <a href="{{ url('roles/create') }}" class="btn btn-default btn-block"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>  Create New User</a>
  <table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>User</th>
      <th>Role</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    <tr hidden="true">
      <td></td>
      <td></td>
      <td></td>
      <td><a href="#" class="btn btn-primary btn-xs">Edit</a></td>
      <td><a href="#" class="btn btn-danger btn-xs">Delete</a></td>
    </tr>
    @foreach($roles as $index => $role)
    <tr>
      <td>{{ $index+1 }}</td>
      <td>{{ $role->user }}</td>
      <td>{{ $role->role }}</td>
      <td><a href="{{ action('RolesController@edit', $role->id) }}" class="btn btn-primary btn-xs">Edit</a></td>
      <td>{!! Form::model($role, ['method'=>'DELETE', 'action'=>['RolesController@destroy', $role->id]]) !!}
      	{!! Form::hidden('route', 'delete') !!}
      <input class="btn btn-danger btn-xs" type="submit" name="submit" value="DELETE" onclick="return confirm('Do you wish to delete this user?');return false;" />
      {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </table>
</div>



@endsection
