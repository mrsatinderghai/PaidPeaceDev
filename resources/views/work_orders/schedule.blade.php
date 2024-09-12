@extends('layouts.master')
@section('content')


<style>
  .affix {
    top: 0px;
    z-index: 1051;
  }

  ul {
    padding: 0;
    list-style-type: none !important;
    list-style: none;
    margin: 0;
  }

  .scheduleBox {
    min-height: 350px;
    margin: 0px;
  }

  .scheduleHeader {
    margin: 0px;
    padding: 15px 0;
    border-bottom: 1px dashed gainsboro;
  }

  .leftBar {
    display: flex;
  }

  .workorder-installation {
    background-image: radial-gradient(#9e9e9e 40%, transparent);
    background-size: 10px 10px;
  }
</style>

<script>
  $(function() {
    $(".appointment_date").datepicker({
      dateFormat: 'yy-mm-dd'
    });
    $(".delivery_date").datepicker({
      dateFormat: 'yy-mm-dd'
    });

    $(".cancel").on("click", function() {
      return confirm("Are you sure you want to cancel?");
    });

    $('.section').hide();

    $("#newWObtn").click(function() {
      $("#newWOPanel").slideToggle();
    });

  });


  function allowDrop(ev) {
    ev.preventDefault();
  }

  function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
  }

  function drop(ev, date, time, truck) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    $.get('{{ url("work_order/update_schedule") }}' + '/' + data + '/' + date + '/' + time + '/' + truck,
      function(data, status) {
        console.log(data);
        location.reload(true);
        if (data == "Can't schedule on blocked date.") {
          alert(data);
        }
      });
  }
</script>


