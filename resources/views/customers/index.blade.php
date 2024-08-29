@extends('layouts.app')

@section('content')

<script>
$(function()
{
  $('.section').hide();

  $('#add_customer').click(function(event) {
    var sender = event.target.id;
    var section = event.target.id + '_section';
    if ($("#add_customer").text() != "Close") {
      $("#add_customer").text("Close");
    } else {
      $("#add_customer").html('<i class="fa fa-plus"></i> New Customer');
    }
    $('#' + section).slideToggle();
  });

  $('#search_customers').click(function(event) {
    var sender = event.target.id;
    var section = event.target.id + '_section';
    if ($("#search_customers").text() != "Close") {
      $("#search_customers").text("Close");
    } else {
      $("#search_customers").html('<i class="fa fa-search"></i> Search');
    }
    $('#' + section).slideToggle();
  });

  var customers = [<?php
                    foreach($customers_all as $customer_fl) {
                      echo '{ value: ' . $customer_fl->id . ', label: "' . $customer_fl->first_name . ' ' . $customer_fl->last_name . ', ' . $customer_fl->address1 . ', ' . $customer_fl->zip . ', ' . $customer_fl->phone_number_formatter() . '"},';
                    }
                  ?>];

  $("#customer_search").autocomplete({
    source: customers,
    select: function (event, ui) {
        event.preventDefault()
        $("#customer_search_id").val(ui.item.value); // save selected id to hidden input
        $("#customer_search").val(ui.item.label); // display the selected text
    }
  });
});
</script>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-9">
      <h3 id="add_customer" class="btn btn-default"><i class="fa fa-plus"></i> New Customer</h3>
      <h3 id="search_customers" class="btn btn-default"><i class="fa fa-search"></i> Search</h3>
      @include('common.errors')
    </div>
    <div class="col-xs-12 col-sm-3">
      <form action="{{ url('customer/find') }}" method="POST" style="display: inline-block;">
        {{ csrf_field() }}
        <div class="form-group has-feedback" style="display: inline-block;">
          <input type="text" class="form-control" name="customer_search" id="customer_search" placeholder="Search..."  />
          <i class="glyphicon glyphicon-search form-control-feedback"></i>
        </div>
        <input type="hidden" id="customer_search_id" name="customer_search_id" />
        <button class="btn btn-tiny" style="display: inline-block;">>></button>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="section" id="add_customer_section">
        <hr />
        {!! Form::model($customer, ['route' => 'customer.store', 'class' => 'form-horizontal']); !!}
        @include('customers.forms.add')
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-12">
      <div class="section" id="search_customers_section">
        <hr />
        {!! Form::model($customer, ['route' => 'customer.search', 'class' => 'form-horizontal']); !!}
        @include('customers.forms.add')
      </div>
    </div>
  </div>
</div>

<hr />

@include('customers.list')

</hr>

<a href="{{ route('customer.specials') }}" class="btn btn-info">Show Winter Special List</a>

@endsection
