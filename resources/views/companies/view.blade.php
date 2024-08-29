@extends('layouts.app')

@section('content')


@include('common.container')

<div class="jumbotron">
	<h1>{{ $company->name }}</h1>
	<h3>{{ $company->address }}</h3>
	<h3>{{ $company->city }}, {{ $company->state }}  {{ $company->zip }}</h3>
	<h3>{{ $company->phone }}</h3>
</div>


<h2>Contacts</h2>
<div class="row">
	<div class="col-xs-12 col-md-4">
		@include('contacts.add')
	</div>
	<div class="col-xs-12 col-md-8">
		@include('contacts.list')
	</div>
</div>
<hr/>

<h2>Notes</h2>
<div class="row">
	<div class="col-xs-12 col-md-4">
		@include('notes.add')
	</div>
	<div class="col-xs-12 col-md-8">
		@include('notes.list')
	</div>
</div>
<hr/>

<h2>Tasks</h2>
<div class="row">
	<div class="col-xs-12 col-md-4">
		@include('subtasks.add')
	</div>
	<div class="col-xs-12 col-md-8">
		@include('subtasks.list')
	</div>
</div>
<hr/>

<h2>Sales</h2>
<div class="row">
	<div class="col-xs-12 col-md-4">
		@include('sales.add')
	</div>
	<div class="col-xs-12 col-md-8">
		@include('sales.list')
	</div>
</div>




@include('common.end_container')




@endsection