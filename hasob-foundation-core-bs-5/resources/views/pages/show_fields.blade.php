<!-- Page Name Field -->
<div id="div_page_page_name" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('page_name', 'Page Name:', ['class'=>'control-label']) !!} 
        <span id="spn_page_page_name">
        @if (isset($page->page_name) && empty($page->page_name)==false)
            {!! $page->page_name !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Page Path Field -->
<div id="div_page_page_path" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('page_path', 'Page Path:', ['class'=>'control-label']) !!} 
        <span id="spn_page_page_path">
        @if (isset($page->page_path) && empty($page->page_path)==false)
            {!! $page->page_path !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

<!-- Content Field -->
<div id="div_page_content" class="col-sm-12 mb-10">
    <p>
        {!! Form::label('content', 'Content:', ['class'=>'control-label']) !!} 
        <span id="spn_page_content">
        @if (isset($page->content) && empty($page->content)==false)
            {!! $page->content !!}
        @else
            N/A
        @endif
        </span>
    </p>
</div>

