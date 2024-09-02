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
					<div class="col-xs-12 col-md-12 list">
						@include('invoices.send_list')
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
				data: 'created_at',
				name: 'created_at'
			},
			{
				data: 'customer',
				name: 'customer',
				orderable: false,
				searchable: false
			},
			{
				data: 'address',
				name: 'address',
				orderable: false,
				searchable: false
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
				data: 'sent',
				name: 'sent',
				orderable: false,
				searchable: false
			}
		]
	})
</script>
@stop