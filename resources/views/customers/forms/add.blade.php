<div class="">

<div class="form-group">
  <div class="col-md-12">
  {!! Form::label('first_name', 'First Name', ['class' => '']) !!}
    </div>
  <div class="col-md-12">
    {!! Form::text('first_name', $customer->first_name, ['class' => 'form-control']) !!}
  </div>

    <div class="col-md-12">
  {!! Form::label('last_name', 'Last Name', ['class' => '']) !!}
  </div>
  <div class="col-md-12">
    {!! Form::text('last_name', $customer->last_name, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('address1', 'Address', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('address1', $customer->address1, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('address2', 'Address 2', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('address2', $customer->address2, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('city', 'City', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('city', $customer->city, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('state', 'State', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('state', $customer->state, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('zip', 'Zip', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('zip', $customer->zip, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('phone', 'Primary Phone', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('phone', $customer->phone, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('email', 'Email', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('email', $customer->email, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('cell_phone', 'Secondary Phone', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('cell_phone', $customer->cell_phone, ['class' => 'form-control']) !!}
  </div>
      {!! Form::label('area_color_override', 'Area Override', ['class' => 'col-md-12']) !!}
      <div class="col-md-12">
        {!! Form::select('area_color_override', $customer->area_options(), $customer->area_color_override, ['class' => 'form-control']) !!}
      </div>
</div>

<div class="form-group">
  {!! Form::label('equipment_make', 'Make', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('equipment_make', $customer->equipment_make, ['class' => 'form-control']) !!}
  </div>
  {!! Form::label('equipment_model', 'Model', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::text('equipment_model', $customer->equipment_model, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group check_boxx">
  {!! Form::label('hoa', 'HOA', ['class' => 'check_label']) !!}
  <div class="check_tick">
    <?php
    $x = null;
    if ($customer->hoa == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('hoa', 1, $x) !!}
  </div>
</div>

<div class="form-group check_boxx">
  {!! Form::label('is_tax_exempt', 'Tax Exempt', ['class' => 'check_label']) !!}
  <div class="check_tick">
    <?php
    $x = null;
    if ($customer->tax_exempt == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('is_tax_exempt', 1, $x) !!}
  </div>

  <div class="col-md-4">
    {!! Form::text('tax_exempt_id', $customer->tax_exempt_id, ['class' => 'form-control', 'placeholder' => 'Tax Exempt ID']) !!}
  </div>
  
  {!! Form::label('preferred_contact_method', 'Preferred Contact Method', ['class' => 'check_label']) !!}
  <div class="col-md-5">
    {!! Form::select('preferred_contact_method',$customer->contact_methods, $customer->preferred_contact_method,  ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group check_boxx">
  {!! Form::label('wants_follow_up_calls', 'Promotions', ['class' => 'check_label']) !!}
  <div class="col-md-12 check_tick">
    <?php
    $x = null;
    if ($customer->wants_follow_up_calls == 1) {
      $x = 'true';
    }
    ?>
    {!! Form::checkbox('wants_follow_up_calls', 1, $x) !!}
  </div>
  {!! Form::label('do_not_contact', 'Do Not Contact', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
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
  {!! Form::label('referred_by', 'Referred By', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::select('referred_by', $customer->referred_by_options, $customer->referred_by, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  {!! Form::label('notes', 'Notes', ['class' => 'col-md-12']) !!}
  <div class="col-md-12">
    {!! Form::textarea('notes', $customer->notes, ['class' => 'form-control']) !!}
  </div>
</div>

<div class="form-group">
  <div class="col-xs-12 col-sm-offset-1 col-sm-11">
    {!! Form::submit('Save', array('class' => 'btn btn-primary')) !!}
  </div>
</div>
{!! Form::close() !!}
</div>
