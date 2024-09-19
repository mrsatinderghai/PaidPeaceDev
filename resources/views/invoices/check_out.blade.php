@extends('layouts.app')

@section('content')

<div class="container">
    @include('common.errors')
  <img style="float: left; position: relative; height:45px;" class="img-responsive" src="{{ url($team->logo) }}" />
  <h1 align="right">INVOICE</h1>
  <table align="right">
    <tr>
      <td>
        <b>Date:</b>
      </td>
      <td>
        {{ date('M d, Y', strtotime($invoice->created_at)) }}
      </td>
    </tr>
    <tr>
      <td>
        <b>Invoice Num:</b>
      </td>
      <td>
        {{ $invoice->id }}
      </td>
    </tr>
  </table>


  <b>{{ $team->name }}</b><br/>
  {{ $team->address1 }}<br/>
  @if ($team->address2 != null)
  {{ $team->address2 }}
  @endif
  {{ $team->city }}, {{ $team->state }}  {{ $team->zip }} <br/>
  {{ $team->phone }}<br/>
  <br/>
  <br/>
  <b><u>Bill To:</u></b><br/>
  {{ $customer->first_name . ' ' . $customer->last_name }}<br/>
  {{ $customer->address1 }}<br/>
  @if ($customer->address2 != null)
  {{ $customer->address2 }}
  @endif
  {{ $customer->city }}, {{ $customer->state}}  {{ $customer->zip }}<br/>
  {{ $customer->phone_number_formatter() }}<br/>
  <br/>
  <br/>

  <h4>Services</h4>
  <table class="table table-striped table-condensed" width="95%">
    <tr>
      <th><b>Description</b></th>
      <th><b>Price</b></th>
      <th></th>
    </tr>
    @foreach($work_order->services as $service)
    <tr>
      <td>
        <form action="{{ url('work_order/update_service/'.$service->pivot->id) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          {{ $service->description }}
        </td>
        <td>
          <input type="text" name="sale_price" value="{{ $service->pivot->sale_price }}" class="form-control"  />
          <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"  />
        </td>
        <td>
          <button class="btn btn-info">
            <i class="fa fa-check"></i>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
  <hr />
  <h4>Parts</h4>
  <table class="table table-striped tabled-condensed" width="95%">
    <tr>
      <th><b>Description</b></th>
      <th><b>Quantity</b></th>
      <th><b>Price</b></th>
      <th><b>Tax</b></th>
      <th></th>
    </tr>
    @foreach($work_order->products as $product)
    <tr>
      <td>
        <form action="{{ url('work_order/update_product/'.$product->id) }}" method="POST">
          {{ csrf_field() }}
          {{ method_field('PATCH') }}
          {{ $product->description }}
        </td>
        <td>
          <input type="text" name="product_quantity" value = "{{ $product->pivot->quantity }}" class="form-control"  />
        </td>
        <td>
          <input type="text" name="sale_price" value="{{ $product->pivot->sale_price }}" class="form-control"  />
          <input type="hidden" name="invoice_id" value="{{ $invoice->id }}"  />
        </td>
        <td>${{ round($product->pivot->tax, 2) }}</td>
        <td>
          <button class="btn btn-info">
            <i class="fa fa-check"></i>
          </button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
  <hr />
  <a href="{{ url('work_order/'.$work_order->id.'/edit') }}" class="btn btn-warning" style="float:left">Change Services/Parts</a><h3 align="right"><b>Total Due:  ${{ number_format((float)$total, 2, '.', ',') }}</b></h3>

  <hr />
  <form action="{{ url('invoice/process_payment/'. $invoice->id) }}" method="POST">
    {{ csrf_field() }}
  <div class="row">
    <div class="form-group">
      {!! Form::label('payment_method', 'Payment Method', ['class' => 'col-xs-12 col-sm-2']) !!}
      <div class="col-xs-2">
          {!! Form::radio('payment_method', 'cash') !!} Cash
      </div>
      <div class="col-xs-2">
          {!! Form::radio('payment_method', 'card') !!} Card
      </div>
      <div class="col-xs-2">
          {!! Form::radio('payment_method', 'check') !!} Check
      </div>
      <div class="col-xs-2">
          {!! Form::radio('payment_method', 'mail') !!} Mail In
      </div>
      <div class="col-xs-2">
          {!! Form::text('paid_with_detail', null, ['class' => 'form-control', 'placeholder' => 'Check no./last 4 of card']) !!}
      </div>
    </div>
  </div>

  <hr />
  <div class="row">
    <div class="form-group">
      {!! Form::label('send_via', 'Send Via', ['class' => 'col-xs-12 col-sm-2']) !!}
      <div class="col-xs-12 col-md-3">
          {!! Form::checkbox('send_via_email', 1) !!} Email <br />
          {!! Form::text('email', $customer->email, ['class' => 'form-control']) !!}
      </div>
      <div class="col-xs-12 col-md-3">
          <input type="checkbox" name="send_via_text" value="1" disabled /> Text <br />
          {!! Form::text('phone', $customer->cell_phone, ['class' => 'form-control', 'disabled']) !!}
      </div>
      <div class="col-xs-12 col-md-3">
          {!! Form::checkbox('send_via_mail', 1) !!} Mail
      </div>
    </div>
  </div>


<hr />

  <div class="form-group">
    <div class="col-xs-12">
      <button class="btn btn-success" style="float:right;">Process Payment</button>
    </div>
  </div>
</form>



</div>


@endsection
