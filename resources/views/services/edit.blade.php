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
            <h1>{{ $service->description }}</h1> <a href="{{ route('service.retire', $service->id) }}" class="btn btn-warning" style="float:right">Retire</a>
          </div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
          {!! Form::model($service, ['route' => ['service.update', $service->id], 'class' => 'form-horizontal', 'method' => 'PATCH']) !!}

          <div class="form-group">
            {!! Form::label('description', 'Description', ['class' => 'control-label']) !!}
            {!! Form::text('description', $service->description, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('category', 'Category', ['class' => 'control-label']) !!}
            {!! Form::text('category', $service->category, ['class' => 'form-control']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('cost', 'Cost', ['class' => 'control-label']) !!}
            <div class="input-group">
              <span class="input-group-addon">$</span>
                {!! Form::text('cost', $service->cost, ['class' => 'form-control']) !!}
            </div>
          </div>

          <div class="form-group">
            {!! Form::label('sell_price', 'Selling Price', ['class' => 'control-label']) !!}
            <div class="input-group">
              <span class="input-group-addon">$</span>
                {!! Form::text('sell_price', $service->sell_price, ['class' => 'form-control']) !!}
            </div>
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
