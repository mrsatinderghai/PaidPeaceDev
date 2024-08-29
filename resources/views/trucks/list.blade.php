<script>
	$(function() {
		$(".delete").on("submit", function(){
			return confirm("Do you want to delete this truck?");
		});
	});
</script>
	

@if (count($trucks) > 0)
<table class="table table-condensed table-striped">
	<thead>
		<th>Name</th>
	</thead>
	<tbody>
		@foreach($trucks as $truck)
		<tr @if ($truck->hidden) class="bg-warning" @endif>
			<td><a href="{{ url('truck/'.$truck->id.'/edit') }}">{{ $truck->name }} @if ($truck->hidden) <span class="text-danger">(Hidden)</span> @endif</a></td>
			<td><a href="{{ route('truck.hide', $truck->id) }}" class="btn btn-default">@if ($truck->hidden) Un- @endif Hide From Schedule</a></td>
			<td>
					<form action="{{ url('truck/'.$truck->id) }}" method="POST" class="delete">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
		  
						<button class="btn btn-danger btn-xs">
						  <i class="fa fa-trash"></i>
						</button>
					  </form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endif
