<style>
	.nav_link
	{
		font-size: 20px;
		font-weight: light;
	}
</style>

<i class="fa fa-building fa-3x"></i><br/>
<a href="{{ url('/company') }}" class="nav_link">Customers</a><br/>
<a href="{{ url('/contact') }}" class="nav_link">Contacts</a><br/>
<hr/>
<i class="fa fa-briefcase fa-3x"></i><br/>
<a href="{{ url('/sale/dashboard') }}" class="nav_link">Dashboard</a><br/>
<a href="{{ url('/sale/pipeline') }}" class="nav_link">Pipeline</a><br/>
<a href="{{ url('/sale') }}" class="nav_link">Sales</a><br/>
