@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Work Order Analyze</h4>
          </div>
      </div>


      <div class="tab-content" id="myTabContent-2">

        <div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                {!! Form::open(['route' => 'work_order.analyze', 'class' => 'form-inline']) !!}
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        {!! Form::label('from_date', 'From') !!}
                        {!! Form::text('from_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        {!! Form::label('to_date', 'To') !!}
                        {!! Form::text('to_date', null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div class="form-group">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
              <table id="datatable-1" class="table data-table table-striped table-bordered">
                <thead>
                 <th>Number</th>
                 <th>Customer</th>
                 <th>Created Date</th>
                 <th>Appointment Date</th>
                 <th>Completed On</th>
                 <th>Zip Code</th>
                 <th>Phone</th>
             </thead>
             <tbody>
                 @foreach($work_orders as $wo)
                 <tr>
                    <td>{{ $wo->id }}</td>
                    <td>{{ $wo->customer->full_name() }}</td>
                    <td>{{ $wo->created_at }}</td>
                    <td>{{ $wo->appointment_date }}</td>
                    <td>{{ $wo->completed_on }}</td>
                    <td>{{ $wo->customer->zip }}</td>
                    <td>{{ $wo->customer->phone_number_formatter() }}</td>   
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                 <th>Number</th>
                 <th>Customer</th>
                 <th>Created Date</th>
                 <th>Appointment Date</th>
                 <th>Completed On</th>
                 <th>Zip Code</th>
                 <th>Phone</th>
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