@extends('layouts.master')
@section('content')
<div class="content-page">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <div class="header-title">
              <h4 class="card-title">Customers list</h4>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="datatable-1" class="table data-table table-striped table-bordered">
                <thead>
                  <th><a href="{{ url('/customer/index/last_name') }}">Last Name</a></th>
                  <th><a href="{{ url('/customer/index/first_name') }}">First Name</a></th>
                  <th>Address</th>
                  <th>Address 2</th>
                  <th><a href="{{ url('/customer/index/city') }}">City</a></th>
                  <th><a href="{{ url('/customer/index/state') }}">State</a></th>
                  <th>Zip</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th><a href="{{ url('/customer/index/equipment_make') }}">Make</a></th>
                  <th><a href="{{ url('/customer/index/equipment_model') }}">Model</a></th>
                  <th>Edit</th>
                  <th>Delete</th>
                </thead>
                <tbody>
                  @foreach($customers as $customer)
                  <tr class="clickable-row" data-href="{{ url('/customer/'.$customer->id.'/edit/') }}">
                    <td>{{ $customer->last_name }}</td>
                    <td>{{ $customer->first_name }}</td>
                    <td>{{ $customer->address1 }}</td>
                    <td>{{ $customer->address2 }}</td>
                    <td>{{ $customer->city }}</td>
                    <td>{{ $customer->state }}</td>
                    <td>{{ $customer->zip }}</td>
                    <td>{{ $customer->phone_number_formatter() }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->equipment_make }}</td>
                    <td>{{ $customer->equipment_model }}</td>
                    <td>
                      <a href="{{ url('/customer/'.$customer->id.'/edit/') }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    </td>
                    <td>
                      <form action="{{ url('customer/'.$customer->id) }}" method="POST" class="delete">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button class="btn btn-danger btn-xs">
                          <i class="fa fa-trash"></i>
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
                <tfoot>
                  <tr>
                    <th><a href="{{ url('/customer/index/last_name') }}">Last Name</a></th>
                    <th><a href="{{ url('/customer/index/first_name') }}">First Name</a></th>
                    <th>Address</th>
                    <th>Address 2</th>
                    <th><a href="{{ url('/customer/index/city') }}">City</a></th>
                    <th><a href="{{ url('/customer/index/state') }}">State</a></th>
                    <th>Zip</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th><a href="{{ url('/customer/index/equipment_make') }}">Make</a></th>
                    <th><a href="{{ url('/customer/index/equipment_model') }}">Model</a></th>
                    <th>Edit</th>
                  <th>Delete</th>
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



<script>
  $(function() {
    $(".delete").on("submit", function() {
      return confirm("Do you want to delete this item?");
    });

    $(".clickable-row").click(function() {
      window.location = $(this).data("href");
    });

  });
</script>