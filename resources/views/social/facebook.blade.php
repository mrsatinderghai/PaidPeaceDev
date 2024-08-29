@if (! Session::has('fb_user_access_token'))
<a style="background-color:#3a5795; border-color:#3a5795" href="{{ url('/facebook/login') }}" class="btn btn-info">
	<i class="fa fa-facebook"></i> Connect Facebook Account
</a>
@else
<div class="panel panel-default">
	<div class="panel-heading">
		Update Facebook Status
	</div>
	<div class="panel-body">
		{!! Form::open(array('route' => 'home.fbstatus', 'class' => 'form-horizontal')) !!}
		<div class="form-group">
			{!! Form::label('fbstatus', 'Status', array('class' => 'col-sm-1 control-label')) !!}
			<div class="col-sm-11">
				{!! Form::textarea('fbstatus', '', array('class' => 'form-control')) !!}
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-1 col-sm-6">
				{!! Form::submit('Post to Facebook', array('class' => 'btn btn-primary', 'style' => 'background-color:#3a5795; border-color:#3a5795')) !!}
				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>
@endif
