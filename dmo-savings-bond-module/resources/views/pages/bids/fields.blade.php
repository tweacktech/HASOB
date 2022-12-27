<!-- Status Field -->
<div id="div-status" class="form-group">
    <label for="status" class="col-lg-3 col-form-label">Status</label>
    <div class="col-lg-9">
        {!! Form::text('status', null, ['id'=>'status', 'class' => 'form-control']) !!}
    </div>
</div>

<!-- Start Price Per Unit Field -->
<div id="div-price_per_unit" class="row mb-3">
    <label for="price_per_unit" class="col-lg-3 col-form-label">Price Per Unit</label>
    <div class="col-sm-9">
        {!! Form::number('price_per_unit', null, ['id'=>'price_per_unit', 'class' => 'form-control','min' => 0,'max' => 100000000]) !!}
    </div>
</div>
<!-- End Price Per Unit Field -->

<!-- Start Total Price Field -->
<div id="div-total_price" class="row mb-3">
    <label for="total_price" class="col-lg-3 col-form-label">Total Price</label>
    <div class="col-sm-9">
        {!! Form::number('total_price', null, ['id'=>'total_price', 'class' => 'form-control','min' => 0,'max' => 100000000]) !!}
    </div>
</div>
<!-- End Total Price Field -->