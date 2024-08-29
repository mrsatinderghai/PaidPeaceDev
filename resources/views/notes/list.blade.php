
@if (count($notes) > 0)
		<table class="table table-striped task-table">
			<thead>
				<th>Author</th>
				<th>Timestamp</th>
				<th>Text</th>
			</thead>
			<tbody>
				@foreach($notes as $note)
				<tr>
					<td>
						{{ $note->author->name }}
					</td>
					<td>
						{{ $note->created_at }}
					</td>
					<td>
						{{ $note->text }}
					</td>
					<td>
		                <form action="{{ url('note/'.$note->id) }}" method="POST">
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
