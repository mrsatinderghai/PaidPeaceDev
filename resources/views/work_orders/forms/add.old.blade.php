<script>
  $(function()
  {
    $( "#appointment_date" ).datepicker({ dateFormat: 'yy-mm-dd' });

    var customers = [<?php
                      foreach($customers_all as $customer_fl) {
                        echo '{ value: ' . $customer_fl->id . ', label: "' . $customer_fl->first_name . ' ' . $customer_fl->last_name . '"},';
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Customer</h4>
      </div>
      <div class="modal-body">
        {!! Form::model($customer, ['route' => 'customer.store', 'class' => 'form-horizontal']); !!}
        @include('customers.forms.add')
      </div>
      <div class="modal-footer">
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- end modal -->

{!! Form::model($work_order, ['route' => 'work_order.store', 'class' => 'form-horizontal']); !!}
<div class="form-group">
  {!! Form::label('appointment_date', 'Appointment Date', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-3">
    {!! Form::text('appointment_date', $work_order->appointment_date, ['class' => 'form-control', 'name' => 'appointment_date']) !!}
  </div>
  <div class="col-xs-3">
    {!! Form::select('appointment_time_slot', ['9am-1pm' => '9am-1pm', '12pm-5pm' => '12pm-5pm', 'Other' => 'Other'], '9am-1pm',  ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('customer_id', 'Customer', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-10">
    <input type="text" class="form-control" name="customer_search" id="customer_search"/>
    {!! Form::hidden('customer_id', $customer_id, ['class' => 'form-control', 'id' => 'customer_id']) !!}
  </div>
  <div class="col-xs-1">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary form-control" data-toggle="modal" data-target="#newCustomerModal">
      New
    </button>
  </div>
</div>



<!--<div class="form-group">
  @foreach($services as $service)
    <div class="col-xs-12 col-sm-2">
      {!! Form::checkbox('services[]', $service->id) !!}  {{ $service->description }}
    </div>
  @endforeach
</div>-->

<div class="form-group">
  {!! Form::label('reason', 'Reason', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-11">
    {!! Form::text('reason', null, ['class' => 'form-control']) !!}
  </div>
</div>


<div class="form-group">
  {!! Form::label('assigned_to', 'Assigned To', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-11">
    {!! Form::select('assigned_to', $assigned_to_select, null, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-xs-12">
    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
  </div>
</div>
{!! Form::close() !!}
