<div class="col-xs-12 col-md-10">
  <h1>Sales Pipeline</h1>
  <div class="row">
    <div class="col-xs-12 col-md-3">
      <h3>Pending</h3>
      @foreach ($pending_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h3>Waiting on Customer</h3>
      @foreach ($awaiting_customer_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h3>Proposal</h3>
      @foreach ($proposal_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h3>Accepted</h3>
      @foreach ($accepted_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
  </div>

</div>
