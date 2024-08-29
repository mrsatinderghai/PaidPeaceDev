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
					<h1>Parts</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					@include('products.add')
				</div>
				<div class="col-xs-12 col-md-8">
					@include('products.list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
