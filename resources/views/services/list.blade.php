@if (count($services) > 0)
<table class="table table-condensed table-striped">
	<thead>
		<th>Category</th>
		<th>Description</th>
		<th>Cost</th>
		<th>Selling Price</th>
	</thead>
	<tbody>
		@foreach($services as $service)
		<tr>
			<td>{{ $service->category }}</a></td>
			<td><a href="{{ url('service/'.$service->id.'/edit') }}">{{ $service->description }}</a></td>
			<td>${{ $service->cost }}</td>
			<td>${{ $service->sell_price }}</td>
			<td>
				<form action="{{ url('service/'.$service->id) }}" method="POST">
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
