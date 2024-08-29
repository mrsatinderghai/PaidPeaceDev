@extends('layouts.app')

@section('content')

<script>
    $(function()
    {
      $( "#report_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>


<div class="container">
    <div class="row">
        <div class="col-xs-12 col-md-2">
            @include('finance.nav')
        </div>
        <div class="col-xs-12 col-md-10">
            <div class="row">
                <div class="col-xs-12">
                    {!!  Form::open(['route' => 'reports.finance.daily', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::label('report_date', 'Date') !!}
                        {!! Form::text('report_date', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button> 
                    </div>
                    {!! Form::close() !!}     
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <h1 class="text-info">Daily Finance Report <small class="float:right;">{{ $today }}</small></h1>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Type</th>
                                <th>Transactions</th>
                                <th>Amount</th>
                            </tr>
                            <tr>
                                <td>Credit Cards</td>
                                <td>{{ $cc_count }}</td>
                                <td>${{ number_format($cc_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Checks</td>
                                <td>{{ $check_count }}</td>
                                <td>${{ number_format($check_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td>Cash</td>
                                <td>{{ $cash_count }}</td>
                                <td>${{ number_format($cash_total, 2) }}</td>
                            </tr>
                            <tr>
                                <td><h3 class="text-success">Daily Total</h3></td>
                                <td><h3 class="text-success">{{ $daily_count }}</h3></td>
                                <td><h3 class="text-success">${{ number_format($daily_total, 2) }}</h3></td>
                            </tr>
                            <tr>
                                <td><h3 class="text-danger">Unpaid Total</h2></td>
                                <td><h3 class="text-danger">{{ $unpaid_count }}</h3></td>
                                <td><h3 class="text-danger">${{ number_format($unpaid_total, 2) }}</h3></td>
                            </tr>
                        </table>
                    </div>                  
                </div>
            </div>
        </div>
    </div>
</div>


@endsection