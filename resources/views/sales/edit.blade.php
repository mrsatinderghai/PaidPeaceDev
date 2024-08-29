@extends('layouts.app')

@section('content')

@include('common.container')

<script>
$(function()
{
  $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
  $( "#close_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
});
</script>

<div class="panel panel-default">
  <div class="panel-heading">
    {{ $sale->name }}
  </div>
  <div class="panel-body">
    @include('common.errors')

    {!! Form::model($sale, array('route' => array('sale.update', $sale->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}
    <div class="form-group">
      {!! Form::label('company_id', 'Company', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::select('company_id', $company_options, $sale->company_id, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::text('name', $sale->name, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('status', 'Status', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::select('status', $status_options, $sale->status, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('amount', 'Amount', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::text('amount', $sale->amount, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::select('assigned_to_user_id', $team_member_options, $sale->assigned_to_user_id, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('start_date', 'Start Date', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::date('start_date', $sale->start_date, array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('close_date', 'Close Date', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::date('close_date', $sale->close_date, array('class' => 'form-control')) !!}
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-6">
        {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

@include('common.end_container')
@endsection
