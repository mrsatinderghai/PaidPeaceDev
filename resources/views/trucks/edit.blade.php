@extends('layouts.master')
@section('content')


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <h4 class="m-3 text-capitalize">{{ $truck->name }}</h4>
                    <div class="col-xs-12 col-md-8 part_section">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Edit Truck
                            </div>
                            <div class="panel-body">
                                @include('common.errors')

                                {!! Form::model($truck, array('route' => array('truck.update', $truck->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}

                                <div class="form-group">
                                    {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
                                    <div class="col-sm-8 remove_space">
                                        {!! Form::text('name', $truck->name, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-4 col-sm-12 add_btnn">
                                        {!! Form::submit('Update', array('class' => 'btn btn-primary')) !!}
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
@endsection