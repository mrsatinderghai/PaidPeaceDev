@extends('layouts.app')

@section('content')

@include('common.container')

<div class="jumbotron">
  <img style="float: right; position: relative; height:45px;" class="img-responsive" src="{{ URL::asset($team->logo) }}" /><br />
  <h1 style="position: relative; width: 75%">
    &nbsp&nbsp{{ $team->name}}
  </h1>
  {{ $team->address1 }} <br />
  @if ($team->address2 != null)
  {{ $team->address2 }}
  @endif
  {{ $team->city }}, {{ $team->state }}  {{ $team->zip }}<br />
  <a href="{{ url('team/'.$team->id.'/edit') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
</div>

<div class="row">
  <div class="col-xs-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        Team Members
      </div>

      <div class="panel-body">
        <table class="table table-striped task-table">
          <thead>
            <th>
              Name
            </th>
            <th>
              Email
            </th>
          </thead>

          <tbody>
            @foreach($team_members as $member)
              <tr>
                <td>
                  <a href="{{ url('user/'.$member->id) }}">{{ $member->name }}</a>
                </td>
                <td>
                  {{ $member->email }}
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  @include('common.end_container')

  @endsection
