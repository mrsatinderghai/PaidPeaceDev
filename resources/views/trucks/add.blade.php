<div class="panel panel-default">
  <div class="panel-heading">
    New Truck
  </div>
  <div class="panel-body">
    @include('common.errors')

    {!! Form::model($truck, ['route' => 'truck.store', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
      {!! Form::label('name', 'Name.', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::text('name', '', array('class' => 'form-control')) !!}
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
