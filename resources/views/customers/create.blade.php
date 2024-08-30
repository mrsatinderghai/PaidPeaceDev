@extends('layouts.master')
@section('content')
<div class="content-page">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Add Customers</h4>
                        </div>
                    </div>
                    <div class="section" id="add_customer_section">
                        <hr />
                        {!! Form::model($customer, ['route' => 'customer.store', 'class' => 'form-horizontal']); !!}
                        @include('customers.forms.add')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection