@extends('layouts.app')

@section('content')

@include('common.container')

<div class="jumbotron">
  <h1 style="position: relative; width: 75%">
    {{ $user->name}}
  </h1>
  <h2>
    {{ $user->email }}
  </h2>
  <a href="{{ url('user/'.$user->id.'/edit') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Roles
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">
          <thead>
            <th>
              Role
            </th>
            <th>
              Assigned
            </th>
          </thead>

          <tbody>
            {!! Form::open(array('route' => 'user.update_roles')) !!}
            {!! Form::hidden('user_id', $user->id) !!}
            @foreach($roles as $role)
              <tr>
                <td>
                  {{ $role->name }}
                </td>
                <td>
                  <?php
                    $x = null;
                    if ($user->has_role($role->name)) {$x = 'true';}
                  ?>
                  {!! Form::checkbox('roles[]', $role->id, $x) !!}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
  </div>

  @include('common.end_container')

  @endsection
