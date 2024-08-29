<div class="panel panel-default">
				<div class="panel-heading">
					New Workflow
				</div>
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('class' => 'form-horizontal', 'route' => 'workflow.store')) !!}
					@if ( ! empty($parent) )
						{!! Form::hidden('parent_id', $parent->id) !!}
						{!! Form::hidden('parent_type', $parent_type) !!}
					@endif
					<div class="form-group">
						{!! Form::label('assign_type', 'Type Assign', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('assign_type', array('Sale' => 'Sale', 'Task' => 'Task'),'Task', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('assign_to', 'Assign To', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('assign_to', $team_members,null, array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('assign_when', 'Assign When', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('assign_when', array('Completed' => 'Completed', 'In Process' => 'In Process'),'Completed', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('name', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('priority', 'Priority', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::select('priority', array('Emergency' => 'Emergency', 'Urgent' => 'Urgent', 'High' => 'High', 'Medium' => 'Medium', 'Low' => 'Low'),'Medium', array('class' => 'form-control')) !!}
						</div>
					</div>
					<?php
	                    $new_due_date = strtotime("+14 day");
	                    $new_due_date = date("Y-m-d", $new_due_date);
                    ?>
					<div class="form-group">
						{!! Form::label('due_date', 'Due Date', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::date('due_date', $new_due_date, array('class' => 'form-control')) !!}
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
