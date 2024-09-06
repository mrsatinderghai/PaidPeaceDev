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
            <h3 class="ml-2 my-2">Tasks</h3>
            @include('tasks.list')
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

<script>
 localStorage.removeItem('activeMenu');
</script>