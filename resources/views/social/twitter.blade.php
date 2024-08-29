@if (! Session::has('access_token'))
<a style="background-color:#43acff; border-color:#43acff" href="{{ url('/twitter/login') }}" class="btn btn-info">
	<i class="fa fa-twitter"></i> Connect Twitter Account
</a>
@else
	<div class="panel panel-default">
		<div class="panel-heading">
			Send a Tweet
		</div>
		<div class="panel-body">
			{!! Form::open(array('route' => 'home.tweet', 'class' => 'form-horizontal')) !!}
			<div class="form-group">
				{!! Form::label('tweet', 'Tweet', array('class' => 'col-sm-1 control-label')) !!}
				<div class="col-sm-11">
					{!! Form::textarea('tweet', '', array('class' => 'form-control')) !!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-1 col-sm-6">
					{!! Form::submit('Tweet', array('class' => 'btn btn-primary', 'style' => 'background-color:#43acff; border-color:#43acff')) !!}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
@endif