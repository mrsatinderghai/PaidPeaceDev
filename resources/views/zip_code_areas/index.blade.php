@extends('layouts.master')
@section('content')


<div class="content-page">
	<div class="container-fluid zip_code">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="col-xs-12 col-md-12">
						<div class="row">
							@include('zip_code_areas.grid');
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection