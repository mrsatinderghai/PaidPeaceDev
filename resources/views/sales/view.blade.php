@extends('layouts.app')

@section('content')


@include('common.container')

<script>
$(function() {
	$('.section').hide();

	$('h2').click(function(event) {
		var sender = event.target.id;
		var section = event.target.id + '_section';
		$('#' + section).slideToggle();
	});
});
</script>


<div class="row">
	<div class="col-xs-12 col-md-2">
		@include('crm.nav')
	</div>
	<div class="col-xs-12 col-md-10">
		<div class="jumbotron">
				<h2>{{ $sale->name }}</h2>
				<b>Status: </b>{{ $sale->status }}<br/>
				<b>Amount: </b>${{ $sale->amount }}<br/>
				<a href="{{ url('sale/'.$sale->id.'/edit')}}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
		</div>

		@include('activities.log')

		<div class="row">
			<div class="col-xs-12">
				<div class="col-xs-12">
					@include('activities.list')
				</div>
			</div>
		</div>

			<h2 id="notes">Notes</h2>
			<div class="section" id="notes_section">
				<div class="row">
					<div class="col-xs-12 col-md-4">
						@include('notes.add')
					</div>
					<div class="col-xs-12 col-md-8">
						@include('notes.list')
					</div>
				</div>
			</div>
			<hr/>

			<h2 id="tasks">Tasks</h2>
			<div class="section" id="tasks_section">
				<div class="row">
					<div class="col-xs-12 col-md-4">
						@include('subtasks.add')
					</div>
					<div class="col-xs-12 col-md-8">
						@include('subtasks.list')
					</div>
				</div>
			</div>
			<hr/>

			<h2 id="invoices">Invoices</h2>
			<div class="section" id="invoices_section">
				<div class="row">
					<div class="col-xs-12 col-md-4">
						@include('invoices.add')
					</div>
					<div class="col-xs-12 col-md-8">
						@include('invoices.list')
					</div>
				</div>
			</div>
			<hr/>

			<h2 id="workflows">Workflows</h2>
			<div class="section" id="workflows_section">
				<div class="row">
					<div class="col-xs-12 col-md-4">
						@include('workflows.add')
					</div>
					<div class="col-xs-12 col-md-8">
						@include('workflows.list')
					</div>
				</div>
	</div>
</div>





	@include('common.end_container')




	@endsection
