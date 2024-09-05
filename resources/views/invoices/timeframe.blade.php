@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="col-xs-6">
						<h1>{{ $title }}</h1>
					</div>
				</div>
				<div class="card">
					<div class="col-xs-12">
						{!! Form::open(['route' => 'invoices.timeframe', 'class' => 'form-inline']) !!}
						<div class="col-xs-12 col-md-4">
							<div class="form-group">
								{!! Form::label('from_date', 'From') !!}
								{!! Form::text('from_date', null, ['class' => 'form-control ml-2']) !!}
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="form-group">
								{!! Form::label('to_date', 'To') !!}
								{!! Form::text('to_date', null, ['class' => 'form-control ml-2']) !!}
							</div>
						</div>
						<div class="col-xs-12 col-md-4">
							<div class="form-group">
								<button class="btn btn-primary" class="form-control">Submit</button>
							</div>
						</div>
						{!! Form::close() !!}
					</div>

					<div class="col-xs-12 col-md-12">
						@include('invoices.list')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css" />
<script src='//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
<script>
	var ajaxUrl = `${$('.table-ajax').attr('data-url')}?from_date={{request()->from_date}}&to_date={{request()->to_date}}`;
	$('.table-ajax').DataTable({
		processing: true,
		serverSide: true,
		ajax: ajaxUrl,
		columns: [{
				data: 'number',
				name: 'number'
			},
			{
				data: 'customer',
				name: 'customer',
				orderable: false,
				searchable: false
			},
			{
				data: 'created_at',
				name: 'created_at'
			},
			{
				data: 'status',
				name: 'status'
			},
			{
				data: 'amount',
				name: 'amount'
			},
			{
				data: 'view',
				name: 'view',
				orderable: false,
				searchable: false
			},
			{
				data: 'checkout',
				name: 'checkout',
				orderable: false,
				searchable: false
			},
			{
				data: 'delete',
				name: 'delete',
				orderable: false,
				searchable: false
			}
		],
		"order": [
			[2, "desc"]
		]
	})
</script>
<script>
	$(function() {
		$("#from_date").datepicker({
			dateFormat: 'yy-mm-dd'
		});
		$("#to_date").datepicker({
			dateFormat: 'yy-mm-dd'
		});
	});
</script>
@stop