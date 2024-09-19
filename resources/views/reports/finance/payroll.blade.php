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
    <div class="container-fluid payroll_report">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    {!! Form::open(['route' => 'reports.finance.payroll']) !!}
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('user_id', 'Employee') !!}
                            {!! Form::select('user_id', $team_member_select, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('from_date', 'From') !!}
                            {!! Form::date('from_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            {!! Form::label('to_date', 'To') !!}
                            {!! Form::date('to_date', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <div class="form-group">
                            <button class="btn btn-primary" class="form-control">Submit</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                <div class="card">
                    <h1 class="text-info">Payroll Report</h1>
                    <h3 class="text-primary">{{ $name }}</h3>
                    <h4 class="text-secondary">{{ $from_date . " - " . $to_date }}</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed">
                            <tr>
                                <th>Invoice</th>
                                <th>Work Order</th>
                                <th>Customer</th>
                                <th>Labor Charge</th>
                                <th>Total Charge</th>
                                <th>Tender</th>
                            </tr>
                            @foreach($work_orders as $wo)
                            @if(isset($wo))
                            <tr> </tr>
                            @if(isset($wo->invoice->first()->id))
                            <td>{{ $wo->invoice->first()->id}}</td>
                            @endif
                            <td>{{ $wo->id }} @if ($wo->shop_work) <span class="bg-info">Shop Work</span> @endif</td>
                            <td>{{ $wo->customer->full_name() }}</td>
                            @php
                            $ts = 0;
                            foreach($wo->services as $s) {
                            $ts += $s->pivot->line_cost;
                            }
                            @endphp
                            <td>${{ number_format($ts, 2) }}</td>
                            <td>@if($wo->invoice->first()) ${{ number_format($wo->invoice->first()->amount, 2)  }} @endif</td>
                            @if(isset($wo->invoice->first()->paid_with))
                            <td>{{ $wo->invoice->first()->paid_with}} @if($wo->invoice->first()) ({{ $wo->invoice->first()->transactions->first()->paid_with_detail or '' }}) @endif</td>
                           @endif
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td><b>Totals:</b></td>
                                <td></td>
                                <td></td>
                                <td><b>${{ number_format($total_labor_charges, 2)  }}</b></td>
                                <td><b>${{ number_format($total_charges, 2) }}</b></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endsection