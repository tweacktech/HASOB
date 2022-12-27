@extends('layouts.app')

@section('title_postfix')
{{ $site->site_name }}
@stop

@section('page_title')
{{ $site->site_name }}
@stop

@section('page_title_subtext')
    <a class="ml-10 mb-10" href="{{ route('fc.sites.index') }}" style="font-size:11px;color:blue;">
        <i class="fa fa-angle-double-left"></i> Back to Site List
    </a>
@stop

@section('page_title_buttons')
    <span class="float-end">
        <div class="float-end inline-block dropdown mb-15">
            <a href="#" data-val='{{$site->id}}' class='btn btn-xs btn-primary btn-edit-mdl-site-modal'>
                <i class="icon wb-reply" aria-hidden="true"></i>Edit Site
            </a>
        </div>
    </span>
@stop

@section('content')

    @php
        $pages = $site->pages;
        $artifacts = $site->site_artifacts;

        $components = $artifacts->filter(function ($value, $key) {
            return (strtolower($value->type) == "component");
        });

        $graphics = $artifacts->filter(function ($value, $key) {
            return (strtolower($value->type) == "image" || $value->type == "video" || $value->type == "audio");
        });

        $menus = $artifacts->filter(function ($value, $key) {
            return (strtolower($value->type) == "menu");
        });

        $templates = $artifacts->filter(function ($value, $key) {
            return (strtolower($value->type) == "template");
        });
    @endphp

    <div class="tab-struct  custom-tab-1 mt-20 p-4">
        <ul role="tablist" class="nav nav-pills" id="myTab">
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" href="#home" role="tab" aria-controls="home" aria-selected="true">Components</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pages-tab" data-bs-toggle="tab" data-bs-target="#pages" href="#pages" role="tab" aria-controls="pages" aria-selected="false">Pages</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images" href="#images" role="tab" aria-controls="images" aria-selected="false">Graphics</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="menu-tab" data-bs-toggle="tab" data-bs-target="#menu" href="#menu" role="tab" aria-controls="menu" aria-selected="false">Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="templates-tab" data-bs-toggle="tab" data-bs-target="#templates" href="#templates" role="tab" aria-controls="templates" aria-selected="false">Templates</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="access-tab" data-bs-toggle="tab" data-bs-target="#access" href="#access" role="tab" aria-controls="access" aria-selected="false">Security</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" href="#settings" role="tab" aria-controls="settings" aria-selected="false">Settings</a>
            </li>
        </ul>
    </div>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-9 mb-15">
                                        <span class="small">Components are parts of a page that make up a site. Editing a component will only affect a small part of the page where the component is displayed.</span>
                                    </div>
                                    <div class="col-md-3 mb-15">
                                        <a id="btn-site-add-component" href="#" class="float-end btn btn-primary btn-xs btn-new-mdl-component-modal" data-bs-toggle="tooltip" title="Add New Component" style=""><span class="fa fa-plus-square mr-5"></span>Add New Component</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                        <table class="table table-hover mb-0 small">
                                            <thead> 
                                                <tr>
                                                    <th class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                </tr>    
                                            </thead>
                                            @if (isset($components) && !empty($components) && $components->count() > 0)
                                            <tbody> 
                                                @foreach ($components as $item)
                                                    <tr>
                                                        <td>{{$item->headline}}</td>
                                                        <td>
                                                            <a data-val="{{$item->id}}" id="btn-component-options" href="#" class="text-primary" data-bs-toggle="tooltip" title="Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-component-edit" href="#" class="text-primary" data-bs-toggle="tooltip" title="Edit" style=""><span class="fa fa-edit mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-component-delete" href="#" class="text-primary" data-bs-toggle="tooltip" title="Delete" style=""><span class="fa fa-trash mr-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="2" class="text-danger">
                                                    No components for this site, to add a new component, click on the "Add New Component" button.
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <div class="tab-pane fade" id="pages" role="tabpanel" aria-labelledby="pages-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 mb-15">
                                        <span class="small">Pages are the primary components that make up a site. Editing a page will affect the whole page and the layout of components on the page.</span>
                                    </div>
                                    <div class="col-md-3 mb-15">
                                        <a id="btn-site-add-page" href="#" class="float-end btn btn-primary btn-xs btn-new-mdl-page-modal" data-bs-toggle="tooltip" title="Add New Page" style=""><span class="fa fa-plus-square mr-5"></span>Add New Page</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                        <table class="table table-hover mb-0 small">
                                            <thead> 
                                                <tr>
                                                    <th class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                </tr>    
                                            </thead>
                                            @if (isset($pages) && !empty($pages) && $pages->count() > 0)
                                            <tbody> 
                                                @foreach ($pages as $item)
                                                    <tr>
                                                        <td>{{$item->page_name}}</td>
                                                        <td></td>
                                                        <td>
                                                            <a data-val="{{$item->id}}" id="btn-page-options" href="#" class="text-primary" data-bs-toggle="tooltip" title="Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-page-edit" href="#" class="text-primary" data-bs-toggle="tooltip" title="Edit" style=""><span class="fa fa-edit mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-page-delete" href="#" class="text-primary" data-bs-toggle="tooltip" title="Delete" style=""><span class="fa fa-trash mr-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="2" class="text-danger">
                                                    No pages for this site, to add a new page, click on the "Add New Page" button.
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <div class="tab-pane fade" id="images" role="tabpanel" aria-labelledby="images-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 mb-15">
                                        <span class="small">Graphics such as images, videos, and audio files may be added, and can be attached in pages and components of a site.</span>
                                    </div>
                                    <div class="col-md-3 mb-15">
                                        <a id="btn-site-add-image" href="#" class="float-end btn btn-primary btn-xs btn-new-mdl-image-modal" data-bs-toggle="tooltip" title="Add New Graphic" style=""><span class="fa fa-plus-square mr-5"></span>Add New Graphic</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                        <table class="table table-hover mb-0 small">
                                            <thead> 
                                                <tr>
                                                    <th class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                </tr>    
                                            </thead>
                                            @if (isset($graphics) && !empty($graphics) && $graphics->count() > 0)
                                            <tbody> 
                                                @foreach ($graphics as $item)
                                                    <tr>
                                                        <td>{{$item->headline}}</td>
                                                        <td>
                                                            <a data-val="{{$item->id}}" id="btn-graphic-options" href="#" class="text-primary" data-bs-toggle="tooltip" title="Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-graphic-edit" href="#" class="text-primary" data-bs-toggle="tooltip" title="Edit" style=""><span class="fa fa-edit mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-graphic-delete" href="#" class="text-primary" data-bs-toggle="tooltip" title="Delete" style=""><span class="fa fa-trash mr-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="2" class="text-danger">
                                                    No graphics for this site, to add a new graphic, click on the "Add New Graphic" button.
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            <!-- </div> -->
        </div>
        <div class="tab-pane fade" id="menu" role="tabpanel" aria-labelledby="menu-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 mb-15">
                                        <span class="small">Menu items can be displayed on a site to direct users to sepcific pages.</span>
                                    </div>
                                    <div class="col-md-3 mb-15">
                                        <a id="btn-site-add-menu" href="#" class="float-end btn btn-primary btn-xs btn-new-mdl-menu-modal" data-bs-toggle="tooltip" title="Add New Menu" style=""><span class="fa fa-plus-square mr-5"></span>Add New Menu</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                        <table class="table table-condensed table-hover mb-0 small">
                                            <thead> 
                                                <tr>
                                                    <th class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                </tr>    
                                            </thead>
                                            @if (isset($menus) && !empty($menus) && $menus->count() > 0)
                                            <tbody> 
                                                @foreach ($menus as $item)
                                                    <tr>
                                                        <td>{{$item->headline}}</td>
                                                        <td>
                                                            <a data-val="{{$item->id}}" id="btn-menu-options" href="#" class="text-primary" data-bs-toggle="tooltip" title="Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-menu-edit" href="#" class="text-primary" data-bs-toggle="tooltip" title="Edit" style=""><span class="fa fa-edit mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-menu-delete" href="#" class="text-primary" data-bs-toggle="tooltip" title="Delete" style=""><span class="fa fa-trash mr-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="2" class="text-danger">
                                                    No menu for this site, to add a new menu, click on the "Add New Menu" button.
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="tab-pane fade" id="templates" role="tabpanel" aria-labelledby="templates-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9 mb-15">
                                        <span class="small">Templates control how a page content is formated and displayed and can be applied to specific pages or all pages that form part of a site.</span>
                                    </div>
                                    <div class="col-md-3 mb-15">
                                        <a id="btn-site-add-template" href="#" class="float-end btn btn-primary btn-xs btn-new-mdl-template-modal" data-bs-toggle="tooltip" title="Add New Template" style=""><span class="fa fa-plus-square mr-5"></span>Add New Template</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                        <table class="table table-condensed table-hover mb-0 small">
                                            <thead> 
                                                <tr>
                                                    <th class="pa-0"></th>
                                                    <th width="150px" class="pa-0"></th>
                                                </tr>    
                                            </thead>
                                            @if (isset($templates) && !empty($templates) && $templates->count() > 0)
                                            <tbody> 
                                                @foreach ($templates as $item)
                                                    <tr>
                                                        <td>{{$item->headline}}</td>
                                                        <td>
                                                            <a data-val="{{$item->id}}" id="btn-template-options" href="#" class="text-primary" data-bs-toggle="tooltip" title="Settings" style=""><span class="fa fa-cogs mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-template-edit" href="#" class="text-primary" data-bs-toggle="tooltip" title="Edit" style=""><span class="fa fa-edit mr-5"></span></a>    
                                                            <a data-val="{{$item->id}}" id="btn-template-delete" href="#" class="text-primary" data-bs-toggle="tooltip" title="Delete" style=""><span class="fa fa-trash mr-5"></span></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            @else
                                            <tr>
                                                <td colspan="2" class="text-danger">
                                                    No template for this site, to add a new template, click on the "Add New Template" button.
                                                </td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        <div class="tab-pane fade" id="access" role="tabpanel" aria-labelledby="access-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    <!-- </div> -->
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card p-4">
                        <!-- <div class="card-wrapper collapse in"> -->
                            <div class="card-body pt-0">
                                <div class="row">
                                    <div class="col-md-12 mb-15">
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
    </div>

    @include('hasob-foundation-core::pages.modal')
    @include('hasob-foundation-core::site_artifacts.modal')

