@extends('layouts.master')

@section('content')

<div class="content-page work_order_form">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          {!! Form::model($customer, ['route' => ['customer.update', $customer->id], 'method' => 'PATCH', 'class' => 'form-horizontal']); !!}
          @include('customers.forms.add')
        </div>
      </div>
    </div>
  </div>
</div>


@endsection