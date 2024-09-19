@extends('layouts.master')
@section('content')
<!-- 
@include('common.container') -->

<script>
  $(function() {
    $("#due_date").datepicker({
      dateFormat: 'yy-mm-dd'
    });

    $('.section').hide();

    $('h2').click(function(event) {
      var sender = event.target.id;
      var section = event.target.id + '_section';
      $('#' + section).slideToggle();
    });
  });
</script>

<div class="content-page">
  <div class="container-fluid team_sec">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="col-xs-12 col-md-12 d-flex px-4 py-3 justify-content-between">
            @include('tasks.nav')
          </div>

          <div>
            <div class="panel panel-default">
              <div class="panel-heading">
                <h3 class="text-capitalize">{{ $task->name }}</h3>
              </div>
              @include('common.errors')
              {!! Form::model($task, array('route' => array('task.update', $task->id), 'method' => 'PATCH', 'class' => 'form-horizontal')) !!}
              <div class="panel-body">
                <div class="form-group">
                  {!! Form::label('name', 'Task Name', array('class' => 'col-xs-12 col-sm-2 pl-0')) !!}
                  <div class="col-xs-10">
                    {!! Form::text('name', $task->name, array('class' => 'form-control')) !!}
                  </div>
                </div>

                <?php
                $new_due_date = strtotime("+14 day");
                $new_due_date = date("Y-m-d", $new_due_date);
                ?>
                <div class="form-group">
                  {!! Form::label('due_date', 'Due Date', array('class' => 'col-xs-12 col-sm-2 pl-0')) !!}
                  <div class="col-xs-10">
                    {!! Form::date('due_date', $task->due_date, array('class' => 'form-control')) !!}
                  </div>
                </div>

                <div class="form-group">
                  {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => 'col-xs-12 col-sm-2 pl-0')) !!}
                  <div class="col-xs-10">
                    {!! Form::select('assigned_to_user_id', $team_members, $task->assigned_to_user_id, array('class' => 'form-control')) !!}
                  </div>
                </div>

                <?php
                $priority_options = array(
                  'Emergency' => 'Emergency',
                  'Urgent' => 'Urgent',
                  'High' => 'High',
                  'Medium' => 'Medium',
                  'Low' => 'Low',
                );
                ?>
                <div class="form-group">
                  {!! Form::label('priority', 'Priority', array('class' => 'col-xs-12 col-sm-2 pl-0')) !!}
                  <div class="col-xs-10">
                    {!! Form::select('priority', $priority_options, $task->priority, array('class' => 'form-control')) !!}
                  </div>
                </div>

                <?php
                $status_options = array(
                  'Pending' => 'Pending',
                  'In Progress' => 'In Progress',
                  'On Hold' => 'On Hold',
                  'Completed' => 'Completed',
                );
                ?>

                <div class="form-group">
                  {!! Form::label('status', 'Status', array('class' => 'col-xs-12 col-sm-2 pl-0')) !!}
                  <div class="col-xs-10">
                    {!! Form::select('status', $status_options, $task->status, array('class' => 'form-control')) !!}
                  </div>
                </div>
                <div class="form-group row p-0">
                  <div class="col-md-6">

                    <div class="col-sm-offset-3 col-sm-6 d-flex">
                      {!! Form::checkbox('completed', 'true') !!}
                      {!! Form::label('completed', 'Completed', array('class' => 'col-xs-12 col-sm-12 pl-1 mb-0')) !!}
                    </div>
                  </div>
                  <div class="col-md-6">

                    <div class="col-sm-offset-3 col-sm-6 d-flex">
                      {!! Form::checkbox('send_update', 'true', true) !!}
                      {!! Form::label('send_update', 'Send Email Update', array('class' => 'col-xs-12 col-sm-12 pl-1 mb-0')) !!}
                    </div>
                  </div>
                </div>

                <div class="form-group mt-3">
                  <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
                  </div>
                </div>
                {!! Form::close() !!}
              </div>
            </div>

            <h2 id="notes" class="p-3">Notes</h2>
            <div class="section" id="notes_section">
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  @include('notes.add')
                </div>
                <div class="col-xs-12 col-md-8">
                  @include('notes.list')
                </div>
              </div>
            </div>
            <hr />

            <h2 id="tasks" class="p-3">Tasks</h2>
            <div class="section" id="tasks_section">
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  @include('subtasks.add')
                </div>
                <div class="col-xs-12 col-md-8">
                  @include('subtasks.list')
                </div>
              </div>
            </div>

            <hr />

            <h2 id="workflows" class="p-3">Workflows</h2>
            <div class="section" id="workflows_section">
              <div class="row">
                <div class="col-xs-12 col-md-12">
                  @include('workflows.add')
                </div>
                <div class="col-xs-12 col-md-7">
                  @include('workflows.list')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@include('common.end_container')