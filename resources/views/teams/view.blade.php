@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid Sharp_Mower">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="jumbotron">
            <div class="img-flex">
            <h1 style="position: relative; width: 100%">
            {{ $team->name}}
            </h1>
            <img style="float: right; position: relative; height:45px;" class="img-responsive" src="{{ url($team->logo) }}" /><br />
            </div>           
            {{ $team->address1 }} <br />
            @if ($team->address2 != null)
            {{ $team->address2 }}
            @endif
            {{ $team->city }}, {{ $team->state }} {{ $team->zip }}<br />
            <a href="{{ url('team/'.$team->id.'/edit') }}" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a>
          </>
        </div>
        <div class="card">


          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable-1" class="table data-table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                  </tr>
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
                <tfoot>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection