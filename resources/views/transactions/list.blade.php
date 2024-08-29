<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
	<li role="presentation" class="active"><a href="#all" aria-controls="home" role="tab" data-toggle="tab">All</a></li>
	<li role="presentation"><a href="#receivables" aria-controls="profile" role="tab" data-toggle="tab">Receivable</a></li>
	<li role="presentation"><a href="#payables" aria-controls="messages" role="tab" data-toggle="tab">Payable</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="all">
		<table class="table table-condensed table-striped">
			<thead>
			  <th>Date</th>
				<th>Other Party</th>
				<th>Type</th>
				<th>Amount</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($transactions as $transaction)
					<tr>
					    <td>{{ $transaction->date }}</td>
						<td>{{ $transaction->other_party }}</td>
						<td>{{ $transaction->type }}</td>
						<td>
							@if ($transaction->type == 'Payable') - @endif
							${{ $transaction->amount }}
						</td>
						<td>
		                    <form action="{{ url('transaction/'.$transaction->id) }}" method="POST">
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

	<div role="tabpanel" class="tab-pane" id="receivables">
		<table class="table table-condensed table-striped">
			<thead>
			    <th>Date</th>
				<th>Other Party</th>
				<th>Type</th>
				<th>Amount</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($receivables as $transaction)
					<tr>
					    <td>{{ $transaction->date }}</td>
						<td>{{ $transaction->other_party }}</td>
						<td>{{ $transaction->type }}</td>
						<td>
							@if ($transaction->type == 'Payable') - @endif
							${{ $transaction->amount }}
						</td>
						<td>
		                    <form action="{{ url('transaction/'.$transaction->id) }}" method="POST">
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

	<div role="tabpanel" class="tab-pane" id="payables">
		<table class="table table-condensed table-striped">
			<thead>
			    <th>Date</th>
				<th>Other Party</th>
				<th>Type</th>
				<th>Amount</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($payables as $transaction)
					<tr>
					    <td>{{ $transaction->date }}</td>
						<td>{{ $transaction->other_party }}</td>
						<td>{{ $transaction->type }}</td>
						<td>
							@if ($transaction->type == 'Payable') - @endif
							${{ $transaction->amount }}
						</td>
						<td>
		                    <form action="{{ url('transaction/'.$transaction->id) }}" method="POST">
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
