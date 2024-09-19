@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid">

    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="panel panel-default">
            <div class="panel-heading">
              Edit Team
            </div>
            @include('common.errors')
            <div class="panel-body">
              <!-- New Team Form -->
              {!! Form::model($team, array('route' => array('team.update', $team->id), 'method' => 'PATCH', 'class' => 'form-horizontal team-edit-form', 'files' => 'true')) !!}

              <div class="form-group">
                {!! Form::label('name', 'Team Name', array('class' => 'col-sm-3 control-label')) !!}
                <div class="col-sm-6">
                  {!! Form::text('name', $team->name, array('class' => 'form-control')) !!}
                </div>
              </div>
              <div class="form-group">
                {!! Form::label('logo', 'Logo', array('class' => 'col-sm-3 control-label')) !!}
                <div class="col-sm-4">
                  {!! Form::file('logo', array('class' => 'form-control')) !!}
                </div>
                <div class="col-sm-2">
                  <img src="{{ url($team->logo) }}" height="25px" width="100px" />
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('address1', 'Address', ['class' => 'col-xs-12 col-sm-2']) !!}
                <div class="col-xs-12 col-sm-4">
                  {!! Form::text('address1', $team->address1, ['class' => 'form-control']) !!}
                </div>
                {!! Form::label('address2', 'Address 2', ['class' => 'col-xs-12 col-sm-2']) !!}
                <div class="col-xs-12 col-sm-4">
                  {!! Form::text('address2', $team->address2, ['class' => 'form-control']) !!}
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('city', 'City', ['class' => 'col-xs-12 col-sm-2']) !!}
                <div class="col-xs-12 col-sm-4">
                  {!! Form::text('city', $team->city, ['class' => 'form-control']) !!}
                </div>
                {!! Form::label('state', 'State', ['class' => 'col-xs-12 col-sm-1']) !!}
                <div class="col-xs-12 col-sm-1">
                  {!! Form::text('state', $team->state, ['class' => 'form-control']) !!}
                </div>
                {!! Form::label('zip', 'Zip', ['class' => 'col-xs-12 col-sm-1']) !!}
                <div class="col-xs-12 col-sm-3">
                  {!! Form::text('zip', $team->zip, ['class' => 'form-control']) !!}
                </div>
              </div>

              <div class="form-group">
                {!! Form::label('name', 'Phone', array('class' => 'col-sm-3 control-label')) !!}
                <div class="col-sm-6">
                  {!! Form::text('phone', $team->phone, array('class' => 'form-control')) !!}
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                  {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                </div>
              </div>

              {!! Form::close() !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection