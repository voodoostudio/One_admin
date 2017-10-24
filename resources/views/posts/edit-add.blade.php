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
            <form class="form-edit-add m-form" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
            {{--<form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">--}}
                @if(isset($dataTypeContent->id))
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}

                <!-- Radactation -->
                <div class="row">
                    <div class="col-lg-12">
                        <!--begin::Portlet-->
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                        <h3 class="m-portlet__head-text">Rédaction</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-4 margin_bottom_10">
                                                <label>Langue de l'annonce</label>
                                                <select class="form-control m-select2 his_select2" name="lng_of_add" data-placeholder="Select Language of the ad">
                                                    @foreach(TCG\Voyager\Models\Languages::all() as $lng_of_add)
                                                        <option value="{{ $lng_of_add->reference }}" @if(isset($dataTypeContent->lng_of_add) && $dataTypeContent->lng_of_add == $lng_of_add->reference){{ 'selected="selected"' }}@endif>{{ $lng_of_add->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-8 margin_bottom_10">
                                                <label class="">Titre de l'annonce</label>
                                                <input type="text" class="form-control m-input" placeholder="Ad Title" name="title" required="required">
                                            </div>
                                            <div class="col-lg-12 margin_bottom_10">
                                                <label>Description de l'annonce</label>
                                                <textarea class="form-control m-input" name="desc_add" rows="3"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-lg-12 margin_bottom_10">
                                                <label>Gallery images dropzone</label>
                                                <div class="m-dropzone dropzone m-dropzone--success" action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                                    <div class="m-dropzone__msg dz-message needsclick">
                                                        <h3 class="m-dropzone__msg-title">
                                                            Drop files here or click to upload.
                                                        </h3>
                                                        <span class="m-dropzone__msg-desc">
                                                            Only image, pdf and psd files are allowed for upload
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Portlet-->
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
                                            <label>Référence</label>
                                            <input type="email" class="form-control m-input" placeholder="Référence" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="reference">
                                            <span class="m-form__help">Please enter Référence</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Catégorie</label>
                                        <select class="form-control m-select2" name="category_id" data-placeholder="Select a Category">
                                            @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                @if($category->parent_id == null)
                                                    <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif> - {{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label for="m_select2_2">Sous-catégorie</label>
                                            <select class="form-control m-select2 his_select2" name="sub_category" data-placeholder="Select a sub-category">
                                                <option value=""></option>
                                                <option value="FR">House</option>
                                                <option value="MU">Apartment</option>
                                                <option value="US">Building</option>
                                                <option value="US">Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">Notation</label>
                                            <input type="number" class="form-control m-input" placeholder="Notation" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="notation">
                                            <span class="m-form__help">Please enter your notation</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Courtier</label>
                                            <select class="form-control m-select2 his_select2" name="broker" data-placeholder="Select a Courtier">
                                                <option value=""></option>
                                                <option value="FR">House</option>
                                                <option value="MU">Apartment</option>
                                                <option value="US">Building</option>
                                                <option value="US">Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Statut</label>
                                            <select class="form-control m-select2 his_select2" name="status_id" data-placeholder="Select a Statut">
                                                @foreach(TCG\Voyager\Models\Status::all() as $status)
                                                    <option value="{{ $status->reference }}" @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ 'selected="selected"' }}@endif>{{ $status->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Mandat</label>
                                            <select class="form-control m-select2 his_select2" name="mandate_id" data-placeholder="Select a Mandat">
                                                @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                                    <option value="{{ $mandate->reference }}" @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ 'selected="selected"' }}@endif>{{ $mandate->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Origine</label>
                                            <select class="form-control m-select2 his_select2" name="origin_id" data-placeholder="Select a Origine">
                                                @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                                    <option value="{{ $origin->reference }}" @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ 'selected="selected"' }}@endif>{{ $origin->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Début du mandat</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date" name="mandate_start"/>
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Fin du mandat</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date" name="term_end"/>
                                                <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Disponibilité</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date" name="availability"/>
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
                                                <input type="text" class="form-control m-input" name="availab_from" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" />
                                                <span class="input-group-addon">
                                                    <i class="la la-ellipsis-h"></i>
                                                </span>
                                                <input type="text" class="form-control" name="availab_until" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Note sur la transaction</label>
                                            <input type="email" class="form-control m-input" placeholder="Note sur la transaction" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="note_transaction">
                                            <span class="m-form__help">Please enter Note sur la transaction</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Note courtier</label>
                                            <input type="email" class="form-control m-input" placeholder="Note courtier" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="broker_notes">
                                            <span class="m-form__help">Please enter Note courtier</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Remarques importantes</label>
                                            <input type="email" class="form-control m-input" placeholder="Remarques importantes" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="important_notes">
                                            <span class="m-form__help">Please enter Remarques importantes</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Notes pour le propriétaire</label>
                                            <input type="email" class="form-control m-input" placeholder="Notes pour le propriétaire" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="owner_notes">
                                            <span class="m-form__help">Please enter Notes pour le propriétaire</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label class="">
                                                Promotion :
                                            </label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="promotion_radio" checked value="1">
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="promotion_radio" value="0">
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
                                                    <input type="radio" name="direct_transaction" checked value="1">
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="direct_transaction" value="0">
                                                    Non
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label></label>
                                            <label class="m-checkbox" style="display: block;">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="exclusiveness">
                                                Exclusivité
                                                <span></span>
                                            </label>
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
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Adresse</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your address" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="address">
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
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Rue</label>
                                        <input type="email" class="form-control m-input" placeholder="Street name" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="street">
                                        <span class="m-form__help">
                                            Please enter your street
                                        </span>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>N°</label>
                                        <input type="email" class="form-control m-input" placeholder="Number" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number">
                                        <span class="m-form__help">
                                            Please enter your number
                                        </span>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Case postale</label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-inbox"></i>
                                                </span>
                                            </span>
                                            <input type="number" class="form-control m-input" placeholder="" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="po_box">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your PO box
                                        </span>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Code postal</label>
                                        <input type="email" class="form-control m-input" placeholder="ZIP Code" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="zip_code">
                                        <span class="m-form__help">
                                            Please enter your ZIP Code
                                        </span>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Ville</label>
                                        <input type="email" class="form-control m-input" placeholder="Town" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="town">
                                        <span class="m-form__help">
                                            Please enter your town
                                        </span>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Pays</label>
                                        <select class="form-control m-select2 his_select2" name="country" data-placeholder="Select a Country">
                                            @foreach(TCG\Voyager\Models\Country::all() as $country)
                                                <option value="{{ $country->reference }}" @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ 'selected="selected"' }}@endif>{{ $country->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label>Localisation</label>
                                        <select class="form-control m-select2 his_select2" name="location" data-placeholder="Select Location">
                                            @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                <option value="{{ $location->reference }}" @if(isset($dataTypeContent->location) && $dataTypeContent->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-3 margin_bottom_10">
                                        <button type="button" class="btn btn-secondary">
                                            Place address on map
                                        </button>
                                    </div>


                                    {{--The following fields we are not displaying for now.--}}
                                    <div style="display: none">
                                        <div class="col-lg-2">
                                            <label>Longitude</label>
                                            <input type="number" class="form-control m-input" placeholder="Longitude" name="longitude">
                                        </div>
                                        <div class="col-lg-2">
                                            <label>Latitude</label>
                                            <input type="number" class="form-control m-input" placeholder="Longitude" name="latitude">
                                        </div>
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
                                            <label>Devise</label>
                                            <select class="form-control m-select2 his_select2" name="сurrency" data-placeholder="Select currency">
                                                @foreach(TCG\Voyager\Models\Currency::all() as $сurrency)
                                                    <option value="{{ $сurrency->reference }}" @if(isset($dataTypeContent->сurrency) && $dataTypeContent->сurrency == $сurrency->reference){{ 'selected="selected"' }}@endif>{{ $сurrency->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 margin_bottom_10">
                                        <div class="form-group">
                                            <label class="">Afficher le prix :</label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price" checked value="1">
                                                    Oui
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price" value="0">
                                                    Non
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>prix</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="price">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Prix au m<sup>2</sup></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="price_m2">
                                                <span class="input-group-addon">EUR/m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Rendement brut</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="gross_yield">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Rendement net</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="net_return">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant propriétaire</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="owner_amount">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Honoraire client</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="client_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Honoraire propriétaire</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="owner_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant négociable</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="negotiable_amount">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Montant estimé</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="estimate_price">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Droits d'enregistremenet</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="recording_rights">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Régime</label>
                                            <select class="form-control m-select2 his_select2" name="regime" data-placeholder="Select currency">
                                                @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                                    <option value="{{ $regime->reference }}" @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ 'selected="selected"' }}@endif>{{ $regime->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges de chauffage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="heating_loads">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges PPE</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ppe_charges">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges de copropriété</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="condominium_fees">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Taxe foncière</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="property_tax">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Fonds de rénovation</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="renovation_fund">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Charges annuelles</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="annual_charges">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Taxe d'habitation</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="taxes_1">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Caution locative</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="rental_security">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Fonds de commerce</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="commercial_property">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Revenus</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="earnings">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Impôts</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="taxes">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="procedure_in_progress">
                                                Procédure en cours auprès de la copro.
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
                                            <label>Nombre de chambres</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_rooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de pièces</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_pieces">
                                            </div>
                                        </div>
                                    </div>
                                    {{--The following fields we are not displaying for now.--}}
                                    <div class="col-lg-2" style="display: none">
                                        <div class="form-group">
                                            <label>Nombre de salles d'eau</label>
                                            <div class="input-group">
                                                <input type="number" readonly class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number__bathrooms">
                                            </div>
                                        </div>
                                    </div>
                                    {{--end--}}
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de balcons</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_balconies">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de salles de douche</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_shower_rooms">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de WC</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_toilets">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de terasses</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_terraces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre d'étage du bâtiment</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_floors_building">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Etage du bien</label>
                                            <select class="form-control m-select2 his_select2" name="floor_property" data-placeholder="Select Floor">
                                                @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)
                                                    <option value="{{ $floor_property->reference }}" @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ 'selected="selected"' }}@endif>{{ $floor_property->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Niveaux</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..."  value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="levels">
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

                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de la cave</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="surface_cellar">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Hauteur des plafonds</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ceiling_height">
                                                <span class="input-group-addon">m</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de l'abri de la toiture</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="roof_cover_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de la terrasse / solarium</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="surf_area_terr_solar">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de la véranda</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="area_veranda">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface des combles</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="attic_space">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface du balcon</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="surface_balcony">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface du sous-sol</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="basement_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface du terrain</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="surface_ground">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Terrain</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="Longeur" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ground_length" />
                                                <span class="input-group-addon">
                                                    <i class="la la-ellipsis-h"></i>
                                                </span>
                                                <input type="number" class="form-control" placeholder="Largeur" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ground_width" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Type de terrain</label>
                                            <select class="form-control m-select2 his_select2" name="type_land" data-placeholder="Select Floor">
                                                @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                                    <option value="{{ $type_land->reference }}" @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ 'selected="selected"' }}@endif>{{ $type_land->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface utille</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="useful_surface">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface PPE</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ppe_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Volume</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="volume">
                                                <span class="input-group-addon">m<sup>3</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de la cour anglaise</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="surface_eng_court">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface rez-de-chaussée inférieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="lower_ground_floor">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface de l'emprise</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="row_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface du garage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="garage_area">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Surface pondérée</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="weighted_surface">
                                                <span class="input-group-addon">m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox" style="margin-top: 30px">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="serviced">Viabilisé
                                                <span></span>
                                            </label>
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
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="box_interior_garage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage double intérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="box_gar_inter_doub">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage extérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="outdoor_garage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Box/garage double extérieur</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="box_garage_outside_double">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place de parc extérieure couverte</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="covered_outdoor_parking_space">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place de parc extérieur non-couverte</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="outside_parking_space_uncovered">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Nombre de places de parc</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number_parking_spaces">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Hangar à bateau</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="boat_shed">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Place d'amarrage</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="mooring">
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
                                            <select class="form-control m-select2 his_select2" name="type" data-placeholder="Select Type">
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
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="freezer">Congélateur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="cooker">Cusinière
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="oven">Four
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="microwave_oven">Four à micro-ondes
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="extractor_hood">Hotte aspirante
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="washmachine">Lave-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="dishwasher">Lave-vaiselle
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="plates">Plaques à gaz
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="induction_plates">Plaques à induction
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="hotplates">Plaques électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ceramic_plates">Plaques vitrocéram
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="fridge">Réfrigérateur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="cuisine_tumble_drier">Sèche-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="coffee_maker">Cafetière
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
                                            <select class="form-control m-select2 his_select2" name="format" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Heating::all() as $format)
                                                    <option value="{{ $format->reference }}" @if(isset($dataTypeContent->format) && $dataTypeContent->format == $format->reference){{ 'selected="selected"' }}@endif>{{ $format->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Energie</label>
                                            <select class="form-control m-select2 his_select2" name="chauffage_energy" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Energy::all() as $chauffage_energy)
                                                    <option value="{{ $chauffage_energy->reference }}" @if(isset($dataTypeContent->chauffage_energy) && $dataTypeContent->chauffage_energy == $chauffage_energy->reference){{ 'selected="selected"' }}@endif>{{ $chauffage_energy->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de chauffage</label>
                                            <select class="form-control m-select2 his_select2" name="type_heating" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\HeatingType::all() as $type_heating)
                                                    <option value="{{ $type_heating->reference }}" @if(isset($dataTypeContent->type_heating) && $dataTypeContent->type_heating == $type_heating->reference){{ 'selected="selected"' }}@endif>{{ $type_heating->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de radiateur</label>
                                            <select class="form-control m-select2 his_select2" name="type_radiator" data-placeholder="Select Type">
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
                                            <select class="form-control m-select2 his_select2" name="distribution" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\WaterDistribution::all() as $distribution)
                                                    <option value="{{ $distribution->reference }}" @if(isset($dataTypeContent->distribution) && $dataTypeContent->distribution == $distribution->reference){{ 'selected="selected"' }}@endif>{{ $distribution->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Energie</label>
                                            <select class="form-control m-select2 his_select2" name="eau_chaude_energy" data-placeholder="Select Type">
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
                                            <select class="form-control m-select2 his_select2" name="usees_distribution" data-placeholder="Select Type">
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
                                            <select class="form-control m-select2 his_select2" name="divers_format" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Minergie::all() as $divers_format)
                                                    <option value="{{ $divers_format->reference }}" @if(isset($dataTypeContent->divers_format) && $dataTypeContent->divers_format == $divers_format->reference){{ 'selected="selected"' }}@endif>{{ $divers_format->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Sonorité</label>
                                            <select class="form-control m-select2 his_select2" name="sonority" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Sonority::all() as $sonority)
                                                    <option value="{{ $sonority->reference }}" @if(isset($dataTypeContent->sonority) && $dataTypeContent->sonority == $sonority->reference){{ 'selected="selected"' }}@endif>{{ $sonority->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Style</label>
                                            <select class="form-control m-select2 his_select2" name="style" data-placeholder="Select Type">
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
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="shelter">Abri
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="access_disabled">Accès pour handicapé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="water_softener">Adoucisseur d'eau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="air_conditioning">Air conditionné
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="pets_welcome">Animaux bienvenus
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="fitted_wardrobes">Armoires encastrées
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="private_lift">Ascenseur privé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="central_aspiration">Aspiration centralisée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="workshop">Atelier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="patch_panel">Baie de brassage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="windows">Baies vitrées
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="bath">Baignoire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="balneo_bath">Baignoire balnéo
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="private_laundry_room">Buanderie privée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="cafeteria">Cafétéria
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="carnotzet">Carnotzet
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="cave">Cave
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="wine_cellar">Cave à vin
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="cellar">Cellier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="fireplace">Cheminée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="air_conditioner">Climatisation
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="removable_partitions">Cloisons amovibles
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="addiction">Dépendance
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="automation">Domotique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="double_glazing">Double vitrage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="shower">Douche
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="dressing">Dressing
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="automatic_fire_extinguisher">Extincteur automatique à eau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="false_ceiling">Faux plafond
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="optical_fiber">Fibre optique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="attic">Grenier
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="generator">Groupe électrogène
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="hammam">Hammam
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="high_internet">Internet Haut Débit
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="jacuzzi">Jacuzzi
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="winter_garden">Jardin d'hiver
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ski_locker">Local à ski
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="bicycle_storage">Local à velo
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="loggia">Loggia
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="net">Monstiquaire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="hoist">Monte-charge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="open_plan">Open-space
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="outdoor_pool">Piscine extérieure
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="indoor_pool">Piscine intérieure
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="ceramic_stove">Poêle en céramique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="swedish_stove">Poêle suédois
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="loading_dock">Quai de déchargement
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="connection_chimney">Raccordement pour cheminée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="connection_swedish_stove">Raccordement pour poêle suédois
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="reception">Réception
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="metallic_curtain">Rideau métallique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="armed_with_fire_tap">Robinet d'incendie armé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="do_it_yourself_room">Salle de bricolage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="theater">Salle de cinéma
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="game_room">Salle de jeux
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="fitness_room">Salle fitness
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="conference_room">Salle de conférence
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="satellite">Satellite
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="sauna">Sauna
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="subsoil">Sous-sol
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="blinds">Stores
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="electric_blinds">Stores électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="thermostat_connected">Thermostat connecté
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="triple_glazing">Triple vitrage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="veranda">Véranda
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="crawlspace">Vide sanitaire
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="electric_shutters">Volets roulants électriques
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="tumble_drier">Sèche-linge
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="hair_dryer">Sèche-cheveux
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="satellite_tv">TV Satellite
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="phone">Téléphone
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Equipement extérieur -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="car_shelter">Abri de voiture
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="spray">Arrosage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="barbecue">Barbecue
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="exterior_lighting">Eclairage extérieur
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="drilling">Forage
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="heliport">Héliport
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="well">Puits
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="source">Source
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>

                                    <!-- Immeuble -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="collective_lift">Ascenseur collectif
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="communal_laundry_room">Buanderie collective
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="network_cabling">Câblage réseau
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="collective_optical_fiber">Fibre optique collective
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="parable">Parabole
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>


                                    <!-- Sécurité -->
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="alarm">Alamre
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="magnetic_card">Carte magnétique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="fenced">Clôturé
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="safe">Coffre-fort
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="digidode">DigiCode
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="guardian">Gardien
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="caretaker">Gardien d'immeuble
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="intercom">Interphone
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="electric_gate">Portail électrique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="reinforced_door">Porte blindée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="videophone">Vidéophone
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
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="clear">Dégagée
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="impregnable">Imprenable
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="panoramic">Panoramique
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="courtyard">Sur cour
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_countryside">Sur la campagne
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_forest">Sur la forêt
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_sea">Sur la mer
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_pool">Sur la piscine
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_river">Sur la rivière
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_street">Sur la rue
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_city">Sur la ville
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_garden">Sur le jardin
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_lake">Sur le lac
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_park">Sur le parc
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_haven">Sur le port
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_hills">Sur les collines
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_mountains">Sur les montagnes
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="on_ski_slopes">Sur les piste de ski
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="vis_a_vis">Vis-à-vis
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
                                            <select class="form-control m-select2 his_select2" name="interior_condition" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Type de construction</label>
                                            <select class="form-control m-select2 his_select2" name="type_construction" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\Construction::all() as $type_construction)
                                                    <option value="{{ $type_construction->reference }}" @if(isset($dataTypeContent->type_construction) && $dataTypeContent->type_construction == $type_construction->reference){{ 'selected="selected"' }}@endif>{{ $type_construction->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Etat de la façade</label>
                                            <select class="form-control m-select2 his_select2" name="state_front" data-placeholder="Select Type">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-group">
                                            <label>Etat extérieur</label>
                                            <select class="form-control m-select2 his_select2" name="external_state" data-placeholder="Select Type">
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
                                                <input type="text" class="form-control m-input " readonly="" placeholder="Select date" name="year_construction">
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
                                                <input type="text" class="form-control m-input " readonly="" placeholder="Select date" name="year_renovation">
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
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                        <span class="m-portlet__head-icon m--hide">
                                            <i class="la la-gear"></i>
                                        </span>
                                        <h3 class="m-portlet__head-text">Exposition</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="nord">Nord
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="south">Sud
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="est">Est
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="west">Ouest
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
    <!--end::Page Resources -->

    {{--$('document').ready(function () {--}}
    {{--$('#slug').slugify();--}}

    {{--@if ($isModelTranslatable)--}}
    {{--$('.side-body').multilingual({"editing": true});--}}
    {{--@endif--}}
    {{--});--}}
    <script>
        $(".years_only").datepicker( {
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });
    </script>
@stop
