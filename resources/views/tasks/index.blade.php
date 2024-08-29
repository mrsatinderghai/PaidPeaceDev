@extends('layouts.master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="row">
				<div class="col-xs-6">
					<h1>Tasks</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
					@include('tasks.add')
				</div>
				<div class="col-xs-12 col-md-8">
					@include('tasks.list')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
