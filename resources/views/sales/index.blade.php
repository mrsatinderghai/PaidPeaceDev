@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			@include('crm.nav')
		</div>
		<div class="col-xs-12 col-md-10">
			<div class="row">
				<div class="col-xs-6">
					<h1>{{ $title }}</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					@include('sales.add')
				</div>
				<div class="col-xs-12 col-md-8">
					@include('sales.list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
