
<table class="table table-striped table-condensed">
	<thead>
		<th>Name</th>
		<th>Title</th>
		<th>Email</th>
		<th>Phone</th>
		<th>Cell</th>
	</thead>
	<tbody>
		@foreach($contacts as $contact)
		<tr>
			<td><a href="{{ url('contact/'.$contact->id) }}">{{ $contact->name }}</a></td>
			<td>{{ $contact->title }}</td>
			<td>{{ $contact->email }}</td>
			<td>{{ $contact->phone }}</td>
			<td>{{ $contact->cell_phone }}</td>
			<td>
				<form action="{{ url('contact/'.$contact->id) }}" method="POST">
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
	
		