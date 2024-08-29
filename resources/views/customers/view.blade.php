@extends('layouts.app')

@section('content')

<div class="container">
  <div class="jumbotron">
    <h2>{{ $customer->full_name() }}</h2>
    {{ $customer->address() }}<br />
    {{ $customer->city }}, {{ $customer->state }}  {{ $customer->zip }}<br />
    <a href="{{ url('customer/'.$customer->id.'/edit') }}" class="btn btn-primary">Edit</a>
  </div>
</div>
@include('work_orders.list')

@endsection
