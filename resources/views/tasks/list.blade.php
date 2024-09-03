<!-- Nav tabs -->
<ul class="nav nav-tabs" id="myTab-1" role="tablist">
  <li class="presentation">
    <a class="nav-link active" id="hot-tab" data-toggle="tab" href="#hot" role="tab" aria-controls="hot" aria-selected="false">Hot</a>
  </li>
  <li role="presentation" class="active">
    <a class="nav-link" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
  </li>
  <li class="presentation">
    <a class="nav-link" id="team-tab" data-toggle="tab" href="#team" role="tab" aria-controls="team" aria-selected="false">Team</a>
  </li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane show active" id="hot" aria-labelledby="hot-tab">
    <table class="table table-striped task-table">

      <!-- Table Headings -->
      <thead>
        <th>Task</th>
        <th>Due Date</th>
        <th>Assigned To</th>
        <th>Priority</th>
        <th>Status</th>
        <th>&nbsp;</th>
      </thead>

      <!-- Table Body -->
      <tbody>
        @foreach ($tasks as $task)
        <tr>
          <!-- Task Name -->
          <td class="table-text">
            <div><a href="{{ url('task/'.$task->id.'/edit') }}">{{ $task->name }}</a></div>
          </td>
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger" @endif>
              {{ $task->due_date }}
          </td>
          <td>
            {{ $task->assigned_to->name }}
          </td>
          <td class="table-text @if($task->priority == 'Emergency') danger @endif">
            {{ $task->priority}}
          </td>
          <td>
            {{ $task->status }}
          </td>
          <td>
            <form action="{{ url('task/'.$task->id) }}" method="POST">
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
  </div>

  <div role="tabpanel" class="tab-pane fade" id="all" aria-labelledby="all-tab">
    <table class="table table-striped task-table">

      <!-- Table Headings -->
      <thead>
        <th>Task</th>
        <th>Due Date</th>
        <th>Assigned To</th>
        <th>Priority</th>
        <th>Status</th>
        <th>&nbsp;</th>
      </thead>

      <!-- Table Body -->
      <tbody>
        @foreach ($hot_tasks as $task)
        <tr>
          <!-- Task Name -->
          <td class="table-text">
            <div><a href="{{ url('task/'.$task->id.'/edit') }}">{{ $task->name }}</a></div>
          </td>
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger" @endif>
              {{ $task->due_date }}
          </td>
          <td>
            {{ $task->assigned_to->name }}
          </td>
          <td class="table-text @if($task->priority == 'Emergency') danger @endif">
            {{ $task->priority}}
          </td>
          <td>
            {{ $task->status }}
          </td>
          <td>
            <form action="{{ url('task/'.$task->id) }}" method="POST">
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
  </div>

  <div role="tabpanel" class="tab-pane fade" id="team" aria-labelledby="team-tab">
    <table class="table table-striped task-table">

      <!-- Table Headings -->
      <thead>
        <th>Task</th>
        <th>Due Date</th>
        <th>Assigned To</th>
        <th>Priority</th>
        <th>Status</th>
        <th>&nbsp;</th>
      </thead>

      <!-- Table Body -->
      <tbody>
        @foreach ($team_tasks as $task)
        <tr>
          <!-- Task Name -->
          <td class="table-text">
            <div><a href="{{ url('task/'.$task->id.'/edit') }}">{{ $task->name }}</a></div>
          </td>
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger" @endif>
              {{ $task->due_date }}
          </td>
          <td>
            {{ $task->assigned_to->name }}
          </td>
          <td class="table-text @if($task->priority == 'Emergency') danger @endif">
            {{ $task->priority}}
          </td>
          <td>
            {{ $task->status }}
          </td>
          <td>
            <form action="{{ url('task/'.$task->id) }}" method="POST">
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
  </div>