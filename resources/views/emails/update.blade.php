<img src="http://jexly.net/img/Jexly.png" height="50px" width="200px"/>
<h3>Task:  <a href="{{ url('task/'.$item->id.'/edit') }}">{{ $item->name }}</a></h3>
<h3>Status:  {{ $item->status }}</h3>
<h3>Assigned To: {{ $item->assigned_to_name }}</h3>
<h3>Notes</h3>
<table border=0 cellpadding=3>
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
		</tr>
		@endforeach
	</tbody>
</table>


