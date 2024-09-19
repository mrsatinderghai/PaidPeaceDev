<div class="panel panel-default">
    <div class="panel-heading">
        New Sub Task
    </div>
    @include('common.errors')

    <?php

        $team_members = Auth::user()->team->members;
        $team_member_options = array();

        foreach($team_members as $member) {
            $team_member_options[$member->id] = $member->name;
        }
    ?>
    {!! Form::open(array('route' => 'task.store', 'class' => 'form-horizontal')) !!}
    {!! Form::hidden('parent_id', $parent->id) !!}
    {!! Form::hidden('parent_type', $parent_type) !!}
    <div class="panel-body pl-0">
        <div class="form-group">
            {!! Form::label('name', 'Task Name', array('class' => 'col-xs-12 col-sm-12 pl-0')) !!}
            <div class="col-xs-10">
                {!! Form::text('name', '', array('class' => 'form-control')) !!}
            </div>
        </div>

        <?php
        $new_due_date = strtotime("+14 day");
        $new_due_date = date("Y-m-d", $new_due_date);
        ?>
        <div class="form-group">
            {!! Form::label('due_date', 'Due Date', array('class' => 'col-xs-12 col-sm-12 pl-0')) !!}
            <div class="col-xs-10">
                {!! Form::date('due_date', $new_due_date, array('class' => 'form-control')) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('assigned_to_user_id', 'Assigned To', array('class' => 'col-xs-12 col-sm-12 pl-0')) !!}
            <div class="col-xs-10">
                {!! Form::select('assigned_to_user_id', $team_member_options, null, array('class' => 'form-control')) !!}
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
                {!! Form::label('priority', 'Priority', array('class' => 'col-xs-12 col-sm-12 pl-0')) !!}
                <div class="col-xs-10">
                    {!! Form::select('priority', $priority_options, 'Medium', array('class' => 'form-control')) !!}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    {!! Form::submit('Add Task', array('class' => 'btn btn-primary')) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>