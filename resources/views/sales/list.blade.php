
<div class="row">
  <div>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="#leads" aria-controls="home" role="tab" data-toggle="tab">Leads</a></li>
      <li role="presentation"><a href="#won" aria-controls="profile" role="tab" data-toggle="tab">Won</a></li>
      <li role="presentation"><a href="#lost" aria-controls="messages" role="tab" data-toggle="tab">Lost</a></li>
      <li role="presentation"><a href="#all" aria-controls="settings" role="tab" data-toggle="tab">All</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="leads">
        <table class="table table-striped table-condensed">
          <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach($leads as $sale)
            <tr>
              <td><a href="{{ url('/sale/'.$sale->id) }}">{{ $sale->name }}</a></td>
              <td>{{ $sale->status }}</td>
              <td>@if ($sale->assigned_to) {{ $sale->assigned_to->name }} @endif</td>
              <td>${{ $sale->amount }}</td>
              <td>
                <form action="{{ url('sale/'.$sale->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      
      <div role="tabpanel" class="tab-pane" id="won">
        <table class="table table-striped table-condensed">
          <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach($accepted as $sale)
            <tr>
              <td><a href="{{ url('/sale/'.$sale->id) }}">{{ $sale->name }}</a></td>
              <td>{{ $sale->status }}</td>
              <td>@if ($sale->assigned_to) {{ $sale->assigned_to->name }} @endif</td>
              <td>${{ $sale->amount }}</td>
              <td>
                <form action="{{ url('sale/'.$sale->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div role="tabpanel" class="tab-pane" id="lost">
        <table class="table table-striped table-condensed">
          <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach($rejected as $sale)
            <tr>
              <td><a href="{{ url('/sale/'.$sale->id) }}">{{ $sale->name }}</a></td>
              <td>{{ $sale->status }}</td>
              <td>@if ($sale->assigned_to) {{ $sale->assigned_to->name }} @endif</td>
              <td>${{ $sale->amount }}</td>
              <td>
                <form action="{{ url('sale/'.$sale->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>

      <div role="tabpanel" class="tab-pane" id="all">
        <table class="table table-striped table-condensed">
          <thead>
            <th>Name</th>
            <th>Status</th>
            <th>Assigned To</th>
            <th>Amount</th>
          </thead>
          <tbody>
            @foreach($sales as $sale)
            <tr>
              <td><a href="{{ url('/sale/'.$sale->id) }}">{{ $sale->name }}</a></td>
              <td>{{ $sale->status }}</td>
              <td>@if ($sale->assigned_to) {{ $sale->assigned_to->name }} @endif</td>
              <td>${{ $sale->amount }}</td>
              <td>
                <form action="{{ url('sale/'.$sale->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button class="btn btn-danger">
                    <i class="fa fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
