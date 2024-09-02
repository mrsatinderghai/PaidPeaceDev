@extends('layouts.master')
@section('content')


<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<h1>Trucks</h1>
				</div>
				<div class="card">
					<div class="col-xs-12 col-md-4">
						@include('trucks.add')
					</div>
					<div class="col-xs-12 col-md-8">
						@include('trucks.list')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection