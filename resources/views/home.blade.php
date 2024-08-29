@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    @include('sales.pipeline')
  </div>
  <hr/>
  <div class="row">
    <div class="col-xs-12">
      <h1>Tasks</h1>
      @include('tasks.list')
    </div>
  </div>
</div>

@endsection
