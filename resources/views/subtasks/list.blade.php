


<!-- Current Tasks -->
@if (count($subtasks) > 0)
<div class="panel panel-default">
    <div class="panel-heading">
        Subtasks
    </div>

    <div class="panel-body">
        <table class="table table-striped task-table">

            <!-- Table Headings -->
            <thead>
                <th>Task</th>
                <th>Due Date</th>
                <th>Assigned To</th>
                <th>Priority</th>
                <th>&nbsp;</th>
            </thead>

            <!-- Table Body -->
            <tbody>
                @foreach ($subtasks as $task)
                <tr>
                    <!-- Task Name -->
                    <td class="table-text">
                        <div><a href="{{ url('task/'.$task->id.'/edit') }}">{{ $task->name }}</a></div>
                    </td>
                    <td>
                     {{ $task->due_date }}
                 </td>
                 <td>
                    {{ $task->assigned_to->name }}
                </td>
                <td class="table-text">
                   {{ $task->priority}}
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
</div>


@endif

