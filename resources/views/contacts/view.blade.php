@extends('layouts.app')

@section('content')


@include('common.container')

<div class="jumbotron">
	<h1>{{ $contact->name }}</h1>
	<h3>{{ $contact->title }}</h3>
	<h3>{{ $contact->email }}</h3>
	<h3>{{ $contact->phone }}</h3>
	<h3>{{ $contact->cell_phone }}</h3>

</div>


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



@include('common.end_container')




@endsection