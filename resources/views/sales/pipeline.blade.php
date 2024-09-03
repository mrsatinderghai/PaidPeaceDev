<div class="col-xs-12 col-md-10 sale_pipeline">
  <h1>Sales Pipeline</h1>
  <div class="row">
    <div class="col-xs-12 col-md-3">
      <h5>Pending</h5>
      @foreach ($pending_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h5>Waiting on Customer</h5>
      @foreach ($awaiting_customer_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h5>Proposal</h5>
      @foreach ($proposal_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
    <div class="col-xs-12 col-md-3">
      <h5>Accepted</h5>
      @foreach ($accepted_sales as $sale)
        <a href="{{ url('sale/'.$sale->id) }}" class="btn btn-default btn-lg" style="margin-bottom: 5px;">{{ $sale->name }}</a>
      @endforeach
    </div>
  </div>

</div>
