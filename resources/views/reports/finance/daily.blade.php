@extends('layouts.master')
@section('content')

<script>
    $(function() {
        $("#report_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>


<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    {!! Form::open(['route' => 'reports.finance.daily', 'class' => 'form-inline']) !!}
                    <div class="form-group">
                        {!! Form::label('report_date', 'Date') !!}
                        {!! Form::date('report_date', null, ['class' => 'form-control ml-2']) !!}
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="card">
                    <h1 class="text-info">Daily Finance Report <small class="float:right;">{{ $today }}</small></h1>
                    <div class="table-responsive">
                        <table class="table data-table table-striped table-bordered">
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
                                <td>
                                    <h3 class="text-success">Daily Total</h3>
                                </td>
                                <td>
                                    <h3 class="text-success">{{ $daily_count }}</h3>
                                </td>
                                <td>
                                    <h3 class="text-success">${{ number_format($daily_total, 2) }}</h3>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h3 class="text-danger">Unpaid Total</h2>
                                </td>
                                <td>
                                    <h3 class="text-danger">{{ $unpaid_count }}</h3>
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


@endsection