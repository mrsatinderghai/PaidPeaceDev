<div class="panel panel-default">
	<div class="panel-heading">
		New Note
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => 'note.store')) !!}
		<div class="form-group">
			{!! Form::textarea('text', null, array('placeholder' => 'New note...', 'class' => 'form-control')) !!}
			{!! Form::hidden('parent_id', $parent->id) !!}
			{!! Form::hidden('parent_type', $parent_type) !!}
		</div>
		{!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
		{!! Form::close() !!}

	</div>
</div>