@endsection

@push('page_scripts')
<script type="text/javascript">
$(document).ready(function() {

    $('.offline').hide();
    $('#spinner').hide();
    function prepareArtifactsModalForm(){
        $('#div-siteArtifact-modal-error').hide();
        $('#mdl-siteArtifact-modal').modal('show');
        $('#frm-siteArtifact-modal').trigger("reset");
        $('#txt-siteArtifact-primary-id').val(0);

        $('#div-show-txt-siteArtifact-primary-id').hide();
        $('#div-edit-txt-siteArtifact-primary-id').show();

        $("#spinner-site_artifacts").hide();
        $("#div-save-mdl-siteArtifact-modal").attr('disabled', false);
    }

    function preparePagesModalForm(){
        $('#div-page-modal-error').hide();
        $('#mdl-page-modal').modal('show');
        $('#frm-page-modal').trigger("reset");
        $('#txt-page-primary-id').val(0);

        $('#div-show-txt-page-primary-id').hide();
        $('#div-edit-txt-page-primary-id').show();

        $("#spinner-pages").hide();
        $("#div-save-mdl-page-modal").attr('disabled', false);
    }

    $(document).on('click', "#btn-site-add-page", function(e) {
        preparePagesModalForm();
    });

    $(document).on('click', "#btn-site-add-component", function(e) {
        prepareArtifactsModalForm();
    });

});
</script>
@endpush