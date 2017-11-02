@extends('voyager::master_metronic')

{{--@extends('voyager::master')--}}

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
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
    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="">
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
            <!--begin::Form-->
            <form class="form-edit-add m-form m-form--group-seperator-dashed" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
                @if(isset($dataTypeContent->id))
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}
                <!-- Radactation -->
                <div class="m-portlet m-portlet--tabs">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">Rédaction</h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--right m-tabs-line-danger" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" data-toggle="tab" href="#fr_redaction" role="tab" aria-expanded="false">Français</a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#en_redaction" role="tab" aria-expanded="true">Anglais</a>
                                </li>
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link" data-toggle="tab" href="#es_redaction" role="tab" aria-expanded="true">Espagnol</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="form-group m-form__group">
                            <div class="row">
                                <div class="col-lg-12 margin_bottom_10">
                                    <div class="form-group">
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="ann_type" value="1" {{ ($dataTypeContent->ann_type == 1) ? 'checked' : '' }}>
                                                Vente
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="ann_type" value="0" {{ ($dataTypeContent->ann_type == 0) ? 'checked' : '' }}>
                                                Location
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane active" id="fr_redaction" role="tabpanel" aria-expanded="true">
                                    <div class="row">
                                        <div class="col-12 margin_bottom_10 lang-fr">
                                            <label>Titre de l'annonce FR</label>
                                            <input type="text" value="{{ $dataTypeContent->title_fr }}" class="form-control m-input" placeholder="Ad Title" name="title_fr" required="required">
                                        </div>
                                        <div class="col-12 margin_bottom_10 lang-fr">
                                            <label>Description de l'annonce FR</label>
                                            <textarea class="form-control m-input" name="desc_add_fr" rows="8">@if(isset($dataTypeContent->desc_add_fr)){{ $dataTypeContent->desc_add_fr }}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="en_redaction" role="tabpanel" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12 margin_bottom_10 lang-en">
                                            <label>Titre de l'annonce EN</label>
                                            <input type="text" value="{{ $dataTypeContent->title_en }}" class="form-control m-input" placeholder="Ad Title" name="title_en" required="required">
                                        </div>
                                        <div class="col-12 margin_bottom_10 lang-en">
                                            <label>Description de l'annonce EN</label>
                                            <textarea class="form-control m-input" name="desc_add_en" rows="8">@if(isset($dataTypeContent->desc_add_en)){{ $dataTypeContent->desc_add_en }}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="es_redaction" role="tabpanel" aria-expanded="false">
                                    <div class="row">
                                        <div class="col-12 margin_bottom_10 lang-es">
                                            <label>Titre de l'annonce ES</label>
                                            <input type="text" value="{{ $dataTypeContent->title_es }}" class="form-control m-input" placeholder="Ad Title" name="title_es" required="required">
                                        </div>
                                        <div class="col-12 margin_bottom_10 lang-es">
                                            <label>Description de l'annonce ES</label>
                                            <textarea class="form-control m-input" name="desc_add_es" rows="8">@if(isset($dataTypeContent->desc_add_es)){{ $dataTypeContent->desc_add_es }}@endif</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Radactation -->

                <!-- General -->
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
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Courtier</label>
                                            <select class="form-control m-select2 custom_select2" name="broker" data-placeholder="Select a Courtier">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    {{--<div class="col-lg-3 margin_bottom_10">--}}
                                        {{--<label categor>Catégorie</label>--}}
                                        {{--<select class="form-control m-select2 custom_select2 category" name="category_id" data-placeholder="Select a Category">--}}
                                            {{--@foreach(TCG\Voyager\Models\Category::all() as $category)--}}
                                                {{--@if($category->parent_id == null)--}}
                                                    {{--<option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>--}}
                                                {{--@endif--}}
                                            {{--@endforeach--}}
                                        {{--</select>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="m_select2_2">Sous-catégorie</label>--}}
                                            {{--<select class="form-control m-select2 custom_select2 sub-category" name="sub_category" data-placeholder="Select a sub-category">--}}
                                                {{--@foreach(TCG\Voyager\Models\Category::all() as $category)--}}
                                                {{--@if($category->parent_id != null)--}}
                                                {{--<option value="{{ $category->id }}" @if(isset($dataTypeContent->sub_category) && $dataTypeContent->sub_category == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>--}}
                                                {{--@endif--}}
                                                {{--@endforeach--}}
                                                {{--<option value="">Not SubCategories</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-12">
                                        <ul class="nav nav-tabs  m-tabs-line" role="tablist">
                                            @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                @if($category->parent_id == null)
                                                    <li class="nav-item m-tabs__item">
                                                        <a class="nav-link m-tabs__link @if(isset($dataTypeContent->$category->id) && $dataTypeContent->category_id == $category->id){{ 'active' }}@endif" cat_id="{{ $category->id }}" data-toggle="tab" href="#category_house" role="tab" aria-expanded="false">{{ $category->name }}</a>
                                                        <input name="category_id"  type="hidden">
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="category_house" role="tabpanel" aria-expanded="false">
                                                <div class="form-group">
                                                    <div class="m-radio-inline sub_cat">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Référence</label>
                                            <input type="text" class="form-control m-input" placeholder="Référence" value="@if(isset($dataTypeContent->reference)){{ $dataTypeContent->reference }}@endif" name="reference">
                                            <span class="m-form__help">Please enter Référence</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Statut</label>
                                            <select class="form-control m-select2 custom_select2" name="status_id" data-placeholder="Select a Statut">
                                                @foreach(TCG\Voyager\Models\Status::all() as $status)
                                                    <option value="{{ $status->reference }}" @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ 'selected="selected"' }}@endif>{{ $status->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Mandat</label>
                                            <select class="form-control m-select2 custom_select2" name="mandate_id" data-placeholder="Select a Mandat">
                                                @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                                    <option value="{{ $mandate->reference }}" @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ 'selected="selected"' }}@endif>{{ $mandate->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Origine</label>
                                            <select class="form-control m-select2 custom_select2" name="origin_id" data-placeholder="Select a Origine">
                                                @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                                    <option value="{{ $origin->reference }}" @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ 'selected="selected"' }}@endif>{{ $origin->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Début du mandat</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control m-input date-type" value="@if(isset($dataTypeContent->mandate_start)){{ $dataTypeContent->mandate_start }}@endif" readonly  placeholder="Sélectionner la date" name="mandate_start"/>
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Fin du mandat</label>
                                            <div class='input-group date'>
                                                <input type='text' class="form-control m-input date-type" value="@if(isset($dataTypeContent->term_end)){{ $dataTypeContent->term_end }}@endif" readonly  placeholder="Sélectionner la date" name="term_end"/>
                                                <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Disponibilité</label>
                                            <div class='input-group date' id='m_datepicker_4'>
                                                <input type='text' class="form-control m-input date-type rent" value="@if(isset($dataTypeContent->availability)){{ $dataTypeContent->availability }}@endif" readonly  placeholder="Sélectionner la date" name="availability"/>
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Disponibilité à partir du / jusqu'au</label>
                                            <div class="input-daterange input-group" id="m_datepicker_5">
                                                <input type="text" class="form-control m-input date-type" name="availab_from" value="@if(isset($dataTypeContent->availab_from)){{ $dataTypeContent->availab_from }}@endif" />
                                                <span class="input-group-addon">
                                                    <i class="la la-ellipsis-h"></i>
                                                </span>
                                                <input type="text" class="form-control date-type" name="availab_until" value="@if(isset($dataTypeContent->availab_until)){{ $dataTypeContent->availab_until }}@endif" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">
                                                Promotion :
                                            </label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="promotion" value="1" {{ ($dataTypeContent->promotion == 1) ? 'checked' : '' }}>
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="promotion" value="0" {{ ($dataTypeContent->promotion == 0) ? 'checked' : '' }}>
                                                    Non
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">Transaction directe :</label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="direct_transaction" value="1" {{ ($dataTypeContent->direct_transaction == 1) ? 'checked' : '' }}>
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="direct_transaction" value="0" {{ ($dataTypeContent->direct_transaction == 0) ? 'checked' : '' }}>
                                                    Non
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">Exclusivité</label>
                                            <div class="">
                                                <span class="m-switch m-switch--icon">
                                                    <label>
                                                        <input value="1" type="checkbox" checked {{ ($dataTypeContent->exclusiveness == 1) ? 'checked' : '' }} name="exclusiveness">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">Notation</label>
                                            <select class="bar_rating">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                            {{--<input type="number" class="form-control m-input" placeholder="Notation" value="@if(isset($dataTypeContent->notation)){{ $dataTypeContent->notation }}@endif" name="notation">--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Note sur la transaction</label>
                                            {{--<input type="text" class="form-control m-input" placeholder="Note sur la transaction" value="@if(isset($dataTypeContent->note_transaction)){{ $dataTypeContent->note_transaction }}@endif" name="note_transaction">--}}
                                            <textarea name="note_transaction" class="form-control m-input" placeholder="Note sur la transaction" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Note courtier</label>
                                            {{--<input type="text" class="form-control m-input" placeholder="Note courtier" value="@if(isset($dataTypeContent->broker_notes)){{ $dataTypeContent->broker_notes }}@endif" name="broker_notes">--}}
                                            <textarea name="broker_notes" class="form-control m-input" placeholder="Note courtier" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Remarques importantes</label>
                                            {{--<input type="text" class="form-control m-input" placeholder="Remarques importantes" value="@if(isset($dataTypeContent->important_notes)){{ $dataTypeContent->important_notes }}@endif" name="important_notes">--}}
                                            <textarea name="important_notes" class="form-control m-input" placeholder="Remarques importantes" rows="8"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Notes pour le propriétaire</label>
                                            {{--<input type="text" class="form-control m-input" placeholder="Notes pour le propriétaire" value="@if(isset($dataTypeContent->owner_notes)){{ $dataTypeContent->owner_notes }}@endif" name="owner_notes">--}}
                                            <textarea name="owner_notes" class="form-control m-input" placeholder="Notes pour le propriétaire" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Form-->
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>
                <!-- End General -->

                <!-- Adresse -->
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
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6 margin_bottom_10">
                                        <label>Adresse</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" id="pac-input" class="form-control m-input" placeholder="Entrer votre adresse" value="@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif" name="address">
                                            {{--<input id="pac-input" class="controls" type="text" placeholder="Search Box">--}}
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <button type="button" class="btn btn-secondary">Placer l’adresse sur la carte</button>
                                        {{--<div style="height:500px;width:1000px;text-align: center;" id="map"></div>--}}
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Rue</label>
                                        <input type="text" class="form-control m-input" placeholder="Rue" value="@if(isset($dataTypeContent->street)){{ $dataTypeContent->street }}@endif" name="street">
                                    </div>
                                    <div class="col-lg-2 margin_bottom_10">
                                        <label>N°</label>
                                        <input type="text" class="form-control m-input" placeholder="N°" value="@if(isset($dataTypeContent->number)){{ $dataTypeContent->number }}@endif" name="number">
                                    </div>
                                    <div class="col-lg-2 margin_bottom_10">
                                        <label>CP</label>
                                        <input type="number" class="form-control m-input" placeholder="CP" value="@if(isset($dataTypeContent->po_box)){{ $dataTypeContent->po_box }}@endif" name="po_box">
                                    </div>
                                    <div class="col-lg-2 margin_bottom_10">
                                        <label>NPA</label>
                                        <input type="text" class="form-control m-input" placeholder="NPA" value="@if(isset($dataTypeContent->zip_code)){{ $dataTypeContent->zip_code }}@endif" name="zip_code">
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Ville</label>
                                        <input type="text" class="form-control m-input" placeholder="Ville" value="@if(isset($dataTypeContent->town)){{ $dataTypeContent->town }}@endif" name="town">
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Pays</label>
                                        <select class="form-control m-select2 custom_select2" name="country" data-placeholder="Select a Country">
                                            @foreach(TCG\Voyager\Models\Country::all() as $country)
                                                <option value="{{ $country->reference }}" @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ 'selected="selected"' }}@endif>{{ $country->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Longitude</label>
                                        <input disabled="disabled" type="number" class="form-control m-input" placeholder="Longitude" name="longitude">
                                    </div>
                                    <div class="col-lg-3">
                                        <label>Latitude</label>
                                        <input disabled="disabled" type="number" class="form-control m-input" placeholder="Longitude" name="latitude">
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Localisation</label>
                                        <select class="form-control m-select2 custom_select2" name="location" data-placeholder="Select Location">
                                            @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                <option value="{{ $location->reference }}" @if(isset($dataTypeContent->location) && $dataTypeContent->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Portlet-->
                    </div>
                </div>
                <!-- End Adresse -->

                <!-- Prix -->
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
                                        <h3 class="m-portlet__head-text">Prix</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="">Afficher le prix</label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price" value="1" {{ ($dataTypeContent->show_price == 1) ? 'checked' : '' }}>
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price" value="0" {{ ($dataTypeContent->show_price == 0) ? 'checked' : '' }}>
                                                    Non
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Devise</label>
                                            <select class="form-control m-select2 custom_select2" name="сurrency" data-placeholder="Select currency">
                                                @foreach(TCG\Voyager\Models\Currency::all() as $сurrency)
                                                    <option value="{{ $сurrency->reference }}" @if(isset($dataTypeContent->сurrency) && $dataTypeContent->сurrency == $сurrency->reference){{ 'selected="selected"' }}@endif>{{ $сurrency->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Prix</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->price)){{ $dataTypeContent->price }}@endif" name="price">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Prix au m<sup>2</sup></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->price_m2)){{ $dataTypeContent->price_m2 }}@endif" name="price_m2">
                                                <span class="input-group-addon">EUR/m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Rendement brut</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->gross_yield)){{ $dataTypeContent->gross_yield }}@endif" name="gross_yield">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Rendement net</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->net_return)){{ $dataTypeContent->net_return }}@endif" name="net_return">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant négociable</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->negotiable_amount)){{ $dataTypeContent->negotiable_amount }}@endif" name="negotiable_amount">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant estimé</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->estimate_price)){{ $dataTypeContent->estimate_price }}@endif" name="estimate_price">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant propriétaire</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->owner_amount)){{ $dataTypeContent->owner_amount }}@endif" name="owner_amount">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Honoraire client</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->client_fees)){{ $dataTypeContent->client_fees }}@endif" name="client_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Honoraire propriétaire</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->owner_fees)){{ $dataTypeContent->owner_fees }}@endif" name="owner_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Droits d'enregistremenet</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->recording_rights)){{ $dataTypeContent->recording_rights }}@endif" name="recording_rights">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges de chauffage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->heating_loads)){{ $dataTypeContent->heating_loads }}@endif" name="heating_loads">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges PPE</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->ppe_charges)){{ $dataTypeContent->ppe_charges }}@endif" name="ppe_charges">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges de copropriété</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->condominium_fees)){{ $dataTypeContent->condominium_fees }}@endif" name="condominium_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges annuelles</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->annual_charges)){{ $dataTypeContent->annual_charges }}@endif" name="annual_charges">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Taxe d'habitation</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->taxes_1)){{ $dataTypeContent->taxes_1 }}@endif" name="taxes_1">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Taxe foncière</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->property_tax)){{ $dataTypeContent->property_tax }}@endif" name="property_tax">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Caution locative</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->rental_security)){{ $dataTypeContent->rental_security }}@endif" name="rental_security">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Fonds de rénovation</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->renovation_fund)){{ $dataTypeContent->renovation_fund }}@endif" name="renovation_fund">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Revenus</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->earnings)){{ $dataTypeContent->earnings }}@endif" name="earnings">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Impôts</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->taxes)){{ $dataTypeContent->taxes }}@endif" name="taxes">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Fonds de commerce</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->commercial_property)){{ $dataTypeContent->commercial_property }}@endif" name="commercial_property">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Régime</label>
                                            <select class="form-control m-select2 custom_select2" name="regime" data-placeholder="Select currency">
                                                @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                                    <option value="{{ $regime->reference }}" @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ 'selected="selected"' }}@endif>{{ $regime->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->procedure_in_progress) && $dataTypeContent->procedure_in_progress){{ 'checked="checked"' }}@endif name="procedure_in_progress">
                                                Procédure en cours auprès de la copropriété
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                <!-- End Prix -->

                <!-- Agencement -->
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
                                        <h3 class="m-portlet__head-text">Agencement</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de pièces</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_pieces)){{ $dataTypeContent->number_pieces }}@endif" name="number_pieces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de chambres</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_rooms)){{ $dataTypeContent->number_rooms }}@endif" name="number_rooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de salles de douche</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_shower_rooms)){{ $dataTypeContent->number_shower_rooms }}@endif" name="number_shower_rooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de WC</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_toilets)){{ $dataTypeContent->number_toilets }}@endif" name="number_toilets">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de salles d'eau</label>
                                            <div class="input-group">
                                                <input type="number" disabled class="form-control m-input" placeholder="Nb douche + Nb de WC" value="@if(isset($dataTypeContent->number__bathrooms)){{ $dataTypeContent->number__bathrooms }}@endif" name="number__bathrooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Niveaux</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..."  value="@if(isset($dataTypeContent->levels)){{ $dataTypeContent->levels }}@endif" name="levels">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de terasses</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_terraces)){{ $dataTypeContent->number_terraces }}@endif" name="number_terraces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb de balcons</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_balconies)){{ $dataTypeContent->number_balconies }}@endif" name="number_balconies">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Etage du bien</label>
                                            <select class="form-control m-select2 custom_select2" name="floor_property" data-placeholder="Select Floor">
                                                @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)
                                                    <option value="{{ $floor_property->reference }}" @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ 'selected="selected"' }}@endif>{{ $floor_property->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nb d'étage du bâtiment</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_floors_building)){{ $dataTypeContent->number_floors_building }}@endif" name="number_floors_building">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Agencement -->

                <!-- Surface -->
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
                                        <h3 class="m-portlet__head-text">Surface</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface des combles</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->attic_space)){{ $dataTypeContent->attic_space }}@endif" name="attic_space">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                {{--<input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface du balcon</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->surface_balcony)){{ $dataTypeContent->surface_balcony }}@endif" name="surface_balcony">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface du sous-sol</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->basement_area)){{ $dataTypeContent->basement_area }}@endif" name="basement_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de la cave</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->surface_cellar)){{ $dataTypeContent->surface_cellar }}@endif" name="surface_cellar">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de la terrasse solarium</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->surf_area_terr_solar)){{ $dataTypeContent->surf_area_terr_solar }}@endif" name="surf_area_terr_solar">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de l'abri de la toiture</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->roof_cover_area)){{ $dataTypeContent->roof_cover_area }}@endif" name="roof_cover_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de la véranda</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->area_veranda)){{ $dataTypeContent->area_veranda }}@endif" name="area_veranda">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de la cour anglaise</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->surface_eng_court)){{ $dataTypeContent->surface_eng_court }}@endif" name="surface_eng_court">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control custom_input_for_coefficient" placeholder="" value="" name="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface pondérée</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" disabled="disabled" placeholder="..." value="@if(isset($dataTypeContent->weighted_surface)){{ $dataTypeContent->weighted_surface }}@endif" name="weighted_surface">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Terrain</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="Longeur" value="@if(isset($dataTypeContent->ground_length)){{ $dataTypeContent->ground_length }}@endif" name="ground_length" />
                                                <span class="input-group-addon">m</span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-close"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="Largeur" value="@if(isset($dataTypeContent->ground_width)){{ $dataTypeContent->ground_width }}@endif" name="ground_width" />
                                                <span class="input-group-addon">m</span>
                                                <span class="input-group-addon custom_additional_addon">
                                                    <i class="la la-pause" style="-webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);-ms-transform: rotate(90deg);-o-transform: rotate(90deg);transform: rotate(90deg);"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="Total" disabled="disabled" value="@if(isset($dataTypeContent->surface_ground)){{ $dataTypeContent->surface_ground }}@endif" name="surface_ground" />
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de terrain</label>
                                            <select class="form-control m-select2 custom_select2" name="type_land" data-placeholder="Select Floor">
                                                @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                                    <option value="{{ $type_land->reference }}" @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ 'selected="selected"' }}@endif>{{ $type_land->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface PPE</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->ppe_area)){{ $dataTypeContent->ppe_area }}@endif" name="ppe_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface rez-de-chaussée inférieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->lower_ground_floor)){{ $dataTypeContent->lower_ground_floor }}@endif" name="lower_ground_floor">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->volume)){{ $dataTypeContent->volume }}@endif" name="volume">
                                                <span class="input-group-addon">m<sup>3</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface de l'emprise</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->row_area)){{ $dataTypeContent->row_area }}@endif" name="row_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface du garage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->garage_area)){{ $dataTypeContent->garage_area }}@endif" name="garage_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Surface utille</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->useful_surface)){{ $dataTypeContent->useful_surface }}@endif" name="useful_surface">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Hauteur des plafonds</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->ceiling_height)){{ $dataTypeContent->ceiling_height }}@endif" name="ceiling_height">
                                                <span class="input-group-addon">m</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">Viabilisé</label>
                                            <div class="">
                                                <span class="m-switch m-switch--icon">
                                                    <label>
                                                        <input type="checkbox" @if(isset($dataTypeContent->serviced) && $dataTypeContent->serviced){{ 'checked="checked"' }}@endif name="serviced">
                                                        <span></span>
                                                    </label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Surface -->

                <!-- Stationnement -->
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
                                        <h3 class="m-portlet__head-text">Stationnement</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage intérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->box_interior_garage)){{ $dataTypeContent->box_interior_garage }}@endif" name="box_interior_garage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage double intérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->box_gar_inter_doub)){{ $dataTypeContent->box_gar_inter_doub }}@endif" name="box_gar_inter_doub">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage extérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->outdoor_garage)){{ $dataTypeContent->outdoor_garage }}@endif" name="outdoor_garage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage double extérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->box_garage_outside_double)){{ $dataTypeContent->box_garage_outside_double }}@endif" name="box_garage_outside_double">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place de parc extérieure couverte</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->covered_outdoor_parking_space)){{ $dataTypeContent->covered_outdoor_parking_space }}@endif" name="covered_outdoor_parking_space">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place de parc extérieur non-couverte</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->outside_parking_space_uncovered)){{ $dataTypeContent->outside_parking_space_uncovered }}@endif" name="outside_parking_space_uncovered">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de places de parc</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number_parking_spaces)){{ $dataTypeContent->number_parking_spaces }}@endif" name="number_parking_spaces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Hangar à bateau</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->boat_shed)){{ $dataTypeContent->boat_shed }}@endif" name="boat_shed">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place d'amarrage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->mooring)){{ $dataTypeContent->mooring }}@endif" name="mooring">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Stationnement -->

                <!-- Cuisine -->
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
                                        <h3 class="m-portlet__head-text">Cuisine</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <select class="form-control m-select2 custom_select2" name="type" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Kitchen::all() as $type)
                                                    <option value="{{ $type->reference }}" @if(isset($dataTypeContent->type) && $dataTypeContent->type == $type->reference){{ 'selected="selected"' }}@endif>{{ $type->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->freezer) && $dataTypeContent->freezer){{ 'checked="checked"' }}@endif name="freezer">Congélateur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->cooker) && $dataTypeContent->cooker){{ 'checked="checked"' }}@endif name="cooker">Cusinière
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->oven) && $dataTypeContent->oven){{ 'checked="checked"' }}@endif name="oven">Four
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->microwave_oven) && $dataTypeContent->microwave_oven){{ 'checked="checked"' }}@endif name="microwave_oven">Four à micro-ondes
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->extractor_hood) && $dataTypeContent->extractor_hood){{ 'checked="checked"' }}@endif name="extractor_hood">Hotte aspirante
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->washmachine) && $dataTypeContent->washmachine){{ 'checked="checked"' }}@endif name="washmachine">Lave-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->dishwasher) && $dataTypeContent->dishwasher){{ 'checked="checked"' }}@endif name="dishwasher">Lave-vaiselle
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->plates) && $dataTypeContent->plates){{ 'checked="checked"' }}@endif name="plates">Plaques à gaz
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->induction_plates) && $dataTypeContent->induction_plates){{ 'checked="checked"' }}@endif name="induction_plates">Plaques à induction
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->hotplates) && $dataTypeContent->hotplates){{ 'checked="checked"' }}@endif name="hotplates">Plaques électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->ceramic_plates) && $dataTypeContent->ceramic_plates){{ 'checked="checked"' }}@endif name="ceramic_plates">Plaques vitrocéram
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->fridge) && $dataTypeContent->fridge){{ 'checked="checked"' }}@endif name="fridge">Réfrigérateur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->cuisine_tumble_drier) && $dataTypeContent->cuisine_tumble_drier){{ 'checked="checked"' }}@endif name="cuisine_tumble_drier">Sèche-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->coffee_maker) && $dataTypeContent->coffee_maker){{ 'checked="checked"' }}@endif name="coffee_maker">Cafetière
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cuisine -->

                <!-- Chauffage -->
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
                                        <h3 class="m-portlet__head-text">Chauffage</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Format</label>
                                            <select class="form-control m-select2 custom_select2" name="format" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Heating::all() as $format)
                                                    <option value="{{ $format->reference }}" @if(isset($dataTypeContent->format) && $dataTypeContent->format == $format->reference){{ 'selected="selected"' }}@endif>{{ $format->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Energie</label>
                                            <select class="form-control m-select2 custom_select2" name="chauffage_energy" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Energy::all() as $chauffage_energy)
                                                    <option value="{{ $chauffage_energy->reference }}" @if(isset($dataTypeContent->chauffage_energy) && $dataTypeContent->chauffage_energy == $chauffage_energy->reference){{ 'selected="selected"' }}@endif>{{ $chauffage_energy->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de chauffage</label>
                                            <select class="form-control m-select2 custom_select2" name="type_heating" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\HeatingType::all() as $type_heating)
                                                    <option value="{{ $type_heating->reference }}" @if(isset($dataTypeContent->type_heating) && $dataTypeContent->type_heating == $type_heating->reference){{ 'selected="selected"' }}@endif>{{ $type_heating->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de radiateur</label>
                                            <select class="form-control m-select2 custom_select2" name="type_radiator" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Radiator::all() as $type_radiator)
                                                    <option value="{{ $type_radiator->reference }}" @if(isset($dataTypeContent->type_radiator) && $dataTypeContent->type_radiator == $type_radiator->reference){{ 'selected="selected"' }}@endif>{{ $type_radiator->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Chauffage -->

                <!-- Eau chaude -->
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
                                        <h3 class="m-portlet__head-text">Eau chaude</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Distribution</label>
                                            <select class="form-control m-select2 custom_select2" name="distribution" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\WaterDistribution::all() as $distribution)
                                                    <option value="{{ $distribution->reference }}" @if(isset($dataTypeContent->distribution) && $dataTypeContent->distribution == $distribution->reference){{ 'selected="selected"' }}@endif>{{ $distribution->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Energie</label>
                                            <select class="form-control m-select2 custom_select2" name="eau_chaude_energy" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\WaterEnergy::all() as $eau_chaude_energy)
                                                    <option value="{{ $eau_chaude_energy->reference }}" @if(isset($dataTypeContent->eau_chaude_energy) && $dataTypeContent->eau_chaude_energy == $eau_chaude_energy->reference){{ 'selected="selected"' }}@endif>{{ $eau_chaude_energy->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Eau chaude -->

                <!-- Eau Usées-->
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
                                        <h3 class="m-portlet__head-text">Eau usées</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Distribution</label>
                                            <select class="form-control m-select2 custom_select2" name="usees_distribution" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\WasteDistribution::all() as $usees_distribution)
                                                    <option value="{{ $usees_distribution->reference }}" @if(isset($dataTypeContent->usees_distribution) && $dataTypeContent->usees_distribution == $usees_distribution->reference){{ 'selected="selected"' }}@endif>{{ $usees_distribution->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Eau usées -->

                <!-- Divers-->
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
                                        <h3 class="m-portlet__head-text">Divers</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Minergie</label>
                                            <select class="form-control m-select2 custom_select2" name="divers_format" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Minergie::all() as $divers_format)
                                                    <option value="{{ $divers_format->reference }}" @if(isset($dataTypeContent->divers_format) && $dataTypeContent->divers_format == $divers_format->reference){{ 'selected="selected"' }}@endif>{{ $divers_format->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Sonorité</label>
                                            <select class="form-control m-select2 custom_select2" name="sonority" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Sonority::all() as $sonority)
                                                    <option value="{{ $sonority->reference }}" @if(isset($dataTypeContent->sonority) && $dataTypeContent->sonority == $sonority->reference){{ 'selected="selected"' }}@endif>{{ $sonority->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Style</label>
                                            <select class="form-control m-select2 custom_select2" name="style" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Style::all() as $style)
                                                    <option value="{{ $style->reference }}" @if(isset($dataTypeContent->style) && $dataTypeContent->style == $style->reference){{ 'selected="selected"' }}@endif>{{ $style->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Divers -->

                <!-- Eau Commodités-->
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
                                        <h3 class="m-portlet__head-text">Commodités</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->shelter) && $dataTypeContent->shelter){{ 'checked="checked"' }}@endif name="shelter">Abri
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->access_disabled) && $dataTypeContent->access_disabled){{ 'checked="checked"' }}@endif name="access_disabled">Accès pour handicapé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->water_softener) && $dataTypeContent->water_softener){{ 'checked="checked"' }}@endif name="water_softener">Adoucisseur d'eau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->air_conditioning) && $dataTypeContent->air_conditioning){{ 'checked="checked"' }}@endif name="air_conditioning">Air conditionné
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->pets_welcome) && $dataTypeContent->pets_welcome){{ 'checked="checked"' }}@endif name="pets_welcome">Animaux bienvenus
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->titlfitted_wardrobese) && $dataTypeContent->fitted_wardrobes){{ 'checked="checked"' }}@endif name="fitted_wardrobes">Armoires encastrées
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->private_lift) && $dataTypeContent->private_lift){{ 'checked="checked"' }}@endif name="private_lift">Ascenseur privé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->central_aspiration) && $dataTypeContent->central_aspiration){{ 'checked="checked"' }}@endif name="central_aspiration">Aspiration centralisée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->workshop) && $dataTypeContent->workshop){{ 'checked="checked"' }}@endif name="workshop">Atelier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->patch_panel) && $dataTypeContent->patch_panel){{ 'checked="checked"' }}@endif name="patch_panel">Baie de brassage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->windows) && $dataTypeContent->windows){{ 'checked="checked"' }}@endif name="windows">Baies vitrées
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->bath) && $dataTypeContent->bath){{ 'checked="checked"' }}@endif name="bath">Baignoire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->balneo_bath) && $dataTypeContent->balneo_bath){{ 'checked="checked"' }}@endif name="balneo_bath">Baignoire balnéo
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->private_laundry_room) && $dataTypeContent->private_laundry_room){{ 'checked="checked"' }}@endif name="private_laundry_room">Buanderie privée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->cafeteria) && $dataTypeContent->cafeteria){{ 'checked="checked"' }}@endif name="cafeteria">Cafétéria
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->carnotzet) && $dataTypeContent->carnotzet){{ 'checked="checked"' }}@endif name="carnotzet">Carnotzet
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->cave) && $dataTypeContent->cave){{ 'checked="checked"' }}@endif name="cave">Cave
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->wine_cellar) && $dataTypeContent->wine_cellar){{ 'checked="checked"' }}@endif name="wine_cellar">Cave à vin
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->cellar) && $dataTypeContent->cellar){{ 'checked="checked"' }}@endif name="cellar">Cellier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->fireplace) && $dataTypeContent->fireplace){{ 'checked="checked"' }}@endif name="fireplace">Cheminée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->air_conditioner) && $dataTypeContent->air_conditioner){{ 'checked="checked"' }}@endif name="air_conditioner">Climatisation
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->removable_partitions) && $dataTypeContent->removable_partitions){{ 'checked="checked"' }}@endif name="removable_partitions">Cloisons amovibles
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->addiction) && $dataTypeContent->addiction){{ 'checked="checked"' }}@endif name="addiction">Dépendance
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->automation) && $dataTypeContent->automation){{ 'checked="checked"' }}@endif name="automation">Domotique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->double_glazing) && $dataTypeContent->double_glazing){{ 'checked="checked"' }}@endif name="double_glazing">Double vitrage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->shower) && $dataTypeContent->shower){{ 'checked="checked"' }}@endif name="shower">Douche
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->dressing) && $dataTypeContent->dressing){{ 'checked="checked"' }}@endif name="dressing">Dressing
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->automatic_fire_extinguisher) && $dataTypeContent->automatic_fire_extinguisher){{ 'checked="checked"' }}@endif name="automatic_fire_extinguisher">Extincteur automatique à eau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->false_ceiling) && $dataTypeContent->false_ceiling){{ 'checked="checked"' }}@endif name="false_ceiling">Faux plafond
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->optical_fiber) && $dataTypeContent->optical_fiber){{ 'checked="checked"' }}@endif name="optical_fiber">Fibre optique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->attic) && $dataTypeContent->attic){{ 'checked="checked"' }}@endif name="attic">Grenier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->generator) && $dataTypeContent->generator){{ 'checked="checked"' }}@endif name="generator">Groupe électrogène
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->hammam) && $dataTypeContent->hammam){{ 'checked="checked"' }}@endif name="hammam">Hammam
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->high_internet) && $dataTypeContent->high_internet){{ 'checked="checked"' }}@endif name="high_internet">Internet Haut Débit
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->jacuzzi) && $dataTypeContent->jacuzzi){{ 'checked="checked"' }}@endif name="jacuzzi">Jacuzzi
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->winter_garden) && $dataTypeContent->winter_garden){{ 'checked="checked"' }}@endif name="winter_garden">Jardin d'hiver
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->ski_locker) && $dataTypeContent->ski_locker){{ 'checked="checked"' }}@endif name="ski_locker">Local à ski
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->bicycle_storage) && $dataTypeContent->bicycle_storage){{ 'checked="checked"' }}@endif name="bicycle_storage">Local à velo
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->loggia) && $dataTypeContent->loggia){{ 'checked="checked"' }}@endif name="loggia">Loggia
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->net) && $dataTypeContent->net){{ 'checked="checked"' }}@endif name="net">Monstiquaire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->hoist) && $dataTypeContent->hoist){{ 'checked="checked"' }}@endif name="hoist">Monte-charge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->open_plan) && $dataTypeContent->open_plan){{ 'checked="checked"' }}@endif name="open_plan">Open-space
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->outdoor_pool) && $dataTypeContent->outdoor_pool){{ 'checked="checked"' }}@endif name="outdoor_pool">Piscine extérieure
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->indoor_pool) && $dataTypeContent->indoor_pool){{ 'checked="checked"' }}@endif name="indoor_pool">Piscine intérieure
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->ceramic_stove) && $dataTypeContent->ceramic_stove){{ 'checked="checked"' }}@endif name="ceramic_stove">Poêle en céramique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->swedish_stove) && $dataTypeContent->swedish_stove){{ 'checked="checked"' }}@endif name="swedish_stove">Poêle suédois
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->loading_dock) && $dataTypeContent->loading_dock){{ 'checked="checked"' }}@endif name="loading_dock">Quai de déchargement
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->connection_chimney) && $dataTypeContent->connection_chimney){{ 'checked="checked"' }}@endif name="connection_chimney">Raccordement pour cheminée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->connection_swedish_stove) && $dataTypeContent->connection_swedish_stove){{ 'checked="checked"' }}@endif name="connection_swedish_stove">Raccordement pour poêle suédois
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->reception) && $dataTypeContent->reception){{ 'checked="checked"' }}@endif name="reception">Réception
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->metallic_curtain) && $dataTypeContent->metallic_curtain){{ 'checked="checked"' }}@endif name="metallic_curtain">Rideau métallique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->armed_with_fire_tap) && $dataTypeContent->armed_with_fire_tap){{ 'checked="checked"' }}@endif name="armed_with_fire_tap">Robinet d'incendie armé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->do_it_yourself_room) && $dataTypeContent->do_it_yourself_room){{ 'checked="checked"' }}@endif name="do_it_yourself_room">Salle de bricolage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->theater) && $dataTypeContent->theater){{ 'checked="checked"' }}@endif name="theater">Salle de cinéma
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->game_room) && $dataTypeContent->game_room){{ 'checked="checked"' }}@endif name="game_room">Salle de jeux
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->fitness_room) && $dataTypeContent->fitness_room){{ 'checked="checked"' }}@endif name="fitness_room">Salle fitness
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->conference_room) && $dataTypeContent->conference_room){{ 'checked="checked"' }}@endif name="conference_room">Salle de conférence
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->satellite) && $dataTypeContent->satellite){{ 'checked="checked"' }}@endif name="satellite">Satellite
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->sauna) && $dataTypeContent->sauna){{ 'checked="checked"' }}@endif name="sauna">Sauna
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->subsoil) && $dataTypeContent->subsoil){{ 'checked="checked"' }}@endif name="subsoil">Sous-sol
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->blinds) && $dataTypeContent->blinds){{ 'checked="checked"' }}@endif name="blinds">Stores
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->electric_blinds) && $dataTypeContent->electric_blinds){{ 'checked="checked"' }}@endif name="electric_blinds">Stores électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->thermostat_connected) && $dataTypeContent->thermostat_connected){{ 'checked="checked"' }}@endif name="thermostat_connected">Thermostat connecté
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->triple_glazing) && $dataTypeContent->triple_glazing){{ 'checked="checked"' }}@endif name="triple_glazing">Triple vitrage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->veranda) && $dataTypeContent->veranda){{ 'checked="checked"' }}@endif name="veranda">Véranda
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->crawlspace) && $dataTypeContent->crawlspace){{ 'checked="checked"' }}@endif name="crawlspace">Vide sanitaire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->electric_shutters) && $dataTypeContent->electric_shutters){{ 'checked="checked"' }}@endif name="electric_shutters">Volets roulants électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->tumble_drier) && $dataTypeContent->tumble_drier){{ 'checked="checked"' }}@endif name="tumble_drier">Sèche-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->hair_dryer) && $dataTypeContent->hair_dryer){{ 'checked="checked"' }}@endif name="hair_dryer">Sèche-cheveux
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->satellite_tv) && $dataTypeContent->satellite_tv){{ 'checked="checked"' }}@endif name="satellite_tv">TV Satellite
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->phone) && $dataTypeContent->phone){{ 'checked="checked"' }}@endif name="phone">Téléphone
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Equipement extérieur -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->car_shelter) && $dataTypeContent->car_shelter){{ 'checked="checked"' }}@endif name="car_shelter">Abri de voiture
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->spray) && $dataTypeContent->spray){{ 'checked="checked"' }}@endif name="spray">Arrosage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->barbecue) && $dataTypeContent->barbecue){{ 'checked="checked"' }}@endif name="barbecue">Barbecue
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->exterior_lighting) && $dataTypeContent->exterior_lighting){{ 'checked="checked"' }}@endif name="exterior_lighting">Eclairage extérieur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->drilling) && $dataTypeContent->drilling){{ 'checked="checked"' }}@endif name="drilling">Forage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->heliport) && $dataTypeContent->heliport){{ 'checked="checked"' }}@endif name="heliport">Héliport
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->well) && $dataTypeContent->well){{ 'checked="checked"' }}@endif name="well">Puits
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->source) && $dataTypeContent->source){{ 'checked="checked"' }}@endif name="source">Source
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Immeuble -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->collective_lift) && $dataTypeContent->collective_lift){{ 'checked="checked"' }}@endif name="collective_lift">Ascenseur collectif
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->communal_laundry_room) && $dataTypeContent->communal_laundry_room){{ 'checked="checked"' }}@endif name="communal_laundry_room">Buanderie collective
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->network_cabling) && $dataTypeContent->network_cabling){{ 'checked="checked"' }}@endif name="network_cabling">Câblage réseau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->collective_optical_fiber) && $dataTypeContent->collective_optical_fiber){{ 'checked="checked"' }}@endif name="collective_optical_fiber">Fibre optique collective
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->parable) && $dataTypeContent->parable){{ 'checked="checked"' }}@endif name="parable">Parabole
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Sécurité -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->alarm) && $dataTypeContent->alarm){{ 'checked="checked"' }}@endif name="alarm">Alamre
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->magnetic_card) && $dataTypeContent->magnetic_card){{ 'checked="checked"' }}@endif name="magnetic_card">Carte magnétique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->fenced) && $dataTypeContent->fenced){{ 'checked="checked"' }}@endif name="fenced">Clôturé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->safe) && $dataTypeContent->safe){{ 'checked="checked"' }}@endif name="safe">Coffre-fort
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->digidode) && $dataTypeContent->digidode){{ 'checked="checked"' }}@endif name="digidode">DigiCode
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->guardian) && $dataTypeContent->guardian){{ 'checked="checked"' }}@endif name="guardian">Gardien
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->caretaker) && $dataTypeContent->caretaker){{ 'checked="checked"' }}@endif name="caretaker">Gardien d'immeuble
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->intercom) && $dataTypeContent->intercom){{ 'checked="checked"' }}@endif name="intercom">Interphone
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->electric_gate) && $dataTypeContent->electric_gate){{ 'checked="checked"' }}@endif name="electric_gate">Portail électrique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->reinforced_door) && $dataTypeContent->reinforced_door){{ 'checked="checked"' }}@endif name="reinforced_door">Porte blindée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->videophone) && $dataTypeContent->videophone){{ 'checked="checked"' }}@endif name="videophone">Vidéophone
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Commodités -->

                <!-- Eau Vue-->
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
                                        <h3 class="m-portlet__head-text">Vue</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->clear) && $dataTypeContent->clear){{ 'checked="checked"' }}@endif name="clear">Dégagée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->impregnable) && $dataTypeContent->impregnable){{ 'checked="checked"' }}@endif name="impregnable">Imprenable
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->panoramic) && $dataTypeContent->panoramic){{ 'checked="checked"' }}@endif name="panoramic">Panoramique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->courtyard) && $dataTypeContent->courtyard){{ 'checked="checked"' }}@endif name="courtyard">Sur cour
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_countryside) && $dataTypeContent->on_countryside){{ 'checked="checked"' }}@endif name="on_countryside">Sur la campagne
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_forest) && $dataTypeContent->on_forest){{ 'checked="checked"' }}@endif name="on_forest">Sur la forêt
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_sea) && $dataTypeContent->on_sea){{ 'checked="checked"' }}@endif name="on_sea">Sur la mer
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_pool) && $dataTypeContent->on_pool){{ 'checked="checked"' }}@endif name="on_pool">Sur la piscine
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_river) && $dataTypeContent->on_river){{ 'checked="checked"' }}@endif name="on_river">Sur la rivière
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_street) && $dataTypeContent->on_street){{ 'checked="checked"' }}@endif name="on_street">Sur la rue
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_city) && $dataTypeContent->on_city){{ 'checked="checked"' }}@endif name="on_city">Sur la ville
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_garden) && $dataTypeContent->on_garden){{ 'checked="checked"' }}@endif name="on_garden">Sur le jardin
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_lake) && $dataTypeContent->on_lake){{ 'checked="checked"' }}@endif name="on_lake">Sur le lac
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_park) && $dataTypeContent->on_park){{ 'checked="checked"' }}@endif name="on_park">Sur le parc
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_haven) && $dataTypeContent->on_haven){{ 'checked="checked"' }}@endif name="on_haven">Sur le port
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_hills) && $dataTypeContent->on_hills){{ 'checked="checked"' }}@endif name="on_hills">Sur les collines
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_mountains) && $dataTypeContent->on_mountains){{ 'checked="checked"' }}@endif name="on_mountains">Sur les montagnes
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->on_ski_slopes) && $dataTypeContent->on_ski_slopes){{ 'checked="checked"' }}@endif name="on_ski_slopes">Sur les piste de ski
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->vis_a_vis) && $dataTypeContent->vis_a_vis){{ 'checked="checked"' }}@endif name="vis_a_vis">Vis-à-vis
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Vue -->

                <!-- Eau Etat -->
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
                                        <h3 class="m-portlet__head-text">Etat</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Etat intérieur</label>
                                            <select class="form-control m-select2 custom_select2" name="interior_condition" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de construction</label>
                                            <select class="form-control m-select2 custom_select2" name="type_construction" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Construction::all() as $type_construction)
                                                    <option value="{{ $type_construction->reference }}" @if(isset($dataTypeContent->type_construction) && $dataTypeContent->type_construction == $type_construction->reference){{ 'selected="selected"' }}@endif>{{ $type_construction->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Etat de la façade</label>
                                            <select class="form-control m-select2 custom_select2" name="state_front" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Etat extérieur</label>
                                            <select class="form-control m-select2 custom_select2" name="external_state" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Année de construction</label>
                                            <div class="input-group date years_only">
                                                <input type="text" class="form-control m-input " readonly="" placeholder="Sélectionner la date" name="year_construction">
                                                <span class="input-group-addon">
													<i class="la la-calendar-check-o"></i>
												</span>
                                            </div>
                                            {{--<input type="date" name="year_construction">--}}
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Année de rénovation</label>
                                            <div class="input-group date years_only">
                                                <input type="text" class="form-control m-input " readonly="" placeholder="Sélectionner la date" name="year_renovation">
                                                <span class="input-group-addon">
													<i class="la la-calendar-check-o"></i>
												</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Etat -->

                <!-- Eau Exposition -->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet" data-portlet="true">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">Exposition</h3>
                                    </div>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <a href="#" data-portlet-tool="reload" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Reload"><i class="la la-refresh"></i></a>
                                        </li>
                                        <li class="m-portlet__nav-item">
                                            <a href="#" data-portlet-tool="toggle" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Collapse"><i class="la la-angle-down"></i></a>
                                        </li>
                                        <li class="m-portlet__nav-item">
                                            <a href="#" data-portlet-tool="fullscreen" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Fullscreen"><i class="la la-expand"></i></a>
                                        </li>
                                        <li class="m-portlet__nav-item">
                                            <a href="#" data-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon" title="" data-original-title="Remove"><i class="la la-close"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->nord) && $dataTypeContent->nord){{ 'checked="checked"' }}@endif name="nord">Nord
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->south) && $dataTypeContent->south){{ 'checked="checked"' }}@endif name="south">Sud
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->est) && $dataTypeContent->est){{ 'checked="checked"' }}@endif name="est">Est
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" @if(isset($dataTypeContent->west) && $dataTypeContent->west){{ 'checked="checked"' }}@endif name="west">Ouest
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Exposition -->

                <!-- Eau Exposition -->
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
                                        <h3 class="m-portlet__head-text">Gallery</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="row">
                                    <div class="col-lg-12 margin_bottom_10">
                                        <label>Gallery images dropzone</label>
                                        <div class="m-dropzone dropzone m-dropzone--success" id="m-dropzone-three"><!--action="inc/api/dropzone/upload.php" -->
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                @if(isset($dataTypeContent->image))
                                                    <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? Voyager::image($dataTypeContent->image) : $dataTypeContent->image }}" style="width:100%" />
                                                @endif
                                                    <input type="file" name="image[]" multiple="multiple">
                                                {{--<h3 class="m-dropzone__msg-title">--}}
                                                {{--Drop files here or click to upload.--}}
                                                {{--</h3>--}}
                                                {{--<span class="m-dropzone__msg-desc">--}}
                                                {{--Only image, pdf and psd files are allowed for upload--}}
                                                {{--</span>--}}
                                            </div>
                                        </div>
                                        {{--<div class="panel panel-bordered panel-primary">--}}
                                        {{--<div class="panel-heading">--}}
                                        {{--<h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager.post.image') }}</h3>--}}
                                        {{--<div class="panel-actions">--}}
                                        {{--<a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                        {{--<div class="panel-body">--}}
                                        {{--@if(isset($dataTypeContent->image))--}}
                                        {{--<img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />--}}
                                        {{--@endif--}}
                                        {{--<input type="file" name="image">--}}
                                        {{--</div>--}}
                                        {{--</div>--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Exposition -->


                <!-- Actions block -->
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="m-form__actions">
                        <div class="row">
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6 m--align-right">
                                <button type="submit" value="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Actions block -->
            </form>
            <!-- End Form -->
        </div>
    </div>
@stop

@section('javascript')
    <!--begin::Page Resources -->
    <script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Google Maps -->
    {{--<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfzuy0q5WLCVDU8E1LKj_wqdOFF_UKlDo&callback=initMap&libraries=places"></script>--}}
        <!-- Places -->
    {{--<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfzuy0q5WLCVDU8E1LKj_wqdOFF_UKlDo&libraries=places"></script>--}}
    <!--end::Google Maps -->

    {{--$('document').ready(function () {--}}
    {{--$('#slug').slugify();--}}

    {{--@if ($isModelTranslatable)--}}
    {{--$('.side-body').multilingual({"editing": true});--}}
    {{--@endif--}}
    {{--});--}}
    <script>
        $(".years_only").datepicker( {
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "yyyy",
            minViewMode: "years"
        });
        $('.date-type').datepicker( {
            format: "yyyy-mm-dd" // Notice the Extra space at the beginning
        });

        /* action for change announce type */
        $('input[name="ann_type"]').on("change", function(){
            if($(this).val() === 1) {
                $('.rent').attr('disabled', true);
            }
        });

//        $('a[cat_id]').click(function() {
//            var selectedTab = $(this).attr('cat_id');
//
//        console.log($('input[data]').attr('data').val() + 'бляхамуха');

        /* selects */
        $('a[cat_id]').click(function() {

            var selectedTab = $(this).attr('cat_id');
            $('input[name="category_id"]').attr('value',selectedTab);
//            console.log(selectedTab + 'sdgkl');
            var token = $('input[name="_token"]').val();

            /* repeating fields */
            var propTax = $('input[name="property_tax"]'),
                commercialProp = $('input[name="commercial_property"]'),
                floorProp = $('select[name="floor_property"]'),
                serviced = $('input[name="serviced"]'),
                removPartitions = $('input[name="removable_partitions"]'),
                hoist = $('input[name="hoist"]'),
                openPlan = $('input[name="open_plan"]'),
                loadingDock = $('input[name="loading_dock"]'),
                reception = $('input[name="reception"]'),
                collectiveLift = $('input[name="collective_lift"]'),
                comLaundryRoom = $('input[name="communal_laundry_room"]'),
                netCabling = $('input[name="network_cabling"]'),
                collectivopticFiber = $('input[name="collective_optical_fiber"]'),
                parable = $('input[name="parable"]'),
                stateFront = $('select[name="state_front"]');

            function addClassAndAttr (element) {
                element.attr('disabled',true);
                element.parent().parent().addClass('disabled_element');
            }
            function addClass (element) {
                element.parent().parent().addClass('disabled_element');
            }
            function addAttr (element) {
                element.attr('disabled',true);
            }

            switch (selectedTab) {
                case '1' :
                    addClassAndAttr(propTax);
                    addClassAndAttr(commercialProp);
                    addClassAndAttr($('input[name="number_floors_building"]'));
                    addAttr(floorProp);
                    floorProp.parent().addClass('disabled_element');
                    addClassAndAttr(serviced);
                    addClassAndAttr($('input[name="ppe_area"]'));
                    addClassAndAttr(removPartitions);
                    addClassAndAttr(hoist);
                    addClassAndAttr(openPlan);
                    addClassAndAttr(loadingDock);
                    addClassAndAttr(reception);
                    addClassAndAttr(collectiveLift);
                    addClassAndAttr(comLaundryRoom);
                    addClassAndAttr(netCabling);
                    addClassAndAttr(collectivopticFiber);
                    addClassAndAttr(parable);
                    addAttr(stateFront);
                    stateFront.parent().addClass('disabled_element');
                    break;
                case '2' :
                    addClassAndAttr(propTax);
                    break;
                case '3' :
                    console.log('case 3 selected');
                    break;
                case '4' :
                    console.log('case 4 selected');
                    break;
                case '5' :
                    console.log('case 5 selected');
                    break;
                case '6' :
                    console.log('case 6 selected');
                    break;
                case '7' :
                    console.log('case 7 selected');
                    break;
                case '8' :
                    console.log('case 8 selected');
                    break;
            }

            $.ajax({
                url: '{{ URL::to('/') }}' + '/admin/get-categories/'+selectedTab,
                type: 'post',
                data: {
                    '_token': token,
                    'category' : selectedTab
                },
                success : function (arr) {
                    $('div.sub_cat').html('');
                    $.each( arr, function( key, value ) {
                        $('div.sub_cat').append('' +
                            '<label class="m-radio btn btn-outline-brand">' +
                            '<input type="radio" name="sub_category" value="' + value.id +'">' + value.name +'' +
                            '<span></span>' +
                            '</label>');
                    });
                }

            });

        });

        $(function() {
            $('.bar_rating').barrating({
                theme: 'fontawesome-stars'
            });
        });

        // Places
        function initAutocomplete() {
            var map = new google.maps.Map(document.getElementById('map'), {
                center : {lat : 40.415363,lng : -3.707398},
                zoom: 7,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
//            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });

            var markers = [];
            // Listen for the event fired when the user selects a prediction and retrieve
            // more details for that place.
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(true);
                });
                markers = [];

                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }

    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfzuy0q5WLCVDU8E1LKj_wqdOFF_UKlDo&libraries=places&callback=initAutocomplete"
            async defer></script>

@stop
