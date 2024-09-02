@extends('layouts.master')
@section('content')


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Create New Role
                        </div>
                        @include('common.errors')
                        <div class="panel-body">
                            <!-- New Team Form -->
                            {!! Form::open(array('class' => 'form-horizontal', 'files' => 'true')) !!}

                            <div class="form-group">
                                {!! Form::label('name', 'Role Name', array('class' => 'col-sm-3 control-label')) !!}
                                <div class="col-sm-6">
                                    {!! Form::text('name', '', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-6">
                                    {!! Form::submit('Add Role', array('class' => 'btn btn-primary')) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>


                @if (count($roles) > 0)
                <div class="card">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Roles
                        </div>

                        <div class="panel-body">
                            <table class="table table-striped task-table">

                                <!-- Table Headings -->
                                <thead>
                                    <th>Name</th>
                                    <th>&nbsp</th>
                                </thead>

                                <!-- Table Body -->
                                <tbody>
                                    @foreach ($roles as $role)
                                    <tr>
                                        <!-- Task Name -->
                                        <td class="table-text">
                                            <div>{{ $role->name }}</div>
                                        </td>


                                        <td>
                                            <form action="{{ url('role/'.$role->id) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}

                                                <button class="btn btn-danger">
                                                    <i class="fa fa-trash"></i> Delete Role
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