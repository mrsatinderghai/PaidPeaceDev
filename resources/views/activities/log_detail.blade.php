@extends('layouts.app')

@section('content')

@include('common.container')

<div class="container">
  <div class="row">
    <div class="col-xs-12 col-md-4 col-md-offset-4">
      {!! Form::open(array('class' => 'form-horizontal', 'route' => 'activity.store')) !!}
      {!! Form::hidden('parent_id', $parent_id) !!}
			{!! Form::hidden('parent_type', $parent_type) !!}
      {!! Form::hidden('type', $type) !!}
      <h2>Detail</h2>
      <div class="form-group">
        <div class="col-sm-12">
          {!! Form::textarea('detail', '', array('class' => 'form-control')) !!}
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-4 col-sm-6">
          {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
          {!! Form::close() !!}
        </div>
      </div>
    </div>
  </div>
</div>

@include('common.end_container')

@endsection
