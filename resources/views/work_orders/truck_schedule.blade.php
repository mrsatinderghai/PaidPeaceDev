@extends('layouts.app')

@section('content')

<style>
  ul {
    padding-left: 0;
  }
</style>


<div class="container">


  <div class="row">
    <div class="col-xs-12 col-sm-8">
      <h1>{{ $truck->name }}</h1>
      <h2>{{ $date }}</h2>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="p-3 mb-2 bg-info" style="padding:5px;">
        <b>Notes:</b><br>
        {{ $date_notes->notes or ''}}
      </div> 
    </div>
  </div>

  <hr />

  {!! Form::open(['route' => 'work_order.update_stop_orders']) !!}
  @if(Auth::user()->has_role('Admin'))
  {!! Form::submit('Update Stop Orders', ['class' => 'btn btn-primary']) !!}
  @endif
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      <h2>8am-1pm</h2>
          <ul class="list-group">
            @foreach($wo[$date]['9am-1pm'] as $y)
              <li class="list-group-item" @if($y->status == 'Complete') style="background-color:lightyellow;" @endif  @if($y->shop_work) style="background-color:lightblue;" @endif >
                @include('work_orders.elements.stop');
              </li>
            @endforeach
          </ul>     
    </div>
      <div class="col-xs-12 col-sm-4">
        <h2>12pm-6pm</h2>
        <ul class="list-group">
            @foreach($wo[$date]['12pm-5pm'] as $y)
            <li class="list-group-item" @if($y->status == 'Complete') style="background-color:lightyellow;" @endif  @if($y->shop_work) style="background-color:lightblue;" @endif>
                @include('work_orders.elements.stop');
              </li>
            @endforeach
          </ul>     
      </div>

      <div class="col-xs-12 col-sm-4">
        <h2>8pm-6pm</h2>
        <ul class="list-group">
            @foreach($wo[$date]['8am-6pm'] as $y)
            <li class="list-group-item" @if($y->status == 'Complete') style="background-color:lightyellow;" @endif  @if($y->shop_work) style="background-color:lightblue;" @endif>
                @include('work_orders.elements.stop');
            </li>
            @endforeach
          </ul>     
      </div>
  </div>
  {!! Form::close() !!}


</div>

@endsection
