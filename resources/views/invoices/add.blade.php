<div class="panel panel-default">
				<div class="panel-heading">
					New Invoice
				</div>
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('route' => 'invoice.store', 'class' => 'form-horizontal')) !!}
					@if ( ! empty($parent) )
						{!! Form::hidden('parent_id', $parent->id) !!}
						{!! Form::hidden('parent_type', $parent_type) !!}
					@endif
					<div class="form-group">
						{!! Form::label('number', 'Number', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('number', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('amount', 'Amount', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('amount', '', array('class' => 'form-control')) !!}
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