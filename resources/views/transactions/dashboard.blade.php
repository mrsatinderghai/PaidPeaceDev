@extends('layouts.app')

@section('content')
<div class="container">


	<div class="row">
		<div class="col-xs-12 col-md-2">
			@include('finance.nav')
		</div>
		<div class="col-xs-12 col-md-10">
			<h1>Finances Dashboard</h1>
			@include('finance.dashboard')
		</div>
	</div>
</div>
@endsection
