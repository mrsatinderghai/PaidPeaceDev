<!-- Nav tabs -->


<ul class="nav nav-tabs" id="myTab-1" role="tablist">
	<li role="presentation" class="active">
		<a class="nav-link active" id="all-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">All</a>
	</li>
	<li class="presentation">
		<a class="nav-link" id="receivable-tab" data-toggle="tab" href="#receivables" role="tab" aria-controls="receivables" aria-selected="false">Receivable</a>
	</li>
	<li class="presentation">
		<a class="nav-link" id="payable-tab" data-toggle="tab" href="#payables" role="tab" aria-controls="payables" aria-selected="false">Payable</a>
	</li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div role="tabpanel" class="tab-pane show active" id="all" aria-labelledby="all-tab">
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

	<div role="tabpanel" class="tab-pane fade" id="receivables" aria-labelledby="receivable-tab">
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

	<div role="tabpanel" class="tab-pane fade" id="payables" aria-labelledby="payable-tab">
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