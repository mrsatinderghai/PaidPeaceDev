<script>
    $(function()
    {
        $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>

<div class="panel panel-default">
	<div class="panel-heading">
		New Transaction
	</div>
	<div class="panel-body">
		@include('common.errors')

		{!! Form::open(array('class' => 'form-horizontal', 'route' => 'transaction.store')) !!}
		<div class="form-group">
			{!! Form::label('other_party', 'Other Party', array('class' => 'col-sm-4 control-label')) !!}
			<div class="col-sm-8">
				{!! Form::text('other_party', '', array('class' => 'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('type', 'Type', array('class' => 'col-sm-4 control-label')) !!}
			<div class="col-sm-8">
				{!! Form::select('type', array('Payable' => 'Payable', 'Receivable' => 'Receivable'),null, array('class' => 'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			{!! Form::label('amount', 'Amount', array('class' => 'col-sm-4 control-label')) !!}
			<div class="col-sm-8">
				{!! Form::text('amount', '', array('class' => 'form-control')) !!}
			</div>
		</div>
    <div class="form-group">
			{!! Form::label('tender', 'Tender', array('class' => 'col-sm-4 control-label')) !!}
			<div class="col-sm-8">
				{!! Form::select('tender', array('Cash' => 'Cash', 'Card' => 'Card', 'Check' => 'Check'), null, array('class' => 'form-control')) !!}
			</div>
		</div>
		<?php
        $date = date("Y-m-d");
        ?>
		<div class="form-group">
		    {!! Form::label('date', 'Date', array('class' => 'col-sm-4 control-label')) !!}
			<div class="col-sm-8">
				{!! Form::date('date', $date, array('class' => 'form-control')) !!}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-12 add_btnn">
				{!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
