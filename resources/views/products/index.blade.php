@extends('layouts.master')
@section('content')
<div class="content-page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="col-xs-6">
						<h1>Parts</h1>
					</div>
				</div>
				<div class="card">
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
</div>
@endsection