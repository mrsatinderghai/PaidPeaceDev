@extends('layouts.app')

@section('content')



<div class="container">
	<div class="row">
		<div class="col-xs-12">
			<h1>Trucks</h1>
		</div>
		<div class="row">
			<div class="col-xs-12 col-md-4">
					@include('trucks.add')
			</div>
			<div class="col-xs-12 col-md-8">
				@include('trucks.list')
			</div>
		</div>
	</div>
</div>
@endsection
