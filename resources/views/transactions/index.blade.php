@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card ledger_sect">
					<div class="col-xs-6 col-md-6">
						<h1>{{ $title }}</h1>
					</div>
					<div class="col-xs-6 col-md-6">
						<h3 align="right">${{ $balance }}</h3>
					</div>
				</div>
				<div class="card">
					<div class="col-xs-12 col-md-6 part_section">
						@include('transactions.add')
					</div>

					<div class="col-xs-12 col-md-8">
						@include('transactions.list')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection