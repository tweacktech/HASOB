<!-- Label Field -->
<div id="div_address_label" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('label', 'Label:', ['class'=>'control-label']) !!} 
        <span id="spn_address_label">
        @if (isset($address->label) && empty($address->label)==false)
            {!! $address->label !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Contact Person Field -->
<div id="div_address_contact_person" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('contact_person', 'Contact Person:', ['class'=>'control-label']) !!} 
        <span id="spn_address_contact_person">
        @if (isset($address->contact_person) && empty($address->contact_person)==false)
            {!! $address->contact_person !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Street Field -->
<div id="div_address_street" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('street', 'Street:', ['class'=>'control-label']) !!} 
        <span id="spn_address_street">
        @if (isset($address->street) && empty($address->street)==false)
            {!! $address->street !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Town Field -->
<div id="div_address_town" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('town', 'Town:', ['class'=>'control-label']) !!} 
        <span id="spn_address_town">
        @if (isset($address->town) && empty($address->town)==false)
            {!! $address->town !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- State Field -->
<div id="div_address_state" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('state', 'State:', ['class'=>'control-label']) !!} 
        <span id="spn_address_state">
        @if (isset($address->state) && empty($address->state)==false)
            {!! $address->state !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Country Field -->
<div id="div_address_country" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('country', 'Country:', ['class'=>'control-label']) !!} 
        <span id="spn_address_country">
        @if (isset($address->country) && empty($address->country)==false)
            {!! $address->country !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Telephone Field -->
<div id="div_address_telephone" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('telephone', 'Telephone:', ['class'=>'control-label']) !!} 
        <span id="spn_address_telephone">
        @if (isset($address->telephone) && empty($address->telephone)==false)
            {!! $address->telephone !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

