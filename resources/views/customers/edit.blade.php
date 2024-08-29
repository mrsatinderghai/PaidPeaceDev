@extends('layouts.app')

@section('content')

<div class="container">
  {!! Form::model($customer, ['route' => ['customer.update', $customer->id], 'method' => 'PATCH', 'class' => 'form-horizontal']); !!}
  @include('customers.forms.add')
</div>


@endsection
