@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			@include('finance.nav')
		</div>
		<div class="col-xs-12 col-md-10">
			<div class="row">
				<div class="col-xs-6">
					<h1>{{ $title }}</h1>
				</div>
				<div class="col-xs-6">
					<h3 align="right">${{ $balance }}</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					@include('transactions.add')
				</div>

				<div class="col-xs-12 col-md-8">
					@include('transactions.list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
