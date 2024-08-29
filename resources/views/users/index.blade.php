@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create New User
            </div>
            @include('common.errors')
            <div class="panel-body">
                <!-- New Team Form -->
                {!! Form::open(array('class' => 'form-horizontal')) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('name', '', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::text('email', '', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password', array('class' => 'col-sm-3 control-label')) !!}
                    <div class="col-sm-6">
                        {!! Form::password('password', array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        {!! Form::submit('Add User', array('class' => 'btn btn-primary')) !!}
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    
    @if (count($users) > 0)
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                Users
            </div>

            <div class="panel-body">
                <table class="table table-striped task-table">

                    <!-- Table Headings -->
                    <thead>
                        <th>User</th>
                        <th>
                          Team
                        </th>
                        <th>
                          Email
                        </th>
                        <th>
                          Roles
                        </th>
                        <th>&nbsp</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <!-- Task Name -->
                            <td class="table-text">
                                <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                            </td>

                            <td>
                              <a href="{{ url('/team/'.$user->team_id) }}"></a>
                            </td>
                            <td>
                              {{ $user->email }}
                            </td>
                            <td>
                              @foreach ($user->roles as $role)
                                {{ $role->name }},&nbsp
                              @endforeach
                            </td>
                            <td>
                                <form action="{{ url('user/'.$user->id) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}

                                    <button class="btn btn-danger">
                                        <i class="fa fa-trash"></i> Delete User
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endif
@endsection
