@extends('layouts.app')

@section('content')

<script>
$(function()
{
  
});
</script>

<div class="container">
  <div class="row">
    <div class="col-xs-6 col-md-6">
      <h3><strong>Select data to pull</strong></h3>
      
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('route' => 'customer.export_option', 'class' => 'form-horizontal')) !!}
					<div class="form-group form-check">
            {!! Form::checkbox('name', '', false, ['id' => 'name','class' => 'form-check-input']) !!}
            {!! Form::label('name', 'Name', array('class' => 'form-check-label')) !!}
					</div>
					<div class="form-group form-check">
            {!! Form::checkbox('email', '', false, ['id' => 'email','class' => 'form-check-input']) !!}
            {!! Form::label('email', 'Email', array('class' => 'form-check-label')) !!}						
					</div>
					<div class="form-group form-check">
            {!! Form::checkbox('address', '', false, ['id' => 'address','class' => 'form-check-input']) !!}
            {!! Form::label('address', 'Address', array('class' => 'form-check-label')) !!}		
					</div>
					<div class="form-group form-check">
            {!! Form::checkbox('phone', '', false, ['id' => 'phone','class' => 'form-check-input']) !!}
            {!! Form::label('phone', 'Phone', array('class' => 'form-check-label')) !!}		
					</div>
					<div class="form-group form-check">
            {!! Form::checkbox('last_invoice_date', '', false, ['id' => 'last_invoice_date','class' => 'form-check-input']) !!}
            {!! Form::label('last_invoice_date', 'Last Invoice Date', array('class' => 'form-check-label')) !!}		
					</div>
					<hr style="margin-left: -17px; width: 250px;">
          <div class="form-group form-check">
            {!! Form::checkbox('do_not_contact', '', true, ['id' => 'do_not_contact','class' => 'form-check-input']) !!}
            {!! Form::label('do_not_contact', 'Exclude "do not contact" Users', array('class' => 'form-check-label')) !!}		
					</div>
					<div class="form-group">
              <div class=" col-sm-6">
                  {!! Form::submit('Export to Excel', array('class' => 'btn btn-primary text-left')) !!}
                  {!! Form::close() !!}
              </div>
          </div>
				</div>
    </div>
    <div class="col-xs-6 col-md-6">
      <h3><strong>Pull ALL Data</strong></h3>
      <br />
      {!! Form::open(array('route' => 'customer.export_whole', 'class' => 'form-horizontal')) !!}
      <div class="form-group">
          <div class=" col-sm-12">
              {!! Form::submit('Export to Excel', ['id'=>'pull_all', 'class' => 'btn btn-primary text-left']) !!}
              {!! Form::close() !!}
          </div>
      </div>
      <br><br>
      <div class="col-sm-12">
        <b>This should pull all data with each table on a seperate tab.</b>
      </div>
    </div>
  </div>
</div>
@endsection
