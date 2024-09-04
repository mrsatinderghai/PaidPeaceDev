@extends('layouts.app')

@section('content')

<script>
$(function()
{
  //$('.section').hide();

  $('h3').click(function(event) {
    var sender = event.target.id;
    var section = event.target.id + '_section';
    if ($("#add_work_order").text() != "Close") {
      $("#add_work_order").text("Close");
    } else {
      $("#add_work_order").html('<i class="fa fa-plus"></i> New Work Order');
    }
    $('#' + section).slideToggle();
  });
});
</script>

<div class="container">
  <div class="row">
    <div class="col-xs-12">
      <h3 id="add_work_order" class="btn btn-default">Close</h3>
      <a href="{{ route('work_order.analyze') }}" style="float:right" class="btn btn-warning">Analyze Work Orders</a>
      @include('common.errors')
      <div class="section" id="add_work_order_section">
        <hr />
        <h4>New Work Order</h4>

        @include('work_orders.forms.add')
      </div>
    </div>
  </div>
</div>


<hr />

@include('work_orders.list')

@endsection
