<img src="http://jexly.net/img/Jexly.png" />
<h1>Lead:  <a href="{{ url('sale/'.$item->id) }}">{{ $item->name }}</a></h1>
<h2>Status:  {{ $item->status }}</h2>

<hr/>
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