<div class="content-page">
  <div class="container-fluid Work_order">

    <div class="row">


      <div class="col-sm-12">
        <div class="card">
          <div data-spy="affix" data-offset-top="150" ondrop="drop(event, '0000-00-00', null, null)" ondragover="allowDrop(event)">
            <!-- <h3>Work Orders  <a href="#" class="btn btn-info btn-xs" id="newWObtn"><i class="fa fa-plus"></i></a></h3> -->
            @include('common.errors')
            <div class="leftBar">
              

              <table cellpadding=3 cellspacing=3 border=1px solid black; style="height: 150px;">
                <tr height="30px">
                  <td bgcolor="yellow" width="30">
                    <center><b>NW</b></center>
                  </td>
                  <td bgcolor="deepskyblue" width="30">
                    <center><b>N</b></center>
                  </td>
                  <td bgcolor="red" width="30">
                    <center><b>NE</b></center>
                  </td>
                </tr>
                <tr height="30px">
                  <td bgcolor="hotpink" width="30">
                    <center><b>W</b></center>
                  </td>
                  <td bgcolor="lightsteelblue" width="30">
                    <center><b>C</b></center>
                  </td>
                  <td bgcolor="green" width="30">
                    <center><b>E</b></center>
                  </td>
                </tr>
                <tr height="30px">
                  <td bgcolor="orange" width="30">
                    <center><b>SW</b></center>
                  </td>
                  <td bgcolor="purple" width="30">
                    <center><b>S</b></center>
                  </td>
                  <td bgcolor="tan" width="30">
                    <center><b>SE</b></center>
                  </td>
                </tr>
              </table>
            </div>
            <div class="leftbar_plaque">
            <ul>
                @foreach($work_orders_left as $y)
                <li>
                  {!! $y->plaque() !!}
                </li>
                @include('work_orders.modal')
                @endforeach
              </ul>
            </div>
          </div>
        </div>
      </div>

      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Work Order</h4>
            </div>
          </div>


          <div class="tab-content" id="myTabContent-2">

            <div class="row">
              <div class="col-xs-12 col-md-12 calender">
                <a class="btn btn-sm btn-default" href="{{ url('work_order/schedule/' . $last_week) }}"><i class="fa fa-backward"></i></a>
                <i class="fa fa-calendar"></i>
                <a class="btn btn-sm btn-default" href="{{ url('work_order/schedule/' . $next_week) }}"><i class="fa fa-forward"></i></a>
              </div>
            </div>



            <div class="card-body">

              <div class='row'>
                @foreach($trucks as $keyTruck => $truck)

                @if($keyTruck==0)
                @elseif(($keyTruck+1)%3==0)
                @endif
                <div class="col-xs-12 col-md-4 truck-row">

                  <div class="jumbotron">
                    <h2>{{ $truck->name }}</h2>
                  </div>
                  <?php $count = 0; ?>
                  @foreach($dates as $date)
                  <div class="row scheduleHeader" @if (($count + 1) % 2 !=0) {{ 'style=background-color:aliceblue' }} @endif>
                    <div class="col-xs-12 col-md-12">
                      <form action="{{ url('date_note/save') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $truck->id }}" name="truck_id">
                        <button class="btn btn-info btn-xs bs" style="float:right">
                          <i class="fa fa-check"></i>
                        </button>
                        <input type="hidden" value="{{$date}}" name="date">
                        <textarea rows="3" cols="20" name="notes" style="float:right;" placeholder="Notes...">{{ $date_notes[$date][$truck->id][0]->notes or '' }}</textarea>

                      </form>
                      <a href="{{ route('work_order.truck_schedule', [$truck->id, $date]) }}">
                        <h3>{{ $days_of_week[$count] }}, {{ $date }}</h3>
                      </a>
                      <form action="{{ url('truck/assign_user_to_day') }}" method="POST" class="unassign_box">
                        {{ csrf_field() }}
                        {!! Form::select('user_id', $assigned_to_select, $truck->user_by_date($date)) !!}
                        {!! Form::hidden('date', $date) !!}
                        {!! Form::hidden('truck_id', $truck->id) !!}
                        <button class="btn btn-info btn-xs">
                          <i class="fa fa-check"></i>
                        </button>
                      </form>
                    </div>
                  </div>
                  <div class="row scheduleBox" @if (($count + 1) % 2 !=0) {{ 'style=background-color:aliceblue' }} @endif>
                    <?php
                    $count++;
                    $odo = "allowDrop(event)";
                    $class = "";
                    $icon = "fa fa-lock";
                    $action = "lock";
                    if (isset($time_slot_locks[$date][$truck->id])) {
                      if (isset($time_slot_locks[$date][$truck->id][1])) {
                        if ($time_slot_locks[$date][$truck->id][1]) {
                          $odo = "";
                          $class = "text-danger";
                          $icon = "fa fa-unlock";
                          $action = "unlock";
                        }
                      }
                    }
                    ?>

                    <div class="col-md-4" class="wo_plaque_holder" ondrop="drop(event, '{{ $date }}', '9am-1pm', '{{ $truck->id }}')" ondragover="{{$odo}}">
                      <h4 class="{{ $class }}"><b>8am-1pm</b><a href="{{ route('time_slot_locks.lock', [$date, $truck->id, 1, $action]) }}" class="btn btn-xs btn-warning"><i class="{{ $icon }}"></i></a></h4>
                      @foreach($wo[$date]['9am-1pm'] as $y)
                      @if($y->truck_id == $truck->id)
                      {!! $y->plaque() !!}
                      @include('work_orders.modal')
                      @endif
                      @endforeach
                    </div>

                    <?php
                    $odo = "allowDrop(event)";
                    $class = "";
                    $icon = "fa fa-lock";
                    $action = "lock";
                    if (isset($time_slot_locks[$date][$truck->id])) {
                      if (isset($time_slot_locks[$date][$truck->id][2])) {
                        if ($time_slot_locks[$date][$truck->id][2]) {
                          $odo = "";
                          $class = "text-danger";
                          $icon = "fa fa-unlock";
                          $action = "unlock";
                        }
                      }
                    }
                    ?>

                    <div class="col-md-4" class="wo_plaque_holder" ondrop="drop(event, '{{ $date }}', '12pm-5pm', '{{ $truck->id }}')" ondragover="{{$odo}}">
                      <h4 class="{{ $class }}"><b>12pm-6pm</b><a href="{{ route('time_slot_locks.lock', [$date, $truck->id, 2, $action]) }}" class="btn btn-xs btn-warning"><i class="{{ $icon }}"></i></a></h4>
                      @foreach($wo[$date]['12pm-5pm'] as $y)
                      @if($y->truck_id == $truck->id)
                      {!! $y->plaque() !!}
                      @include('work_orders.modal')
                      @endif
                      @endforeach
                    </div>

                    <?php
                    $odo = "allowDrop(event)";
                    $class = "";
                    $icon = "fa fa-lock";
                    $action = "lock";
                    if (isset($time_slot_locks[$date][$truck->id])) {
                      if (isset($time_slot_locks[$date][$truck->id][3])) {
                        if ($time_slot_locks[$date][$truck->id][3]) {
                          $odo = "";
                          $class = "text-danger";
                          $icon = "fa fa-unlock";
                          $action = "unlock";
                        }
                      }
                    }
                    ?>

                    <div class="col-md-4" class="wo_plaque_holder" ondrop="drop(event, '{{ $date }}', '8am-6pm', '{{ $truck->id }}')" ondragover="{{ $odo }}">
                      <h4 class="{{$class}}"><b>8am-6pm</b><a href="{{ route('time_slot_locks.lock', [$date, $truck->id, 3, $action]) }}" class="btn btn-xs btn-warning"><i class="{{ $icon }}"></i></a></h4>
                      @foreach($wo[$date]['8am-6pm'] as $y)
                      @if($y->truck_id == $truck->id)
                      {!! $y->plaque() !!}
                      @include('work_orders.modal')
                      @endif
                      @endforeach
                    </div>

                  </div>
                  @endforeach
                  <hr>
                </div>

                @if($keyTruck==(count($trucks)-1))

                @elseif(($keyTruck+1) %3 ==0)

                @endif

                @endforeach
              </div>







            </div>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection