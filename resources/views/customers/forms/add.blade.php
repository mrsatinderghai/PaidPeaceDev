<div class="form-group">
  {!! Form::label('first_name', 'First Name', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('first_name', $customer->first_name, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('last_name', 'Last Name', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('last_name', $customer->last_name, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('address1', 'Address', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('address1', $customer->address1, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('address2', 'Address 2', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('address2', $customer->address2, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('city', 'City', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-4">
    {!! Form::text('city', $customer->city, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('state', 'State', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-2">
    {!! Form::text('state', $customer->state, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('zip', 'Zip', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-3">
    {!! Form::text('zip', $customer->zip, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('phone', 'Primary Phone', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('phone', $customer->phone, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('email', 'Email', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('email', $customer->email, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('cell_phone', 'Secondary Phone', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('cell_phone', $customer->cell_phone, ['class' => 'form-control']) !!}
  </div>
      {!! Form::label('area_color_override', 'Area Override', ['class' => 'col-xs-12 col-sm-1']) !!}
      <div class="col-xs-12 col-sm-5">
        {!! Form::select('area_color_override', $customer->area_options(), $customer->area_color_override, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
  {!! Form::label('equipment_make', 'Make', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('equipment_make', $customer->equipment_make, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('equipment_model', 'Model', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::text('equipment_model', $customer->equipment_model, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('hoa', 'HOA', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    <?php
    $x = null;
    if ($customer->hoa == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('hoa', 1, $x) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('is_tax_exempt', 'Tax Exempt', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-1">
    <?php
    $x = null;
    if ($customer->tax_exempt == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('is_tax_exempt', 1, $x) !!}
  </div>

  <div class="col-xs-12 col-sm-4">
    {!! Form::text('tax_exempt_id', $customer->tax_exempt_id, ['class' => 'form-control', 'placeholder' => 'Tax Exempt ID']) !!}
  </div>
  
  {!! Form::label('preferred_contact_method', 'Preferred Contact Method', ['class' => 'col-xs-12 col-sm-6']) !!}
  <div class="col-xs-12 col-sm-offset-6 col-sm-6">
    {!! Form::select('preferred_contact_method',$customer->contact_methods, $customer->preferred_contact_method,  ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('wants_follow_up_calls', 'Promotions', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    <?php
    $x = null;
    if ($customer->wants_follow_up_calls == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('wants_follow_up_calls', 1, $x) !!}
  </div>
  {!! Form::label('do_not_contact', 'Do Not Contact', ['class' => 'col-xs-12 col-sm-2']) !!}
  <div class="col-xs-12 col-sm-1">
    <?php
    $x = null;
    if ($customer->do_not_contact == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('do_not_contact', 1, $x) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('referred_by', 'Referred By', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::select('referred_by', $customer->referred_by_options, $customer->referred_by, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('notes', 'Notes', ['class' => 'col-xs-12 col-sm-1']) !!}
  <div class="col-xs-12 col-sm-5">
    {!! Form::textarea('notes', $customer->notes, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-xs-12 col-sm-offset-1 col-sm-11">
    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
  </div>
</div>
{!! Form::close() !!}
