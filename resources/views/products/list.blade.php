@if (count($products) > 0)
<table class="table table-condensed table-striped">
	<thead>
		<th>Part No.</th>
		<th>Description</th>
		<th>Cost</th>
		<th>Selling Price</th>
		<th>On Hand</th>
		<th>On Order</th>
		<th></th>
		<th></th>
	</thead>
	<tbody>
		@foreach($products as $product)
		<tr>
			<td>{{ $product->category }}</a></td>
			<td><a href="{{ url('product/'.$product->id.'/edit') }}">{{ $product->description }}</a></td>
			<td>${{ $product->cost }}</td>
			<td>${{ $product->sell_price }}</td>
			<td>
				<form action="{{ url('product/update_inventory/'.$product->id) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('PATCH') }}
					<input type="text" name="on_hand" value="{{ $product->on_hand }}" size="4" />
			</td>
			<td>
					<input type="text" name="on_order" value="{{ $product->on_order }}" size="4" />

			</td>
			<td>
					<button class="btn btn-info">
						<i class="fa fa-check"></i>
					</button>
				</form>
			</td>
			<td>
				<form action="{{ url('product/'.$product->id) }}" method="POST">
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
