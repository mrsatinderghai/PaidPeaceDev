


<!-- Work Order Details Modal -->
<div class="section" id="newWOPanel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                New Work Order
            </div>
            <div class="modal-body">
                    <div action="form-group">
                        {!! Form::label('zip') !!}
                        {!! Form::text('zip', null, ['class' => 'form-control', 'id' => 'newWOZip']) !!}
                    </div>
                    @include('work_orders.forms.add')
            </div>
        </div>
    </div>
</div>


      
      <!-- Add customer modal -->
      <div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Add Customer</h4>
            </div>
            <div class="modal-body">
              {!! Form::model($customer, ['route' => 'customer.store', 'class' => 'form-horizontal']); !!}
              @include('customers.forms.add')
            </div>
            <div class="modal-footer">
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->
      <!-- end modal -->


      <script>
            $(function() {
                var customers = [<?php
                              foreach($customers_all as $customer_fl) {
                                  echo '{ value: ' . $customer_fl->id . ', label: "' . $customer_fl->first_name . ' ' . $customer_fl->last_name . ', ' . $customer_fl->address1 . ', ' . $customer_fl->zip . ', ' . $customer_fl->phone_number_formatter() .'"},';
                              }
                              ?>];
            
              $("#customer_search").autocomplete({
              source: customers,
              select: function (event, ui) {
                  event.preventDefault()
                  $("#customer_id").val(ui.item.value); // save selected id to hidden input
                  $("#customer_search").val(ui.item.label); // display the selected text
              }
              });
            });
            
            $("#newWOZip").change(function() {
                var zip = $("#newWOZip").val();
                $.post('{{ route('zip_code_area.color_by_zip') }}', {"zip" : zip}, function(data, status) {
                    $("#newWOZip").css({'background-color' : data});    
                });
            });
            </script>
