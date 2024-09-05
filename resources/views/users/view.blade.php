@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-4">
        <div class="card card-block p-card">
          <div class="profile-box">
            <div class="edit_div"><a href="{{ url('user/'.$user->id.'/edit') }}" class="edit_btn"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
              </svg>
              </a></div>
            <div class="profile-card rounded">
              <!-- <img src="../assets/images/user/1.jpg" alt="profile-bg" class="avatar-100 rounded d-block mx-auto img-fluid mb-3"> -->
              <h3 class="font-600 text-white text-center mb-5"> {{ $user->name}}</h3>
            </div>
            <div class="pro-content rounded">
              <div class="d-flex align-items-center mb-3">
                <div class="p-icon mr-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
                  </svg>
                </div>
                <p class="mb-0 eml"> {{ $user->email }}</p>
              </div>
              <div class="d-flex align-items-center mb-3">
                <div class="p-icon mr-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.128a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                  </svg>
                </div>
                <p class="mb-0">(123) 123 1234</p>
              </div>
              <div class="d-flex align-items-center mb-3">
                <div class="p-icon mr-3">
                  <svg xmlns="http://www.w3.org/2000/svg" class="text-primary" width="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <p class="mb-0">USA</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
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
                    if ($user->has_role($role->name)) {
                      $x = 'true';
                    }
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
    </div>
  </div>
</div>
@endsection