<!-- Work Order Details Modal -->
<div class="modal fade work-order-modal" id="woDetailsModal{{ $y->id }}" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <a href=" {{ url('work_order/cancel/'.$y->id) }}" class="btn btn-sm btn-danger cancel" style="float:left"><i class="fa fa-times"></i> Cancel</a>
        <a href="{{ route('work_order.edit', $y->id) }}" class="btn btn-lg"><h4 class="modal-title">Work Order: {{ $y->id }}</h4></a>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-12">
            <a href="{{ route('customer.show', $y->customer->id) }}">{{ $y->customer->full_name() }} </a><br />
            {{ $y->customer->address() }} | {!! $y->customer->map_link() !!} <br /> 
            {{ $y->customer->city }},  {{ $y->customer->state }}  {{ $y->customer->zip }}<br />
            <a href="tel:{{ $y->customer->phone_number_formatter() }} ">{{ $y->customer->phone_number_formatter() }}</a><br />
            <a href="tel:{{ $y->customer->phone_number_formatter() }} ">{{ $y->customer->phone_number_formatter('cell') }}</a><br />

          </div>
          <div class="col-12 mt-3">
            <b>Appointment:</b><br />
            <div class="form-group">
              <div class="col-xs-6 pb-2">
                {!! Form::model($y, ['route' => ['work_order.set_time', $y->id], 'method' => 'PATCH', 'class' => 'form-horizontal']); !!}
                {!! Form::text('appointment_date', $y->appointment_date, ['class' => 'form-control appointment_date', 'name' => 'appointment_date']) !!}
              </div>
              <div class="col-xs-6">
                {!! Form::select('appointment_time_slot', ['9am-1pm' => '9am-1pm', '12pm-5pm' => '12pm-5pm', '8am-6pm' => '8am-6pm'], $y->appointment_time_slot,  ['class' => 'form-control']) !!}
              </div>
            </div>

            <b>Delivery Date:</b><br />
            <div class="form-group">
              <div class="col-xs-6">
                {!! Form::model($y, ['route' => ['work_order.set_time', $y->id], 'method' => 'PATCH', 'class' => 'form-horizontal']); !!}
                {!! Form::text('delivery_date', $y->delivery_date, ['class' => 'form-control delivery_date', 'name' => 'delivery_date']) !!}
              </div>
              <div class="col-xs-6"></div>
            </div>       
            
            <div class="form-group">
              {!! Form::label('reason', 'Reason', ['class' => 'col-xs-12 col-sm-3 pl-0']) !!}
              <div class="col-xs-10 col-sm-9 pl-0">
                {!! Form::text('reason', $y->reason, ['class' => 'form-control']) !!}
              </div>
            </div>
            <!--
            <b>Reason: </b>{{ $y->reason }}<br />
            <b>Code: </b>{{ $y->code }}<br />
            -->
            <div class="form-group">
              {!! Form::label('discount', 'Discount', ['class' => 'col-xs-12 col-sm-3 pl-0']) !!}
              <div class="col-xs-10 col-sm-9 pl-0">
                {!! Form::text('discount', $y->discount, ['class' => 'form-control']) !!}
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('code', 'Code', ['class' => 'col-xs-12 col-sm-3 pl-0']) !!}
              <div class="col-xs-10 col-sm-9 pl-0">
                {!! Form::text('code', $y->code, ['class' => 'form-control']) !!}
              </div>
            </div>

            <div class="form-group">
              {!! Form::label('truck_id', 'Truck', ['class' => 'col-xs-12 col-sm-3 pl-0']) !!}
              <div class="col-xs-10 col-sm-9 pl-0">
                {!! Form::select('truck_id', $assigned_to_truck, $y->truck_id, ['class' => 'form-control']) !!}
              </div>
            </div>
            <div class="form-group">
              {!! Form::label('status', 'Status', ['class' => 'col-xs-12 col-sm-3 pl-0']) !!}
              <div class="col-xs-10 col-sm-9 pl-0">
                {!! Form::select('status', $status_options, $y->status, ['class' => 'form-control']) !!}
              </div>
            </div>


           <div class="text-right"> <button class="btn btn-info btn-md" style="">Update Work Order</button></div>
            {!! Form::close() !!}
            <hr />
          </div>
          {!! Form::open(['route' => ['customer.update_notes', $y->customer->id], 'method' => 'PATCH', 'class' => 'form-horizontal w-100']); !!}
          <div class="form-group">
            {!! Form::label('notes', 'Notes', ['class' => 'col-xs-12 col-sm-2']) !!}
            <div class="col-xs-10 ml-2">
              {!! Form::textarea('notes', $y->customer->notes, ['class' => 'form-control']) !!}
            </div>
          </div> 
          <div class="text-right"> {!! Form::submit('Save Customer Notes', ['class' => 'btn btn-info btn-md']) !!}</div>
          {!! Form::close() !!}                  
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
<!-- end modal -->