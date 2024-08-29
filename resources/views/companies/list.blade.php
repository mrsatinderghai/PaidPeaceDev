@if (count($companies) > 0)
<table class="table table-striped table-condensed">
	<thead>
		<th>
			Name
		</th>
		<th>
			Phone
		</th>
		<th>
			&nbsp
		</th>
	</thead>
	<tbody>
		@foreach ($companies as $company)
		<tr>
			<td>
				{{ $company->name }}
			</td>
			<td>
				{{ $company->phone }}
			</td>
			<td>
				<form action="{{ url('company/'.$company->id) }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}

					<button class="btn btn-danger" style="float:right">
						<i class="fa fa-trash"></i>
					</button>
				</form>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
@endif
