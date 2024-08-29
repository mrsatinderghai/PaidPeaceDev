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
    <div class="col-xs-12 col-md-2">
        @include('finance.nav')
    </div>
    <div class="col-xs-12 col-md-10">
        <div class="row">
            <div class="col-xs-12">
                {!! Form::open(['route' => 'reports.finance.payroll']) !!}
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        {!! Form::label('user_id', 'Employee') !!}
                        {!! Form::select('user_id', $team_member_select, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        {!! Form::label('from_date', 'From') !!}
                        {!! Form::text('from_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        {!! Form::label('to_date', 'To') !!}
                        {!! Form::text('to_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-3">
                    <div class="form-group">
                        <button class="btn btn-primary" class="form-control">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
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
                            <tr> </tr>
                                <td>{{ $wo->invoice->first()->id or '' }}</td>
                                <td>{{ $wo->id }}  @if ($wo->shop_work) <span class="bg-info">Shop Work</span> @endif</td>
                                <td>{{ $wo->customer->full_name() }}</td>
                                @php 
                                    $ts = 0; 
                                    foreach($wo->services as $s) {
                                        $ts += $s->pivot->line_cost;
                                    }
                                @endphp
                                <td>${{ number_format($ts, 2) }}</td>
                                <td>@if($wo->invoice->first()) ${{ number_format($wo->invoice->first()->amount, 2)  }} @endif</td>
                                <td>{{ $wo->invoice->first()->paid_with or '' }} @if($wo->invoice->first()) ({{ $wo->invoice->first()->transactions->first()->paid_with_detail or '' }}) @endif</td>
                            </tr>
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