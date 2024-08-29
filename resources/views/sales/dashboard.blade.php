@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			@include('crm.nav')
		</div>
		<div class="col-xs-12 col-md-10">
			<h1>{{ $title }}</h1>
			@include('sales.dashboard_detail')
		</div>
	</div>
</div>
@endsection
