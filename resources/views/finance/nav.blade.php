<style>
	.nav_link
	{
		font-size: 20px;
		font-weight: light;
	}
</style>

<h3>Invoices</h3>
<a href="{{ url('/invoice/all') }}" class="nav_link">All</a><br/>
<a href="{{ url('/invoice/unpaid') }}" class="nav_link">Unpaid</a><br/>
<a href="{{ url('/invoice') }}" class="nav_link">To Send</a><br/>
<a href="{{ url('/invoice/daily') }}" class="nav_link">Daily</a><br/>
<a href="{{ url('/invoice/timeframe') }}" class="nav_link">Timeframe</a><br/>
<hr/>
<h3>Reports</h3>
<a href="{{ route('reports.finance.daily') }}" class="nav_link">Daily</a><br/>
<a href="{{ route('reports.finance.payroll') }}" class="nav_link">Payroll</a><br/>
<a href="{{ route('reports.finance.timeframe') }}" class="nav_link">Timeframe</a><br/>
<a href="{{ url('/transaction') }}" class="nav_link">Ledger</a><br/>
<hr />
<h3>Products</h3>
<a href="{{ url('/product') }}" class="nav_link">Parts</a><br/>
<a href="{{ url('/service') }}" class="nav_link">Services</a><br/>
<!--<a href="{{ url('/Inventory') }}" class="nav_link">Inventory</a><br/>-->
