@php $x = 1; @endphp

<h2>Add New Zip Code</h2>
@include('zip_code_areas.add')
<hr>
<h2>Current Zip Codes</h2>
<div class="row">
    @foreach($areas as $area)

    <div class="col-xs-4 col-md-12 remove_space">
        <h5> {{$area}} </h5>
        <div style="background-color:lightgray; border:1px solid black; margin:3px; padding:6px 4px;">
            @foreach($zcas[$area] as $i)
            {{ $i->zip_code }},
            @endforeach
        </div>
    </div>
    @if($x % 3 == 0)
</div>
<div class="row">
    @endif
    @php $x++ @endphp
    @endforeach