
@if (count($activities) > 0)
<table class="table table-striped task-table">
  <thead>
    <th>User</th>
    <th>Type</th>
    <th>Timestamp</th>
    <th>Detail</th>
    <th></th>
  </thead>
  <tbody>
    @foreach($activities as $activity)
    <tr>
      <td>
        {{ $activity->owner->name }}
      </td>
      <td>
        {{ $activity->type }}
      </td>
      <td>
        {{ $activity->created_at }}
      </td>
      <td>
        {{ $activity->detail }}
      </td>
      <td>
        <form action="{{ url('activity/'.$activity->id) }}" method="POST">
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
