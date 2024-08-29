@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Access Denied</div>

                <div class="panel-body">
                    <p class="text-danger">You must be an administrator to view this page.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
