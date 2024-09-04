@extends('layouts.master')
@section('content')



<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="iq-edit-list-data">
          <div class="tab-content">
            <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
              <div class="card">
                <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                    <h4 class="card-title">Personal Information</h4>
                  </div>
                </div>
                <div class="card-body">
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
                    <div class="form-group" style="text-align: end;">
                      <div class="col-sm-offset-3 col-sm-9 remove_space">
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
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>




@endsection