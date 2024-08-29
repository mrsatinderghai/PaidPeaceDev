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


					<ul class="nav nav-tabs" id="myTab-1" role="tablist">
						<li class="nav-item">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Hot</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">All</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Team</a>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent-2">

						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="card-body">
								<div class="table-responsive">
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
														<div class="iq-icons-list">
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
																<path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
															</svg>
														</div>

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


						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="card-body">
								<div class="table-responsive">
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
														<div class="iq-icons-list">
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
																<path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
															</svg>
														</div>

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


						<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
							<div class="card-body">
								<div class="table-responsive">
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

														<div class="iq-icons-list">
															<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5} stroke="currentColor" className="size-6">
																<path strokeLinecap="round" strokeLinejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
															</svg>
														</div>

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
</div>
@endsection