<script>
    $(function()
    {
        $( "#start_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
        $( "#close_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>

<div class="panel panel-default">
				<div class="panel-heading">
					New Sale
				</div>
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('class' => 'form-horizontal', 'route' => 'sale.store')) !!}
					@if ( ! empty($parent) )
						{!! Form::hidden('parent_id', $parent->id) !!}
					@endif
          <div class="form-group">
						{!! Form::label('company_id', 'Customer', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('company_id', $company_options, null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('name', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('status', 'Status', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('status', $status_options,null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('amount', 'Amount', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('amount', '', array('class' => 'form-control')) !!}
						</div>
					</div>
          <div class="form-group">
            {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => 'col-sm-4 control-label')) !!}
            <div class="col-sm-8">
              {!! Form::select('assigned_to_user_id', $team_member_options, null, array('class' => 'form-control')) !!}
            </div>
          </div>
					<div class="form-group">
						{!! Form::label('start_date', 'Start Date', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::date('start_date', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('close_date', 'Close Date', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::date('close_date', '', array('class' => 'form-control')) !!}
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
