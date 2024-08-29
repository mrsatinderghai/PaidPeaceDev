<b><a href="{{ route('work_order.edit', $y->id) }}">Work Order: {{ $y->id }}</a></b><br>
              <b>Stop No.:</b></B><input type="text" id="{{ $y->id }}" name="{{ $y->id }}" value="{{ $y->schedule_order }}" size="1" /><br>
                <a href="{{ route('customer.show', $y->customer->id) }}">{{ $y->customer->full_name() }} </a>  <br>
                {{ $y->customer->address() }} | {!! $y->customer->map_link() !!} <br />                         
                {{ $y->customer->city }},  {{ $y->customer->state }}  {{ $y->customer->zip }}<br />
                <a href="tel:{{ $y->customer->phone_number_formatter() }} ">{{ $y->customer->phone_number_formatter() }}</a><br />
                <a href="tel:{{ $y->customer->phone_number_formatter() }} ">{{ $y->customer->phone_number_formatter('cell') }}</a><br />
                <b>Reason: </b>{{ $y->reason }}<br/>
                <b>Code: </b>{{ $y->code }}<br /></p>
