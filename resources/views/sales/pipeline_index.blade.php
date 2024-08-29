@extends('layouts.app')

@section('content')


@include('common.container')
<div class="row">
  <div class="col-xs-12 col-md-2">
    @include('crm.nav')
  </div>
  @include('sales.pipeline')
</div>

@include('common.end_container')
@endsection
