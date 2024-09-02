@extends('layouts.master')
@section('content')


<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          @include('sales.pipeline')
        </div>
        <hr />
        <div class="card">
          <div class="col-xs-12">
            <h1>Tasks</h1>
            @include('tasks.list')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection