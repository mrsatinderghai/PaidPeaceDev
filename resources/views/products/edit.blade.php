@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-md-2">
			@include('finance.nav')
		</div>
		<div class="col-xs-12 col-md-10">
			<div class="row">
				<div class="col-xs-12">
          <div class="jumbotron">
            <h1>{{ $product->description }}</h1> <a href="{{ route('product.retire', $product->id) }}" class="btn btn-warning" style="float:right">Retire</a>
          </div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
          {!! Form::model($product, ['route' => ['product.update', $product->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

          <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            {!! Form::text('description', $product->description, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
            {!! Form::text('category', $product->category, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cost', 'Cost', ['class' => 'control-label']) !!}
            <div class="input-group">
              <span class="input-group-addon">$</span>
                {!! Form::text('cost', $product->cost, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('sell_price', 'Selling Price', ['class' => 'control-label']) !!}
            <div class="input-group">
              <span class="input-group-addon">$</span>
                {!! Form::text('sell_price', $product->sell_price, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('on_hand', 'On Hand', ['class' => 'control-label']) !!}
            {!! Form::text('on_hand', $product->on_hand, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('on_order', 'On Order', ['class' => 'control-label']) !!}
            {!! Form::text('on_order', $product->on_order, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
              {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
              {!! Form::close() !!}
          </div>

				</div>
			</div>
		</div>
	</div>
</div>
@endsection
