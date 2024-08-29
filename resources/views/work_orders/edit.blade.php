
@extends('layouts.app')

@section('content')

<script>
  $(function()
  {

    $( "#appointment_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

    var csc = 1;
    $( "#add_custom_service").click(function(event) {
      csc++;
      var new_input = '<input type="text" name="cs[' + csc + ']" id="cs' + csc + '" placeholder="Custom service..." size="50" />';
      new_input += ' <input type="text" name="csi[' + csc + ']" id="csi' + csc + '" placeholder="Qty" size="8"  />';
      new_input += ' <input type="text" name="csp[' + csc + ']" id="csp' + csc + '" placeholder="Price" width="20" /><br />';
      var current_html = $( "#custom_service_holder").html();
      $( "#custom_service_holder" ).append(new_input);
    });

    var cpc = 1;
    $( "#add_custom_part").click(function(event) {
      csc++;
      var new_input = '<input type="text" name="cp[' + cpc + ']" id="cp' + cpc + '" placeholder="Custom part..." size="50" />';
      new_input += ' <input type="text" name="cpi[' + cpc + ']" id="cpi' + cpc + '" placeholder="Qty" size="8"  />';
      new_input += ' <input type="text" name="cpp[' + cpc + ']" id="cpp' + cpc + '" placeholder="Price" width="20" /><br />';
      var current_html = $( "#custom_part_holder").html();
      $( "#custom_part_holder" ).append(new_input);
    });
  });
</script>

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-sm-8">
      <h2>{{ $work_order->customer->full_name() }}</h2>
      {{ $work_order->customer->address1 }}<br />
      {{ $work_order->customer->city }},  {{ $work_order->customer->state }}  {{ $work_order->customer->zip }} <br />
      {{ $work_order->customer->phone_number_formatter() }}<br />
      {{ $work_order->customer->phone_number_formatter('cell') }}<br />
      {{ $work_order->customer->email }}
    </div>
    <div class="col-xs-12 col-sm-4">
      <h2>Work Order: {{ $work_order->id }}</h2>
    </div>
  </div>

  <hr />

  {!! Form::model($work_order, ['route' => ['work_order.update', $work_order->id], 'method' => 'PATCH', 'class' => 'form-horizontal appointment_date']); !!}

  <div class="form-group">
    {!! Form::label('reason', 'Reason', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-10">
      {!! Form::text('reason', $work_order->reason, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('discount', 'Discount', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-10">
      {!! Form::text('discount', $work_order->discount, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('appointment_date', 'Appointment Date', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-3">
      {!! Form::text('appointment_date', $work_order->appointment_date, ['class' => 'form-control', 'name' => 'appointment_date']) !!}
    </div>
    <div class="col-xs-3">
      {!! Form::select('appointment_time_slot', ['9am-1pm' => '9am-1pm', '12pm-5pm' => '12pm-5pm', '8am-6pm' => '8am-6pm'], $work_order->appointment_time_slot,  ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('delivery_date', 'Delivery Date', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-3">
      {!! Form::text('delivery_date', $work_order->delivery_date, ['class' => 'form-control', 'name' => 'delivery_date']) !!}
    </div>
    <div class="col-xs-3">
    </div>
  </div>


  <div class="form-group">
    {!! Form::label('truck_id', 'Truck', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-10">
      {!! Form::select('truck_id', $assigned_to_truck, $work_order->truck_id, ['class' => 'form-control']) !!}
    </div>
  </div>

  <hr />

  <h3>Work Performed:</h3>
  <div class="form-group">
    @foreach($services as $service)
    <div class="col-xs-12 col-sm-2">
      <?php
        $x = null;
        if ($work_order->has_service($service->id)) {$x = 'true';}
      ?>
      {!! Form::checkbox('services[]', $service->id, $x) !!}  {{ $service->description }}
    </div>
    @endforeach
  </div>
  <div id="custom_service_holder">
    <input type="text" name="cs[1]" id="cs1" placeholder="Custom service..." size="50" />
    <input type="text" name="csq[1]" id="csi1" placeholder="Qty" size="8"  />
    <input type="text" name="csp[1]" id="csp1" placeholder="Price" width="20" />
    <button type="button" class="btn btn-xs btn-info" id="add_custom_service" data-counter="1"><i class="fa fa-plus"></i></button><br />
  </div>
  <table class="table table-condensed table-striped">
    <tr>
      <th>Service</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
    @foreach($custom_services as $custom_service)
    <tr>
      <td>{{ $custom_service->name }}</td>
      <td>{{ $custom_service->quantity }}</td>
      <td>${{ $custom_service->sale_price }}</td>
    </tr>
    @endforeach
  </table>


  <hr />

@if (count($products) > 0)
  <h3>Parts:</h3>
  <div class="form-group">
    @foreach($products as $product)
    <div class="col-xs-12 col-sm-2">
      <?php
        $x = null;
        if ($work_order->has_product($product->id)) {$x = 'true';}
      ?>
      {!! Form::checkbox('products[]', $product->id, $x) !!}  {{ $product->description }}
    </div>
    @endforeach
  </div>
@endif

  <div id="custom_part_holder">
    <input type="text" name="cp[1]" id="cp1" placeholder="Custom part..." size="50" />
    <input type="text" name="cpq[1]" id="cpi1" placeholder="Qty" size="8"  />
    <input type="text" name="cpp[1]" id="cpp1" placeholder="Price" width="20" />
    <button type="button" class="btn btn-xs btn-info" id="add_custom_part" data-counter="1"><i class="fa fa-plus"></i></button><br />
  </div>
  <table class="table table-condensed table-striped">
    <tr>
      <th>Part</th>
      <th>Quantity</th>
      <th>Price</th>
    </tr>
    @foreach($custom_parts as $custom_part)
    <tr>
      <td>{{ $custom_part->name }}</td>
      <td>{{ $custom_part->quantity }}</td>
      <td>${{ $custom_part->sale_price }}</td>
    </tr>
    @endforeach
  </table>

  <hr />


  <div class="form-group">
    {!! Form::label('status', 'Status', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-5">
      {!! Form::select('status', $status_options, $work_order->status, ['class' => 'form-control']) !!}
    </div>
    <div class="col-xs-5">
      {!! Form::text('cancellation_reason', $work_order->cancellation_reason, ['class' => 'form-control', 'name' => 'cancellation_reason', 'placeholder' => 'Cancel reason...']) !!}
    </div>
  </div>

  <hr />

  <div class="form-group">
    {!! Form::label('comments', 'Comment', ['class' => 'col-xs-12 col-sm-1']) !!}
    <div class="col-xs-11">
      {!! Form::textarea('comments', $work_order->comments, ['class' => 'form-control']) !!}
    </div>
  </div>


  <div class="form-group">
      <div class="col-xs-2">
        @if ($invoice != null)
          @if ($invoice->status == 'Unpaid')
            <a href="{{ url('/invoice/check_out/'.$invoice->id) }}" class="btn btn-success">Check Out</a>
            {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
          @else
            <span class="text-info">Invoice is already paid</span>
          @endif
        @else
          {!! Form::checkbox('create_invoice', 'create_invoice') !!}  Create Invoice<br />
          {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
        @endif
      </div>
  </div>

  <div class="form-group">
  {!! Form::label('preferred_contact_method', 'Preferred Contact Method', ['class' => 'col-xs-12 col-sm-6']) !!}
  <div class="col-xs-12 col-sm-6">
    {!! Form::select('preferred_contact_method',$work_order->customer->contact_methods, $work_order->customer->preferred_contact_method,  ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('wants_follow_up_calls', 'Promotions', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-1">
    <?php
    $x = null;
    if ($work_order->customer->wants_follow_up_calls == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('wants_follow_up_calls', 1, $x) !!}
  </div>
  {!! Form::label('do_not_contact', 'Do Not Contact', ['class' => 'col-xs-12 col-sm-2']) !!}
  <div class="col-xs-12 col-sm-1">
    <?php
    $x = null;
    if ($work_order->customer->do_not_contact == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('do_not_contact', 1, $x) !!}
  </div>
</div>
  
  <div class="form-group">
    <div class="col-xs-12">

    </div>
  </div>
  {!! Form::close() !!}
</div>


@endsection
