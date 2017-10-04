{{--@extends('voyager::master_metronic')--}}

@extends('voyager::master')

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    {{--<link href="{{ asset('assets/plugins/css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid" style="margin-bottom: 100px; padding-top: 50px;">
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> {{ __('voyager.post.title') }}
                                <span class="panel-desc"> {{ __('voyager.post.title_sub') }}</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title')
                            ])
                            <input type="text" class="form-control" id="title" name="title" placeholder="{{ __('voyager.generic.title') }}" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> {{ __('voyager.post.content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'body',
                            '_field_trans' => get_field_translations($dataTypeContent, 'body', 'rich_text_box', true)
                        ])
                        <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">@if(isset($dataTypeContent->body)){{ $dataTypeContent->body }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{!! __('voyager.post.excerpt') !!}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'excerpt',
                                '_field_trans' => get_field_translations($dataTypeContent, 'excerpt')
                            ])
                            <textarea class="form-control" name="excerpt">@if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif</textarea>
                        </div>
                    </div>

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Additional Fields</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $exclude = ['title', 'body', 'excerpt', 'slug', 'status', 'category_id', 'author_id', 'status_id', 'mandate_id', 'origin_id', 'featured', 'image', 'meta_description', 'meta_keywords', 'seo_title'];
                            @endphp

                            @foreach($dataTypeRows as $row)
                                @if(!in_array($row->field, $exclude))
                                    @php
                                        $options = json_decode($row->details);
                                        $display_options = isset($options->display) ? $options->display : NULL;
                                    @endphp
                                    @if ($options && isset($options->formfields_custom))
                                        @include('voyager::formfields.custom.' . $options->formfields_custom)
                                    @else
                                        <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@else{{ '' }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                            {{ $row->slugify }}
                                            <label for="name">{{ $row->display_name }}</label>
                                            @include('voyager::multilingual.input-hidden-bread-edit-add')
                                            @if($row->type == 'relationship')
                                                @include('voyager::formfields.relationship')
                                            @else
                                                {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                            @endif

                                            @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> {{ __('voyager.post.details') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.slug') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                                ])
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="slug"
                                       {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}}
                                       value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.status') }}</label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_published') }}</option>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_draft') }}</option>
                                    <option value="PENDING" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_pending') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.category') }}</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        @if($category->parent_id == null)
                                            <option style = "font-size: 20px" value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}(Category)(ID: {{ $category->id }})</option>
                                        @else
                                            <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif> - {{ $category->name }}(Category ID: {{ $category->parent_id }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.generic.featured') }}</label>
                                <input type="checkbox" name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif>
                            </div>
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager.post.image') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->image))
                                <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager.post.seo_content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.meta_description') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_description',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_description')
                                ])
                                <textarea class="form-control" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.meta_keywords') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'meta_keywords',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')
                                ])
                                <textarea class="form-control" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.seo_title') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'seo_title',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'seo_title')
                                ])
                                <input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status_id">
                                    @foreach(TCG\Voyager\Models\Status::all() as $status)
                                        <option value="{{ $status->reference }}" @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ 'selected="selected"' }}@endif>{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Mandate</label>
                                <select class="form-control" name="mandate_id">
                                    @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                        <option value="{{ $mandate->reference }}" @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ 'selected="selected"' }}@endif>{{ $mandate->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Origin</label>
                                <select class="form-control" name="origin_id">
                                    @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                        <option value="{{ $origin->reference }}" @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ 'selected="selected"' }}@endif>{{ $origin->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id)){{ __('voyager.post.update') }}@else <i class="icon wb-plus-circle"></i> {{ __('voyager.post.new') }} @endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>

    {{--This is mettronic "add object" form: BEGIN--}}
    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="display: none">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Add/Edit new object
                    </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="#" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Objects
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Object ID
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                        <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                            <i class="la la-plus m--hide"></i>
                            <i class="la la-ellipsis-h"></i>
                        </a>
                        <div class="m-dropdown__wrapper">
                            <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                            <div class="m-dropdown__inner">
                                <div class="m-dropdown__body">
                                    <div class="m-dropdown__content">
                                        <ul class="m-nav">
                                            <li class="m-nav__section m-nav__section--first m--hide">
                                                <span class="m-nav__section-text">
                                                    Quick Actions
                                                </span>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-share"></i>
                                                    <span class="m-nav__link-text">
                                                        Activity
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                    <span class="m-nav__link-text">
                                                        Messages
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-info"></i>
                                                    <span class="m-nav__link-text">
                                                        FAQ
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__item">
                                                <a href="" class="m-nav__link">
                                                    <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                                    <span class="m-nav__link-text">
                                                        Support
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="m-nav__separator m-nav__separator--fit"></li>
                                            <li class="m-nav__item">
                                                <a href="#" class="btn btn-outline-danger m-btn m-btn--pill m-btn--wide btn-sm">
                                                    Submit
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Général
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Full Name:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter full name">
                                        <span class="m-form__help">
                                            Please enter your full name
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <select name="object_category" title="">
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            Email:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter email">
                                        <span class="m-form__help">
                                            Please enter your email
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Username:
                                        </label>
                                        <div class="input-group m-input-group m-input-group--square">
                                            <span class="input-group-addon">
                                                <i class="la la-user"></i>
                                            </span>
                                            <input type="text" class="form-control m-input" placeholder="">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your username
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label class="">
                                            Contact:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter contact number">
                                        <span class="m-form__help">
                                            Please enter your contact
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            Fax:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Fax number">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-info-circle"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter fax
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Address:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your address">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your address
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label class="">
                                            Postcode:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-bookmark-o"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your postcode
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            User Group:
                                        </label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="example_2" checked value="2">
                                                Sales Person
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="example_2" value="2">
                                                Customer
                                                <span></span>
                                            </label>
                                        </div>
                                        <span class="m-form__help">
                                            Please select user group
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group">
                                    <label for="exampleTextarea">
                                        Example textarea
                                    </label>
                                    <textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                        <i class="la la-gear"></i>
                                    </span>
                                    <h3 class="m-portlet__head-text">
                                        Adresse
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label>
                                            Full Name:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter full name">
                                        <span class="m-form__help">
                                            Please enter your full name
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            Email:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter email">
                                        <span class="m-form__help">
                                            Please enter your email
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Username:
                                        </label>
                                        <div class="input-group m-input-group m-input-group--square">
                                            <span class="input-group-addon">
                                                <i class="la la-user"></i>
                                            </span>
                                            <input type="text" class="form-control m-input" placeholder="">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your username
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label class="">
                                            Contact:
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Enter contact number">
                                        <span class="m-form__help">
                                            Please enter your contact
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            Fax:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Fax number">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-info-circle"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter fax
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>
                                            Address:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your address">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your address
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <label class="">
                                            Postcode:
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your postcode">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-bookmark-o"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your postcode
                                        </span>
                                    </div>
                                    <div class="col-lg-4">
                                        <label class="">
                                            User Group:
                                        </label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="example_2" checked value="2">
                                                Sales Person
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="example_2" value="2">
                                                Customer
                                                <span></span>
                                            </label>
                                        </div>
                                        <span class="m-form__help">
                                            Please select user group
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="reset" class="btn btn-primary">Save</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                        <div class="col-lg-6 m--align-right">
                                            <button type="reset" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    {{--This is mettronic "add object" form: END--}}
@stop

@section('javascript')
    {{--<script src="{{ asset('assets/plugins/js/select2.min.js') }}" type="text/javascript"></script>--}}
    {{--<script>--}}
    {{--$('document').ready(function () {--}}
    {{--$('#slug').slugify();--}}

    {{--@if ($isModelTranslatable)--}}
    {{--$('.side-body').multilingual({"editing": true});--}}
    {{--@endif--}}
    {{--});--}}

    {{--$('select').select2();--}}
    {{--</script>--}}
@stop
