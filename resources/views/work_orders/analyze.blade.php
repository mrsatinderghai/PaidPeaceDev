@extends('layouts.app')

@section('content')

<script>
    $(function()
    {
      $( "#from_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
      $( "#to_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>


<div class="container">
    <div class="row">
        {!! Form::open(['route' => 'work_order.analyze', 'class' => 'form-inline']) !!}
        <div class="col-xs-12 col-md-4">
            <div class="form-group">
                {!! Form::label('from_date', 'From') !!}
                {!! Form::text('from_date', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="form-group">
                {!! Form::label('to_date', 'To') !!}
                {!! Form::text('to_date', null, ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="col-xs-12 col-md-4">
            <div class="form-group">
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
<hr>
    <div class="row">
        <div class="col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-condensed">
                    <tr>
                        <th>Number</th>
                        <th>Customer</th>
                        <th>Created Date</th>
                        <th>Appointment Date</th>
                        <th>Completed On</th>
                        <th>Zip Code</th>
                        <th>Phone</th>
                    </tr>
                    @foreach($work_orders as $wo)
                        <tr>
                            <td>{{ $wo->id }}</td>
                            <td>{{ $wo->customer->full_name() }}</td>
                            <td>{{ $wo->created_at }}</td>
                            <td>{{ $wo->appointment_date }}</td>
                            <td>{{ $wo->completed_on }}</td>
                            <td>{{ $wo->customer->zip }}</td>
                            <td>{{ $wo->customer->phone_number_formatter() }}</td>   
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>



@endsection