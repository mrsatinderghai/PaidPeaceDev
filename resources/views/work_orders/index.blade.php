@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid Work_order">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Work Order</h4>
            </div>
          </div>


          <div class="tab-content" id="myTabContent-2">

            <div class="row">


              <div class="col-xs-12 col-md-6 p-0">
                {!! Form::open(['route' => 'work_order.filter', 'class' => 'form-horizontal']) !!}
                <div class="form-group d-flex">
                 
                   <div class="col-md-2">
                     {!! Form::label('filter_by', 'Filter By', ['class' => '']) !!} 
                  </div>
                  <div class="col-md-4">
                   
                    {!! Form::select('filter_by', $status_options, 'All', ['class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-6">
                    {!! Form::submit('Filter', array('class' => 'btn btn-primary')) !!}
                    <a href="{{ route('work_order.index')}}" class='btn btn-info'>Clear Filter</a>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>


              <div class="col-xs-12 col-md-6">
                {!! Form::open(['route' => 'work_order.search', 'class' => 'form-horizontal']) !!}
                <div class="form-group d-flex">
                  {!! Form::label('search_work_order', 'Search Work Order Number', ['class' => 'col-xs-12 col-sm-6 search_work_order']) !!}
                  <div class="col-xs-12 col-sm-4">
                   {!! Form::text('search_work_order', null, ['class' => 'form-control']) !!}
                 </div>
                 <div class="col-xs-12 col-sm-2">
                  {!! Form::submit('Search', array('class' => 'btn btn-primary')) !!}
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
          </div>


          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable-1" class="table data-table table-striped table-bordered">
                <thead>
                  <th>Edit</th>
                  <th>Action</th>
                  <th>Delete</th>
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

                          <div class="iq-icons-list">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
                              <path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                          </div>
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
                  <tfoot>
                    <tr>
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
                   </tr>
                 </tfoot>
               </table>
             </div>
           </div>

         </div>
       </div>

     </div>
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
      @endsection