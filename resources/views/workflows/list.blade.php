
@if (count($workflows) > 0)
<table class="table table-striped table-condensed">
	<thead>
		<th>Assign Type</th>
		<th>Assign To</th>
		<th>Assign When</th>
		<th>Fired?</th>
	</thead>
	<tbody>
	@foreach($workflows as $workflow)
		<tr>
			<td><a href="{{ url('/workflow/'.$workflow->id) }}">{{ $workflow->assign_type }}</a></td>
			<td>{{ $workflow->assign_to }}</td>
			<td>{{ $workflow->assign_when }}</td>
			<td>
				@if( $workflow->has_fired )
					<center><i class="fa fa-check"></i></center>
				@endif
			</td>
			<td>
				<form action="{{ url('workflow/'.$workflow->id) }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button class="btn btn-danger">
                        <i class="fa fa-trash"></i>
                    </button>
            	</form>
			</td>
		</tr>
	@endforeach
	</tbody>
</table>
@endif
