@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="col-xs-6">
						<h4 class="ml-3 mt-2">{{ $title }}</h4>
					</div>
					<div class="col-xs-12 col-md-12 list">
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
	var ajaxUrl = $('.table-ajax').attr('data-url');
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
@stop