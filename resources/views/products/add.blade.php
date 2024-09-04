<div class="panel panel-default Part_page">
  <div class="panel-heading">
    New Product
  </div>
  <div class="panel-body">
    @include('common.errors')

    {!! Form::model($product, ['route' => 'product.store', 'class' => 'form-horizontal']) !!}
    <div class="form-group">
      {!! Form::label('category', 'Part No.', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::text('category', '', array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('description', 'Description', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        {!! Form::text('description', '', array('class' => 'form-control')) !!}
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('cost', 'Cost $', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        <div class="input-group">
          <!-- <span class="input-group-addon">$</span> -->
          {!! Form::text('cost', '', array('class' => 'form-control')) !!}
        </div>
      </div>
    </div>
    <div class="form-group">
      {!! Form::label('sell_price', 'Selling Price $', array('class' => 'col-sm-4 control-label')) !!}
      <div class="col-sm-8">
        <div class="input-group">
          <!-- <span class="input-group-addon">$</span> -->
          {!! Form::text('sell_price', '', array('class' => 'form-control')) !!}
        </div>
      </div>
    </div>

    <div class="form-group">
      <div class="col-sm-offset-4 col-sm-12 add_btnn">
        {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
