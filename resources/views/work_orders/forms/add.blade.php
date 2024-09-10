@extends('layouts.master')
@section('content')
<script>
  jQuery.noConflict();
        jQuery(document).ready(function($) {
    $( "#appointment_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

    var customers = [<?php
      foreach($customers_all as $customer_fl) {
        echo '{ value: ' . $customer_fl->id . ', label: "' . $customer_fl->first_name . ' ' . $customer_fl->last_name . ', ' . $customer_fl->address1 . ', ' . $customer_fl->zip . ', ' . $customer_fl->phone_number_formatter() .'"},';
      }
      ?>];

    $("#customer_search").autocomplete({
      source: customers,
      select: function (event, ui) {
        event.preventDefault()
          $("#customer_id").val(ui.item.value); // save selected id to hidden input
          $("#customer_search").val(ui.item.label); // display the selected text
        }
      });
  });
</script>

<!-- Add customer modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header-">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Customer</h4>
      </div>
      <div class="modal-body">
        {!! Form::model($customer, ['route' => 'customer.store', 'class' => '']); !!}
        @include('customers.forms.add')
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal -->
<div class="content-page">
  <div class="container-fluid scheduleWorkorder New_Work_Order">
    <div class="row">
      <div class="col-sm-12 col-lg-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">New Work Order</h4>
            </div>

            <div class="col-xs-1">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newCustomerModal">
                New
              </button>
            </div>

            
          </div>
          @include('common.errors')

          <div class="card-body">
           {!! Form::model($work_order, ['route' => 'work_order.store', 'class' => 'form-horizontal']); !!}
           <div class="form-group">
            {!! Form::label('customer_id', 'Customer', ['class' => 'col-xs-12']) !!}
            <div class="col-xs-11">
              <input type="text" class="form-control" name="customer_search" id="customer_search" value="{{ $new_customer_name }}"/>
              
              {!! Form::hidden('customer_id', $customer_id, ['class' => 'form-control', 'id' => 'customer_id']) !!}
            </div>
            
          </div>

          <div class="form-group">
            {!! Form::label('reason', 'Reason', ['class' => 'col-xs-12 ']) !!}
            <div class="col-xs-11">
              {!! Form::text('reason', null, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('discount', 'Discount', ['class' => 'col-xs-12 ']) !!}
            <div class="col-xs-11">
              {!! Form::text('discount', null, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('code', 'Code', ['class' => 'col-xs-12 ']) !!}
            <div class="col-xs-11">
              {!! Form::text('code', null, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            <div class="col-xs-12">
              {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
            </div>
          </div>
          {!! Form::close() !!}

        </div>
      </div>
    </div>
  </div>
</div>
</div>

@endsection