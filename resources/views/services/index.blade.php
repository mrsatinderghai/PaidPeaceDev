@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="col-xs-6 part_head_sec">
						<h1>Services</h1>
					</div>
				</div>
				<div class="card">
					<div class="col-xs-12 col-md-6 part_section">
						@include('services.add')
					</div>
					<div class="col-xs-12 col-md-12">
						@include('services.list')
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection