<!-- Headline Field -->
<div id="div-headline" class="mb-3">
    <label class="form-label" for="headline">Headline</label>
    <div class="col">
        {!! Form::text('headline', null, ['class' => 'form-control','minlength' => 0,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Type Field -->
<div id="div-type" class="mb-3">
    <label class="form-label" for="type">Type</label>
    <div class="col">
        {!! Form::text('type', null, ['class' => 'form-control','minlength' => 0,'maxlength' => 150]) !!}
    </div>
</div>

<!-- Content Field -->
<div id="div-content" class="mb-3">
    <label class="form-label" for="content">Content</label>
    <div class="col">
        {!! Form::text('content', null, ['class' => 'form-control','minlength' => 0,'maxlength' => 2000]) !!}
    </div>
</div>

<!-- Is Sticky Field -->
<div id="div-is_sticky" class="mb-3">
    <label class="form-label" for="is_sticky">Is Sticky</label>
    <div class="col">
        {!! Form::text('is_sticky', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is Flashing Field -->
<div id="div-is_flashing" class="mb-3">
    <label class="form-label" for="is_flashing">Is Flashing</label>
    <div class="col">
        {!! Form::text('is_flashing', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Is External Url Field -->
<div id="div-is_external_url" class="mb-3">
    <label class="form-label" for="is_external_url">Is External Url</label>
    <div class="col">
        {!! Form::text('is_external_url', null, ['class' => 'form-control']) !!}
    </div>
</div>

<!-- Display Start Date Field -->
<div id="div-display_start_date" class="mb-3">
    <label class="form-label" for="display_start_date">Display Start Date</label>
    <div class="col-sm-4">
        {!! Form::text('display_start_date', null, ['class' => 'form-control','id'=>'display_start_date']) !!}
    </div>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#display_start_date').datetimepicker({
            //format: 'YYYY-MM-DD HH:mm:ss',
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Display End Date Field -->
<div id="div-display_end_date" class="mb-3">
    <label class="form-label" for="display_end_date">Display End Date</label>
    <div class="col-sm-4">
        {!! Form::text('display_end_date', null, ['class' => 'form-control','id'=>'display_end_date']) !!}
    </div>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#display_end_date').datetimepicker({
            //format: 'YYYY-MM-DD HH:mm:ss',
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Specific Display Date Field -->
<div id="div-specific_display_date" class="mb-3">
    <label class="form-label" for="specific_display_date">Specific Display Date</label>
    <div class="col-sm-4">
        {!! Form::text('specific_display_date', null, ['class' => 'form-control','id'=>'specific_display_date']) !!}
    </div>
</div>


@push('page_scripts')
    <script type="text/javascript">
        $('#specific_display_date').datetimepicker({
            //format: 'YYYY-MM-DD HH:mm:ss',
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush