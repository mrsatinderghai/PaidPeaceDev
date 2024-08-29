
@extends('layouts.app')

@section('content')

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
      @if ($work_order->shop_work) 
        <h3 class="bg-danger">Shop Work</h3> 
      @endif
      <a href="{{ route('work_order.shop_work', $work_order->id) }}" class="btn btn-primary">@if ($work_order->shop_work) Remove from Shop Work @else Shop Work @endif</a>
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

<div class="row">
  <div class="col-xs-12 col-sm-6">
    <h3>Work Performed:</h3>

      @foreach($work_order->services as $service)
     
        <div class="col-xs-7">
            {{ $service->description }} 
        </div>
        <div class="col-xs-4">
            <span class="prevServCost">{{ $service->pivot->sale_price }}</span> 
        </div>
        <div class="col-xs-1">
            <a href="{{ url('/work_order/' . $work_order->id . '/remove_service/' . $service->id) }}" class="btn btn-danger btn-xs">x</a>
        </div>
      @endforeach
    <div class="row">
      <div class="col-xs-8">
          {!! Form::select('service1', $services_select, 0, ['class' => 'form-control service-select', 'id' => 'service1']) !!}
      </div>
      <div class="col-xs-4">
          {!!Form::text('service1cost', '0.00', ['class' => 'form-control laborcalc', 'id' => 'service1cost'] ) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-8">
          {!! Form::select('service2', $services_select, 0, ['class' => 'form-control service-select', 'id' => 'service2']) !!}
      </div>
      <div class="col-xs-4">
          {!!Form::text('service2cost', '0.00', ['class' => 'form-control laborcalc', 'id' => 'service2cost']) !!}
      </div>
    </div>
    <div class="row">
      <div class="col-xs-8">
          {!! Form::select('service3', $services_select, 0, ['class' => 'form-control service-select', 'id' => 'service3']) !!}
      </div>
      <div class="col-xs-4">
          {!!Form::text('service3cost', '0.00', ['class' => 'form-control laborcalc', 'id' => 'service3cost']) !!}
      </div>
    </div>
</div>
<div class="col-xs-12 col-sm-6">
<h3>Parts: <a href="#" style="float:right" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#newPartModal">Add</a></h3> 
    <input type="text" class="form-control" name="part1" id="part_search" class="form-control"/>
    <div class="parts-holder">
    <ul id="parts-list" style="list-style-type: none;">
    <?php $count = 1; ?>
      @foreach($work_order->products as $product)
        <li>
          <div class="row">
            <div class="col-xs-7">
              {{ $product->category }} - {{ $product->description }} 
            </div>
            <div class="col-xs-2">
              <input type="text" id="{{ 'part' . $count . 'qty' }}" name="{{ 'part' . $count . 'qty' }}" class="partcalc form-control" disabled value="{{ $product->pivot->quantity }}" />
            </div>
            <div class="col-xs-2">
              <input type="text" id="{{ 'part' . $count . 'cost' }}" name="{{ 'part' . $count . 'cost' }}" class="partcalc form-control" disabled value="{{ $product->pivot->sale_price }}" />
            </div>
            <div class="col-xs-1">
              <a href="{{ url('/work_order/' . $work_order->id . '/remove_part/' . $product->id) }}" class="btn btn-danger btn-xs">x</a>
            </div>
          </div>  
        </li>
        @php $count++; @endphp
      @endforeach
      </ul>
    </div>
</div>
</div>
<hr>
<div class="row">
  <div class="col-xs-12 col-md-4 bg-success text-white">
      <h4>Labor: $</h4><h4 id="totalLaborCost">0.00</h4>
  </div>
  <div class="col-xs-12 col-md-4 bg-success text-white">
      <h4>Parts: $</h4><h4 id="totalPartsCost">0.00</h4>
  </div>
  <div class="col-xs-12 col-md-4 bg-success text-white">
      <h4>Total: $</h4><h4 id="totalCost">0.00</h4>
  </div>
</div>

  <hr />


  <div class="form-group">
    {!! Form::label('assigned_to', 'Assigned To', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-5">
      {!! Form::select('assigned_to', $assigned_to_select, $work_order->assigned_to, ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('status', 'Status', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-5">
      {!! Form::select('status', $status_options, $work_order->status, ['class' => 'form-control']) !!}
    </div>
    <div class="col-xs-5">
      {!! Form::text('cancellation_reason', $work_order->cancellation_reason, ['class' => 'form-control', 'name' => 'cancellation_reason', 'placeholder' => 'Cancel reason...']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('shop_work_status', 'Shop Work Status', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-5">
      {!! Form::select('shop_work_status', ['None' => null, 'Needs Estimate' => 'Needs Estimate', 'Estimate Approved' => 'Estimate Approved', 'Ready for Installation' => 'Ready for Installation', 'Parts on Order' => 'Parts on Order', 'Parts on Backorder' => 'Parts on Backorder', 'In Progress' => 'In Progress', 'Ready for Delivery' => 'Ready for Delivery'], $work_order->shop_work_status, ['class' => 'form-control']) !!}
    </div>
  </div>

  <hr />

  <div class="form-group">
    {!! Form::label('comments', 'Comment', ['class' => 'col-xs-12 col-sm-1']) !!}
    <div class="col-xs-11">
      {!! Form::textarea('comments', $work_order->comments, ['class' => 'form-control']) !!}
    </div>
  </div>

<hr>

  <div class="form-group">
    {!! Form::label('preferred_contact_method', 'Preferred Contact Method', ['class' => 'col-xs-12 col-sm-12']) !!}
    <div class="col-xs-12 col-sm-6">
      {!! Form::select('preferred_contact_method',$work_order->customer->contact_methods, $work_order->customer->preferred_contact_method,  ['class' => 'form-control']) !!}
    </div>
  </div>

  <div class="form-group">
    {!! Form::label('wants_follow_up_calls', 'Promotions', ['class' => 'col-xs-12 col-sm-1']) !!}
    <div class="col-xs-12 col-sm-11">
      <?php
      $x = null;
      if ($work_order->customer->wants_follow_up_calls == 1) {
        $x = 'true';
      }
      ?>
      {!! Form::checkbox('wants_follow_up_calls', 1, $x) !!}
    </div>
  </div>
  
  <div class="form-group">
    {!! Form::label('do_not_contact', 'Do Not Contact', ['class' => 'col-xs-12 col-sm-2']) !!}
    <div class="col-xs-12 col-sm-10">
      <?php
      $x = null;
      if ($work_order->customer->do_not_contact == 1) {
        $x = 'true';
      }
      ?>
      {!! Form::checkbox('do_not_contact', 1, $x) !!}
    </div>
  </div>
  
<hr>
  
  <div class="form-group">
        @if ($invoice != null)
          @if ($invoice->status == 'Unpaid')
            <button type="submit" class='btn waves-effect blue accent-1'>Save & Check Out</button>
          @else
            <span class="text-info">Invoice is already paid</span>
          @endif
        @else
        <div class="row">
          <div class="col-xs-12 col-md-4">
              {!! Form::checkbox('send_quote', 'send_quote') !!}  Send Quote<br />
          </div>
          <div class="col-xs-12 col-md-4">
              {!! Form::checkbox('create_invoice', 'create_invoice') !!}  Create Invoice<br />
          </div>
          <div class="col-xs-12 col-md-4">
              {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
          </div>
        </div>   
        @endif
  </div>  

  {!! Form::close() !!}
</div>

<!-- Add part modal -->
<div class="modal fade" id="newPartModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Part</h4>
      </div>
      <div class="modal-body">
      <div class="panel panel-default">
      <div class="panel-heading">
        New Product
      </div>
      <div class="panel-body">
        @include('common.errors')
    
        {!! Form::open(['route' => 'work_order.store_new_part', 'class' => 'form-horizontal']) !!}
        {!! Form::hidden('work_order_id', $work_order->id) !!}
        <div class="form-group">
          {!! Form::label('category', 'Part No.', array('class' => 'col-sm-4 control-label')) !!}
          <div class="col-sm-8">
            {!! Form::text('category', '', array('class' => 'form-control')) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('description', 'Description', array('class' => 'col-sm-4 control-label')) !!}
          <div class="col-sm-8">
            {!! Form::text('description', '', array('class' => 'form-control')) !!}
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('cost', 'Cost', array('class' => 'col-sm-4 control-label')) !!}
          <div class="col-sm-8">
            <div class="input-group">
              <span class="input-group-addon">$</span>
              {!! Form::text('cost', '', array('class' => 'form-control')) !!}
            </div>
          </div>
        </div>
        <div class="form-group">
          {!! Form::label('sell_price', 'Selling Price', array('class' => 'col-sm-4 control-label')) !!}
          <div class="col-sm-8">
            <div class="input-group">
              <span class="input-group-addon">$</span>
              {!! Form::text('sell_price', '', array('class' => 'form-control')) !!}
            </div>
          </div>
        </div>
    
        <div class="form-group">
          <div class="col-sm-offset-4 col-sm-6">
            {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
    </div>
    </div>
    
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal -->


<script>
  var num_parts = {{ $num_parts }};
  $(function() {
    $( "#appointment_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    $( "#delivery_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

    var parts = [<?php
                      foreach($products as $product) {
                        echo '{ value: ' . $product->id . ', label: "' . $product->category . ' - ' . $product->description . '"},';
                      }
                    ?>];
        

    $("#part_search").autocomplete({
      source: parts,
      select: function (event, ui) {
          num_parts++;
          event.preventDefault();
          $("#part_search").val(null);

          var id = ui.item.value;
          var sell_price = 0.00;
          $.post('{{ route('product.get_sell_price') }}', {"id" : id}, function(data, status) {
            sell_price = data;
            var new_html = "<div class='row'><input type='hidden' id='i_part" + num_parts + "' name='part[" + num_parts + "]' value='" + ui.item.value + "'/>   <li id='li_part" + num_parts + "'><div class='row'><div class='col-xs-7'>" + ui.item.label + "</div><div class='col-xs-2'><input type='text' id='part" + num_parts + "qty' value='1' name='part" + num_parts + "qty' class='form-control partcalc' /></div><div class='col-xs-2'><input type='text' id='part" + num_parts + "cost' value='" + sell_price + "' name='part" + num_parts + "cost' class='form-control partcalc' /></div><div class='col-xs-1'><a class='btn btn-danger btn-xs' onclick='remove_part(" + num_parts + ")'>X</a></div></div></li>";
            $("#parts-list").append(new_html);
            $(".partcalc").change(function() {
              calcPartCharges();
            });
            calcPartCharges();
          });
      }
    });

    $("#service1").change(function() {
      var id = this.value;
      $.post('{{ route('service.get_sell_price') }}', {"id" : id}, function(data, status) {
        $("#service1cost").val(data);
        calcLaborCharges();
      });
    });

    $("#service2").change(function() {
      var id = this.value;
      $.post('{{ route('service.get_sell_price') }}', {"id" : id}, function(data, status) {
        $("#service2cost").val(data);
        calcLaborCharges();
      });
    });

    $("#service3").change(function() {
      var id = this.value;
      $.post('{{ route('service.get_sell_price') }}', {"id" : id}, function(data, status) {
        $("#service3cost").val(data);
        calcLaborCharges();
      });
    });

    $(".partcalc").change(function() {
      calcPartCharges();
    });

    $(".laborcalc").change(function() {
      calcLaborCharges();
    });


    calcLaborCharges();
    calcPartCharges();
    
    disabled_status();

  });

  function remove_part(id) {
      i_part = "i_part" + id + "";
      li_part = "li_part" + id + "";
      $("#" + i_part).remove();
      $("#" + li_part).remove();
    }

    function calcLaborCharges() {
      var num_services = {{ $num_services }};
      var prevTotal = 0;
      prevServs = $(".prevServCost");
      prevServs.each(function() {
        prevTotal += parseFloat($(this).text());
      });
      var total = parseFloat($("#service1cost").val()) + parseFloat($("#service2cost").val()) + parseFloat($("#service3cost").val());
      total += prevTotal;
      var string_total = String(total);
      $("#totalLaborCost").text(string_total);
      calcTotalCharges();
    }

    function calcPartCharges() {
      var total = 0;
      for(var x=1; x <= num_parts; x++) {
        var qty = "part" + String(x) + "qty";
        var cost = "part" + String(x) + "cost";
        var total_line = parseFloat($("#" + qty).val()) * parseFloat($("#" + cost).val());
        total += total_line; 
      }
      total = parseFloat(Math.round(total * 100) / 100).toFixed(2);
      string_total = String(total);
      $("#totalPartsCost").text(String(string_total));
      calcTotalCharges();
    }

    function calcTotalCharges() {
      var total_labor = $("#totalLaborCost").text();
      var total_parts = $("#totalPartsCost").text();
      var total = parseFloat(total_labor) + parseFloat(total_parts);
      var string_total = String(total);
      $("#totalCost").text(string_total);
    }
  
  function disabled_status() {
    $(document).find('select#status > option').each(function() {
      console.log(this.text + ' ' + this.value)
      if(this.text == 'Cancelled') $(this).attr('disabled', true);
    })
  }
</script>

<style>
  option:disabled {
    background: #d4d4d4;
  }
</style>
@endsection
