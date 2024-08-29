{{ session('message') or null  }}
<div class="container-fluid">
<div class="row">
  <div class="col-xs-12 col-sm-6">
      {!! Form::open(['route' => 'work_order.filter', 'class' => 'form-horizontal']) !!}
      <div class="form-group">
          {!! Form::label('filter_by', 'Filter By', ['class' => 'col-xs-12 col-sm-2']) !!}
          <div class="col-xs-2 col-sm-3">
            {!! Form::select('filter_by', $status_options, 'All', ['class' => 'form-control']) !!}
          </div>
          <div class="col-xs-2 col-sm-4">
          {!! Form::submit('Filter', array('class' => 'btn btn-primary')) !!}
          <a href="{{ route('work_order.index')}}" class='btn btn-info'>Clear Filter</a>
          {!! Form::close() !!}
          </div>
      </div>
  </div>
  <div class="col-xs-12 col-sm-6">
    {!! Form::open(['route' => 'work_order.search', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
      {!! Form::label('search_work_order', 'Search Work Order Number', ['class' => 'col-xs-12 col-sm-5']) !!}
      <div class="col-xs-12 col-sm-3">
       {!! Form::text('search_work_order', null, ['class' => 'form_control']) !!}
      </div>
      <div class="col-xs-12 col-sm-3">
        {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

  <div class="table-responsive">
    <table class="table table-striped table-condensed">
      <thead>
        <th></th>
        <th></th>
        <th></th>
        <th><a href="{{ url('/work_order/index/id') }}">WO Number</a></th>
        <th><a href="{{ url('/work_order/index/customer_id') }}">Customer</a></th>
        <th>Reason</th>
        <th>Make</th>
        <th>Model</th>
        <th><a href="{{ url('/work_order/index/status') }}">Status</a></th>
        <th><a href="{{ url('/work_order/index/appointment_date') }}">Appointment Date</a></th>
        <th><a href="{{ url('/work_order/index/appointment_time_slot') }}">Time Slot</a></th>
        <th><a href="{{ url('/work_order/index/delivery_date') }}">Delivery Date</a></th>
        <th><a href="{{ url('/work_order/index/assigned_to') }}">Assigned To</a></th>
      </thead>

      <tbody>
        @foreach($work_orders as $work_order)
<!--         <tr class="clickable-row" style="{{$work_order->shop_work ?' background-color:lightblue;':''}} {{$work_order->style()}}" > -->
        <tr class="clickable-row">
          <td>
            <a href="{{ url('/work_order/'.$work_order->id.'/edit/') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
          </td>
          <td>
            @if ( count($work_order->invoice) > 0)
            <a href="{{ url('/work_order/invoice/'.$work_order->id) }}" class="btn btn-success btn-xs" target="_blank"><i class="fa fa-dollar"></i></a>
            @endif
          </td>
          <td>
            <form action="{{ url('work_order/'.$work_order->id) }}" method="POST" class="delete">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}

              <button class="btn btn-danger btn-xs delete-customer">
                <i class="fa fa-trash"></i>
              </button>
            </form>
          </td>
          <td>{{ $work_order->id }}</td>
          <td><a href="{{ url('/customer/'.$work_order->customer->id )}}">{{ $work_order->customer->full_name() }}</a></td>
          <td>{{ $work_order->reason }}</td>
          <td>{{ $work_order->customer->equipment_make }}</td>
          <td>{{ $work_order->customer->equipment_model }}</td>
          <td style="{{$work_order->shop_work ?' background-color:lightblue;':''}} {{$work_order->style()}}" >{{ $work_order->status }}</td>
          <td>{{ $work_order->appointment_date }}</td>
          <td>{{ $work_order->appointment_time_slot}}</td>
          <td>{{ $work_order->delivery_date}} </td>
          <td>
            @if ($work_order->assigned_to != null)
            {{ $work_order->assigned_to_user->name or '' }}
            @else
            Not assigned
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <center>@if (! isset($no_paginate)) {!! $work_orders->render() !!} @endif</center>
  
  <div class="row">
    <div class="col-xs-12">
      <a href="{{ url('work_order/completed') }}" class="btn btn-default">Show Completed</a>
    </div>
  </div>
  
 

</div>
<script>
    $('.delete-customer').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
</script>