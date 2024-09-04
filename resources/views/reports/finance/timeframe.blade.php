@extends('layouts.master')
@section('content')
<script>
    $(function() {
        $("#from_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
        $("#to_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>


<div class="content-page">
    <div class="container-fluid timeframe">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="col-xs-12">
                        {!! Form::open(['route' => 'reports.finance.timeframe', 'class' => 'form-inline']) !!}
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
                                <button class="btn btn-primary" class="form-control">Submit</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                <div class="card">
                    <div class="col-xs-12">
                        <h1 class="text-info">Timeframe Finance Report <small style="float:right">{{ $from_date . " - " . $to_date }}</small></h1>
                        <div class="alert alert-info">
                            <h3>Total Invoices: <span style="float:right">{{ $invoices_count }}</span></h3>
                            <h3>Average Invoice Amount: <span style="float:right">${{ number_format($invoices_average, 2) }}</span></h3>
                        </div>
                        <div class="table-responsive">
                            <h4 class="text-secondary">Transactions:</h4>
                            <table class="table table-striped">
                                <tr>
                                    <td>Credit Cards</td>
                                    <td>${{ number_format($cc_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Checks</td>
                                    <td>${{ number_format($check_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Cash</td>
                                    <td>${{ number_format($cash_total, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="text-success">Total</h3>
                                    </td>
                                    <td>
                                        <h3 class="text-success">${{ number_format($total, 2) }}</h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h3 class="text-danger">Unpaid Total</h2>
                                    </td>
                                    <td>
                                        <h3 class="text-danger">${{ number_format($unpaid_total, 2) }}</h3>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection