<script>
    $(function()
    {
        $( "#due_date" ).datepicker({ dateFormat: 'yy-mm-dd' });
    });
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        Create New Task
    </div>
    @include('common.errors')
    {!! Form::open(array('class' => 'form-horizontal', 'route' => 'task.store')) !!}
    <div class="panel-body">
        <div class="form-group">
            {!! Form::label('name', 'Task Name', array('class' => 'col-sm-4 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::text('name', '', array('class' => 'form-control')) !!}
            </div>
        </div>

        <?php
        $new_due_date = strtotime("+14 day");
        $new_due_date = date("Y-m-d", $new_due_date);
        ?>
        <div class="form-group">
            {!! Form::label('due_date', 'Due Date', array('class' => 'col-sm-4 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::date('due_date', $new_due_date, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => 'col-sm-4 control-label')) !!}
            <div class="col-sm-8">
                {!! Form::select('assigned_to_user_id', $team_members, null, array('class' => 'form-control')) !!}
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
                {!! Form::label('priority', 'Priority', array('class' => 'col-sm-4 control-label')) !!}
                <div class="col-sm-8">
                    {!! Form::select('priority', $priority_options, 'Medium', array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-6">
                    {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
    
