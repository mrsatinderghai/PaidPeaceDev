@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header d-flex justify-content-between">
						<div class="header-title">
							<h4 class="card-title">Tasks</h4>
						</div>
					</div>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active"><a href="#hot" aria-controls="home" role="tab" data-toggle="tab">Hot</a></li>
						<li role="presentation"><a href="#all" aria-controls="profile" role="tab" data-toggle="tab">All</a></li>
						<li role="presentation"><a href="#team" aria-controls="messages" role="tab" data-toggle="tab">Team</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="card-body table-responsive tab-pane active" id="hot">
							<table id="datatable-1" class="table data-table table-striped table-bordered">
								<thead>
									<tr>
										<th>Team1</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
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
								<tfoot>
									<tr>
										<th>Team</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div role="tabpanel" class="card-body table-responsive tab-pane" id="all">
							<table id="datatable-1" class="table data-table table-striped table-bordered">
								<thead>
									<tr>
										<th>Team2</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
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
								<tfoot>
									<tr>
										<th>Team</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<div role="tabpanel" class="card-body table-responsive tab-pane" id="team">
							<table id="datatable-1" class="table data-table table-striped table-bordered">
								<thead>
									<tr>
										<th>Team3</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
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
								<tfoot>
									<tr>
										<th>Team</th>
										<th>Due Date</th>
										<th>Assigned To</th>
										<th>Priority</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
</div>
@endsection