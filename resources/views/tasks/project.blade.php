@extends('layouts.app')

@section('content')

@include('common.container')

<pre>
	<?php print_r($tasks); ?>
</pre>


<table class="table table-striped">
	<thead>
		<th>Name</th>
		<th>Assigned To</th>
		<th>Due Date</th>
		<th></th>
	</thead>
	@foreach($tasks as $task)
		<tr>
			<td><a href="{{ url('task/'.$task->id.'/edit') }}">{{ $task->name }} </a></td>
			<td>{{ $task->assigned_to->name }}</td>
			<td>{{ $task->due_date }}</td>
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
	    @if (count($task->subtasks > 0))
	    	@foreach($task->subtasks as $subtask)
	    		<tr class="info">
	    			<td><a href="{{ url('task/'.$subtask->id.'/edit') }}">{{ $subtask->name }} </a></td>
					<td>{{ $subtask->assigned_to->name }}</td>
					<td>{{ $subtask->due_date }}</td>
					<td>
			            <form action="{{ url('task/'.$subtask->id) }}" method="POST">
			                {{ csrf_field() }}
			                {{ method_field('DELETE') }}

			                <button class="btn btn-danger">
			                    <i class="fa fa-trash"></i>
			                </button>
			            </form>
			        </td>
		        </tr>
	        @endforeach
        @endif
    @endforeach
</table>

@include('common.end_container')

@endsection