<h2>Activities</h2>
<div class="row">
  <div class="col-xs-4">
    <a href="{{ url('activity/log/Phone Call/'.$sale->id.'/sale') }}" class="btn btn-default btn-lg" role="button"><i class="fa fa-phone"></i> Phone Call</a>
  </div>
  <div class="col-xs-4">
    <a href="{{ url('activity/log/Email/'.$sale->id.'/sale') }}"  class="btn btn-default btn-lg" role="button"><i class="fa fa-envelope"></i> Email</a>
  </div>
  <div class="col-xs-4">
    <a href="{{ url('activity/log/Meeting/'.$sale->id.'/sale') }}" class="btn btn-default btn-lg" role="button"><i class="fa fa-users"></i> Meeting</a>
  </div>
</div>
