@extends('layouts.master')
@section('content')

<div class="content-page">
    <div class="container-fluid team_sec">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create New Team
                        </div>
                        @include('common.errors')
                        <div class="panel-body">
                            <!-- New Team Form -->
                            {!! Form::open(array('class' => 'form-horizontal', 'files' => 'true')) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Team Name', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-6">
                                    {!! Form::text('name', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('logo', 'Logo', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-6">
                                    {!! Form::file('logo', array('class' => 'form-control')) !!}
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9 add_team">
                                    {!! Form::submit('Add Team', array('class' => 'btn btn-primary')) !!}
                                </div>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


                @if (count($teams) > 0)
                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Teams
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                    <th>Team</th>
                                    <th>&nbsp</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                    @foreach ($teams as $team)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <a href="{{ url('team/'.$team->id) }}">{{ $team->name }}</a>
                                        </td>


                                        <td>
                                            <form action="{{ url('team/'.$team->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete Team
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
        </div>
    </div>
</div>

@endif
@endsection