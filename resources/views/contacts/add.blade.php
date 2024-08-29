<div class="panel panel-default">
				<div class="panel-heading">
					New Contact
				</div>
				<div class="panel-body">
					@include('common.errors')

					{!! Form::open(array('route' => 'contact.store', 'class' => 'form-horizontal')) !!}
					@if ( ! empty($parent) )
						{!! Form::hidden('parent_id', $parent->id) !!}
					@endif
					<div class="form-group">
						{!! Form::label('name', 'Name', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('name', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('title', 'Title', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('title', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('email', 'Email', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('email', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('phone', 'Phone', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('phone', '', array('class' => 'form-control')) !!}
						</div>
					</div>
					<div class="form-group">
						{!! Form::label('cell_phone', 'Cell Phone', array('class' => 'col-sm-4 control-label')) !!}
						<div class="col-sm-8">
							{!! Form::text('cell_phone', '', array('class' => 'form-control')) !!}
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