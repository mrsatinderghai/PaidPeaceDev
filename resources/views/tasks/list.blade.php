<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li role="presentation" class="active"><a href="#hot" aria-controls="home" role="tab" data-toggle="tab">Hot</a></li>
  <li role="presentation"><a href="#all" aria-controls="profile" role="tab" data-toggle="tab">All</a></li>
  <li role="presentation"><a href="#team" aria-controls="messages" role="tab" data-toggle="tab">Team</a></li>
</ul>


<!-- Tab panes -->
<div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="all">
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
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger"  @endif>
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

  <div role="tabpanel" class="tab-pane" id="hot">
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
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger"  @endif>
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

  <div role="tabpanel" class="tab-pane" id="team">
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
          <td @if (strtotime($task->due_date) <= strtotime('now')) class="danger"  @endif>
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
