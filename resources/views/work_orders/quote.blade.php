<style type="text/css">
    .invoice-table {
        border-width: 1px;
        border-spacing: 2px;
        border-style: outset;
        border-color: gray;
        border-collapse: collapse;
        background-color: white;
    }
    .invoice-table th {
        border-width: 1px;
        padding: 1px;
        border-style: inset;
        border-color: black;
        background-color: white;
        -moz-border-radius: ;
    }
    .invoice-table td {
        border-width: 1px;
        padding: 1px;
        border-style: inset;
        border-color: black;
        background-color: white;
        -moz-border-radius: ;
    }
    </style>
    
    
    
    <img height="100px" src="http://sharpnready.jexly.net/img/sharpmower.jpg" />
    <h2>QUOTE</h2>
    <table align="right">
        <tr>
            <td>
                <b>Date:</b>
            </td>
            <td>
                {{ date('M d, Y') }}
            </td>
        </tr>
        <tr>
            <td>
                <b>Work Order:</b>
            </td>
            <td>
                {{ $work_order->id }}
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
    <b><u>Quote For:</u></b><br/>
    {{ $customer->first_name . ' ' . $customer->last_name }}<br/>
    {{ $customer->address1 }}<br/>
    @if ($customer->address2 != null)
    {{ $customer->address2 }}
    @endif
    {{ $customer->city }}, {{ $customer->state}}  {{ $customer->zip }}<br/>
    {{ $customer->phone_number_formatter() }}<br/>
    <br/>
    <br/>
    
    <hr/>
    
    <b>Comments</b><br>
    {{ $work_order->comments }}
    <br/>
    
    <h4>Services</h4>
    <table width="99%" class="invoice-table">
        <tr>
            <th align="left"><b>Description</b></th>
            <th align="left"><b>Price</b></th>
        </tr>
        @foreach($work_order->services as $service)
        <tr>
            <td>
                {{ $service->description }}
            </td>
            <td align="right">
                ${{ $service->pivot->sale_price }}
            </td>
        </tr>
        @endforeach
    </table>
    
    <hr />
    
    <h4>Parts</h4>
    <table width="99%" class="invoice-table">
        <tr>
            <th align="left">Description</th>
            <th align="left">Quantity</th>
            <th align="left">Price</th>
            <th align="left">Sales Tax</th>
            <th align="left">Line Total</th>
        </tr>
        @foreach($work_order->products as $product)
        <tr>
            <td>
                {{ $product->description }}
            </td>
            <td align="center">
                {{ $product->pivot->quantity }}
            </td>
            <td align="right">
                ${{ $product->pivot->sale_price }}
            </td>
            <td align="right">
                ${{ $product->pivot->tax }}
            </td>
            <td align="right">
                ${{ $product->pivot->line_cost }}
            </td>
        </tr>
        @endforeach
    </table>
    
    <hr />
    
    <h3 align="right">Total Due:  ${{ number_format($total_cost,2) }}</h3>

    
    <center><h5>Thank you for your business!</h5></center>
    