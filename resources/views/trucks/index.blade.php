@extends('layouts.master')
@section('content')


<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">				
				<div class="card">
				    <h4 class="m-3">Trucks</h4>
					<div class="col-xs-12 col-md-6 part_section">
						@include('trucks.add')
					</div>
					<div class="col-xs-12 col-md-12">
						@include('trucks.list')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection