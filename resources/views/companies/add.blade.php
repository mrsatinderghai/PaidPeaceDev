<div class="panel panel-default">
				<div class="panel-heading">
					New Customer
				</div>
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('class' => 'form-horizontal', 'route' => 'company.store')) !!}
					<div class="form-group">
						{!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('name', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('address', 'Address', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('address', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('city', 'City', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('city', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('state', 'State', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('state', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('zip', 'Zip', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('zip', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('phone', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('website', 'Website', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('website', '', array('class' => 'form-control')) !!}
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
