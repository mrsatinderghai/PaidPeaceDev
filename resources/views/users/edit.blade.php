@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading">
        Edit User
      </div>
      @include('common.errors')
      <div class="panel-body">
        <!-- New Team Form -->
          {!! Form::model($user, array('route' => array('user.update', $user->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}
        <div class="form-group">
          {!! Form::label('name', 'Name', array('class' => 'col-sm-3 control-label')) !!}
          <div class="col-sm-6">
            {!! Form::text('name', $user->name, array('class' => 'form-control')) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) !!}
          <div class="col-sm-6">
            {!! Form::text('email', $user->email, array('class' => 'form-control')) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('password', 'New Password', array('class' => 'col-sm-3 control-label')) !!}
          <div class="col-sm-6">
            {!! Form::password('password', array('class' => 'form-control')) !!}
<!--             {!! Form::text('current_password', $user->password, array('class' => 'form-control')) !!} -->
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('password_confirmation', 'Confirm Password', array('class' => 'col-sm-3 control-label')) !!}
          <div class="col-sm-6">
            {!! Form::password('password_confirmation', array('class' => 'form-control')) !!}
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-3 col-sm-6">
      @if (auth()->check())
         @if (auth()->user()->isAdmin())
            {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
         @endif
      @endif
            <a href="{{ url('/user/') }}" class="btn btn-primary">Back</a>
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
  @endsection
