<!-- Headline Field -->
<div id="div_siteArtifact_headline" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('headline', 'Headline:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_headline">
        @if (isset($siteArtifact->headline) && empty($siteArtifact->headline)==false)
            {!! $siteArtifact->headline !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Type Field -->
<div id="div_siteArtifact_type" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('type', 'Type:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_type">
        @if (isset($siteArtifact->type) && empty($siteArtifact->type)==false)
            {!! $siteArtifact->type !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Content Field -->
<div id="div_siteArtifact_content" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('content', 'Content:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_content">
        @if (isset($siteArtifact->content) && empty($siteArtifact->content)==false)
            {!! $siteArtifact->content !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Display Start Date Field -->
<div id="div_siteArtifact_display_start_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('display_start_date', 'Display Start Date:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_display_start_date">
        @if (isset($siteArtifact->display_start_date) && empty($siteArtifact->display_start_date)==false)
            {!! $siteArtifact->display_start_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Display End Date Field -->
<div id="div_siteArtifact_display_end_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('display_end_date', 'Display End Date:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_display_end_date">
        @if (isset($siteArtifact->display_end_date) && empty($siteArtifact->display_end_date)==false)
            {!! $siteArtifact->display_end_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Specific Display Date Field -->
<div id="div_siteArtifact_specific_display_date" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('specific_display_date', 'Specific Display Date:', ['class'=>'control-label']) !!} 
        <span id="spn_siteArtifact_specific_display_date">
        @if (isset($siteArtifact->specific_display_date) && empty($siteArtifact->specific_display_date)==false)
            {!! $siteArtifact->specific_display_date !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

