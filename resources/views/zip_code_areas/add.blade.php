
@include('common.errors')
{!! Form::open(['route' => 'zipcodearea.store', 'class' => 'form-horizontal', 'method' => 'post']); !!}

<div class="form-group">
  {!! Form::label('zip_code', 'Zip Code', ['class' => 'col-xs-12 col-sm-6']) !!}
  <div class="col-xs-4">
    {!! Form::text('zip_code', null, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('area', 'Area', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-4">
  {!! Form::select('area', $area_select, 'NE', ['class' => 'form-control']) !!}
  </div>
  <div class="col-xs-2">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  </div>
</div>

