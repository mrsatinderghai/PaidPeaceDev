<script>
    $(function() {
        $("#due_date").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });
</script>



<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div class="header-title">
            <h4 class="card-title">Create New Task</h4>
        </div>
    </div>
    @include('common.errors')

    <div class="card-body">
        {!! Form::open(array( 'route' => 'task.store')) !!}

        <div class="form-group">
            {!! Form::label('name', 'Task Name', array('class' => ' control-label')) !!}
            <div class="col-sm-12">
                {!! Form::text('name', '', array('class' => 'form-control')) !!}
            </div>
        </div>

        <?php
        $new_due_date = strtotime("+14 day");
        $new_due_date = date("Y-m-d", $new_due_date);
        ?>
        <div class="form-group">
            {!! Form::label('due_date', 'Due Date', array('class' => 'control-label')) !!}
            <div class="col-sm-12">
                {!! Form::date('due_date', $new_due_date, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => ' control-label')) !!}
            <div class="col-sm-12">
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
            {!! Form::label('priority', 'Priority', array('class' => ' control-label')) !!}
            <div class="col-sm-12">
                {!! Form::select('priority', $priority_options, 'Medium', array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12 d-flex justify-content-between">
                {!! Form::submit('Add', array('class' => 'btn btn-primary')) !!}
                <button type="button" class="btn btn-secondary hide-task-section-btn">
                    Close
                </button>
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>