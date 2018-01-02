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
            <form id="edit_create_form" class="form-edit-add m-form m-form--group-seperator-dashed" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
                @if(isset($dataTypeContent->id))
                    {{ method_field("PUT") }}
                @endif
                {{ csrf_field() }}
                <input type="hidden" name="vip_users[]" value="{{(isset($dataTypeContent->id)) ? $dataTypeContent->vip_users : 0 }}">
                <p style="display: none;" data="{{ $dataTypeContent->id }}"></p> <!-- p for trigger event on categories tab, on edit object page -->

                <div class="main_tabs_container">
                    <ul class="nav nav-tabs  m-tabs-line m-tabs-line--primary" id="main_tabs_nav" role="tablist">
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#redaction_tab" role="tab" aria-expanded="true">Redaction</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#general_tab" role="tab" aria-expanded="false">Général</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#address_tab" role="tab" aria-expanded="false">Adresse</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#price_tab" role="tab" aria-expanded="false">Prix</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#layout_tab" role="tab" aria-expanded="false">Agencement</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#surface_tab" role="tab" aria-expanded="false">Surface</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#parking_tab" role="tab" aria-expanded="false">Stationnement</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#kitchen_tab" role="tab" aria-expanded="false">Cuisine</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#heating_tab" role="tab" aria-expanded="false">Chauffage</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#water_tab" role="tab" aria-expanded="false">Eaux</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#conveniences_tab" role="tab" aria-expanded="false">Commodités</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#view_tab" role="tab" aria-expanded="false">Vue</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#state_tab" role="tab" aria-expanded="false">Etat</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#exposition_tab" role="tab" aria-expanded="false">Exposition</a>
                        </li>
                        <li class="nav-item m-tabs__item">
                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#gallery_tab" role="tab" aria-expanded="false">Galeries</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="main_tabs">
                        <div class="tab-pane active" id="redaction_tab" role="tabpanel">
                            <!-- Radactation -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="m-portlet m-portlet--tabs">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
                                                    <h3 class="m-portlet__head-text">Rédaction</h3>
                                                </div>
                                            </div>
                                            <div class="m-portlet__head-tools">
                                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--right m-tabs-line-danger">
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
                                                                    <input type="radio" class="announce_type" name="ann_type" value="1" {{ ($dataTypeContent->ann_type == 1) ? 'checked' : '' }}>
                                                                    Vente
                                                                    <span></span>
                                                                </label>
                                                                <label class="m-radio m-radio--solid">
                                                                    <input type="radio" class="announce_type" name="ann_type" value="0" {{ ($dataTypeContent->ann_type == 0) ? 'checked' : '' }}>
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
                                                            <div class="col-12 margin_bottom_10 lang-fr form-group">
                                                                <label class="form-control-label" for="titleFr">Titre de l'annonce FR</label>
                                                                <input id="titleFr" type="text" value="{{ $dataTypeContent->title_fr }}" class="form-control m-input" placeholder="Titre de l'annonce" name="title_fr" required="required">
                                                            </div>
                                                            <div class="col-12 margin_bottom_10 lang-fr">
                                                                <label for="desc-fr">Description de l'annonce FR</label>
                                                                <textarea id="desc-fr" class="form-control m-input" name="desc_add_fr" rows="8">@if(isset($dataTypeContent->desc_add_fr)){{ $dataTypeContent->desc_add_fr }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="en_redaction" role="tabpanel" aria-expanded="false">
                                                        <div class="row">
                                                            <div class="col-12 margin_bottom_10 lang-en form-group">
                                                                <label>Titre de l'annonce EN</label>
                                                                <input type="text" value="{{ $dataTypeContent->title_en }}" class="form-control m-input" placeholder="Titre de l'annonce" name="title_en" required="required">
                                                            </div>
                                                            <div class="col-12 margin_bottom_10 lang-en">
                                                                <label>Description de l'annonce EN</label>
                                                                <textarea class="form-control m-input" name="desc_add_en" rows="8">@if(isset($dataTypeContent->desc_add_en)){{ $dataTypeContent->desc_add_en }}@endif</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="es_redaction" role="tabpanel" aria-expanded="false">
                                                        <div class="row">
                                                            <div class="col-12 margin_bottom_10 lang-es form-group">
                                                                <label>Titre de l'annonce ES</label>
                                                                <input type="text" value="{{ $dataTypeContent->title_es }}" class="form-control m-input" placeholder="Titre de l'annonce" name="title_es" required="required">
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
                                </div>
                            </div>
                            <!-- End Radactation -->
                        </div>
                        <div class="tab-pane" id="general_tab" role="tabpanel">
                            <!-- General -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <!--begin::Portlet-->
                                    <div class="m-portlet">
                                        <div class="m-portlet__head">
                                            <div class="m-portlet__head-caption">
                                                <div class="m-portlet__head-title">
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
                                                        <select class="form-control m-select2 custom_select2" name="broker" data-placeholder="Sélectionner un courtier">
                                                            @foreach(TCG\Voyager\Models\User::where('role_id','<>','5')->get(['id','role_id','name']) as $user)
                                                                <option value="{{ $user->id }}">{{  $user->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    foreach (explode(',', Illuminate\Support\Facades\DB::table('posts')->value('vip_users')) as $users) {
                                                        $user_id[$users] = $users;
                                                    }
                                                @endphp
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-12">
                                                    <ul id="categories_ul" class="nav nav-tabs  m-tabs-line" role="tablist">
                                                        @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                            @if($category->parent_id == null)
                                                                <li class="nav-item m-tabs__item">
                                                                    <a class="nav-link m-tabs__link @if(isset($dataTypeContent->id)){{ ($dataTypeContent->category_id == $category->id) ? 'active' : '' }} @else {{ ($category->id == 1) ? 'active' : '' }} @endif" cat_id="{{ $category->id }}" data-toggle="tab" href="#category_{{ $category->id }}" role="tab" aria-expanded="false">{{ $category->name }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                                        <input name="category_id" type="hidden">
                                                    </ul>

                                                    <div class="tab-content">
                                                        @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                            @if($category->parent_id == null)
                                                                <div class="tab-pane @if(isset($dataTypeContent->id)){{ ($dataTypeContent->category_id == $category->id) ? 'active' : '' }} @else {{ ($category->id == 1) ? 'active' : '' }} @endif"  id="category_{{ $category->id }}" role="tabpanel" aria-expanded="{{ ($category->id == 1) ? 'true' : 'false' }}">
                                                                    <div class="form-group">
                                                                        <div class="m-radio-inline sub_cat">
                                                                            @foreach(TCG\Voyager\Models\Category::where('parent_id', $category->id)->get() as $sub_category)
                                                                                <div class="label_container">
                                                                                    <label class="m-radio btn btn-outline-brand">
                                                                                        <input type="radio" name="sub_category" value="{{ $sub_category->id }}" {{ ($dataTypeContent->sub_category == $sub_category->id) ? 'checked' : '' }}><span class="sub_cat_title">{{ $sub_category->name }}</span>
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                @if($dataTypeContent->id != null)
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label>Référence</label>
                                                            {{--<input type="number" class="form-control m-input" readonly placeholder="Référence" value="@if(isset($dataTypeContent->reference)){{ $dataTypeContent->reference }}@endif" name="reference">--}}
                                                            @if(isset($dataTypeContent->id))
                                                                <p>{{  'HIS-' . str_pad($dataTypeContent->id , 4, '0', STR_PAD_LEFT) }}</p>                                                        @endif
                                                            <span class="m-form__help">Please enter Référence</span>
                                                        </div>
                                                    </div>
                                                @endif
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
                                                            <input type='text' class="form-control m-input date-type" value="@if(isset($dataTypeContent->mandate_start)){{ date("d.m.Y", strtotime($dataTypeContent->mandate_start)) }}@endif" readonly  placeholder="Sélectionner la date" name="mandate_start"/>
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
                                                            <input type='text' class="form-control m-input date-type" value="@if(isset($dataTypeContent->term_end)){{ date("d.m.Y", strtotime($dataTypeContent->term_end)) }}@endif" readonly  placeholder="Sélectionner la date" name="term_end"/>
                                                            <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Disponibilité</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input type='text' class="form-control m-input date-type rent for-type" value="@if(isset($dataTypeContent->availability)){{ date("d.m.Y", strtotime($dataTypeContent->availability)) }}@endif" readonly  placeholder="Sélectionner la date" name="availability"/>
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
                                                            <input type="text" class="form-control m-input date-type locat for-type" name="availab_from" value="@if(isset($dataTypeContent->availab_from)){{ date("d.m.Y", strtotime($dataTypeContent->availab_from)) }}@endif" />
                                                            <span class="input-group-addon">
                                                        <i class="la la-ellipsis-h"></i>
                                                    </span>
                                                            <input type="text" class="form-control date-type locat for-type" name="availab_until" value="@if(isset($dataTypeContent->availab_until)){{ date("d.m.Y", strtotime($dataTypeContent->availab_until)) }}@endif" />
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
                                                            @if(isset($dataTypeContent->id))
                                                                <input value="{{ $dataTypeContent->exclusiveness }}" type="checkbox" {{ ($dataTypeContent->exclusiveness == 1) ? 'checked' : '' }} name="exclusiveness">
                                                            @else
                                                                <input value="1" checked type="checkbox" name="exclusiveness">
                                                            @endif
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="">Notation</label>
                                                        <select class="bar_rating" name="notation">
                                                            <option value="1" @if(isset($dataTypeContent->notation) && $dataTypeContent->notation == '1'){{ 'selected="selected"' }}@endif>1</option>
                                                            <option value="2" @if(isset($dataTypeContent->notation) && $dataTypeContent->notation == '2'){{ 'selected="selected"' }}@endif>2</option>
                                                            <option value="3" @if(isset($dataTypeContent->notation) && $dataTypeContent->notation == '3'){{ 'selected="selected"' }}@endif>3</option>
                                                            <option value="4" @if(isset($dataTypeContent->notation) && $dataTypeContent->notation == '4'){{ 'selected="selected"' }}@endif>4</option>
                                                            <option value="5" @if(isset($dataTypeContent->notation) && $dataTypeContent->notation == '5'){{ 'selected="selected"' }}@endif>5</option>
                                                        </select>
                                                        {{--<input type="number" class="form-control m-input" placeholder="Notation" value="@if(isset($dataTypeContent->notation)){{ $dataTypeContent->notation }}@endif" name="notation">--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Note sur la transaction</label>
                                                        <textarea name="note_transaction" class="form-control m-input" placeholder="Note sur la transaction" rows="8" maxlength="255">{{ ($dataTypeContent->note_transaction) ? $dataTypeContent->note_transaction : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Note courtier</label>
                                                        <textarea name="broker_notes" class="form-control m-input" placeholder="Note courtier" rows="8" maxlength="255">{{ ($dataTypeContent->broker_notes) ? $dataTypeContent->broker_notes : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Remarques importantes</label>
                                                        <textarea name="important_notes" class="form-control m-input" placeholder="Remarques importantes" rows="8" maxlength="255">{{ ($dataTypeContent->important_notes) ? $dataTypeContent->important_notes : '' }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Notes pour le propriétaire</label>
                                                        <textarea name="owner_notes" class="form-control m-input" placeholder="Notes pour le propriétaire" rows="8" maxlength="255">{{ ($dataTypeContent->owner_notes) ? $dataTypeContent->owner_notes : '' }}</textarea>
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
                        </div>
                        <div class="tab-pane" id="address_tab" role="tabpanel">
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
                                                <div class="col-lg-8">
                                                    <label>Adresse</label>
                                                    <div class="m-input-icon m-input-icon--right">
                                                        {{--<input type="text" id="pac-input" class="form-control m-input" placeholder="Entrer votre adresse" value="@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif" name="address">--}}
                                                        <input type="text" id="autocomplete" class="form-control m-input" name="address" placeholder="Entrer votre adresse" onFocus="geolocate()" value="@if(isset($dataTypeContent->address)){{ $dataTypeContent->address }}@endif"></input>
                                                        <span class="m-input-icon__icon m-input-icon__icon--right">
                                                    <span>
                                                        <i class="la la-map-marker"></i>
                                                    </span>
                                                </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <button type="button" id="open_map_btn" class="btn btn-secondary" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 24px; width: 100%;">Placer l’adresse sur la carte</button>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-3 margin_bottom_10">
                                                    <label>Rue</label>
                                                    <input type="text" id="route" readonly="readonly" class="form-control m-input" placeholder="Rue" value="@if(isset($dataTypeContent->street)){{ $dataTypeContent->street }}@endif" name="street">
                                                </div>
                                                <div class="col-lg-2 margin_bottom_10">
                                                    <label>N°</label>
                                                    <input type="text" id="street_number" readonly="readonly" class="form-control m-input" placeholder="N°" value="@if(isset($dataTypeContent->number)){{ $dataTypeContent->number }}@endif" name="number">
                                                </div>
                                                <div class="col-lg-2 margin_bottom_10">
                                                    <label>CP</label>
                                                    <input type="number" min="0" class="form-control m-input" placeholder="CP" value="@if(isset($dataTypeContent->po_box)){{ $dataTypeContent->po_box }}@endif" name="po_box">
                                                </div>
                                                <div class="col-lg-2 margin_bottom_10">
                                                    <label>NPA</label>
                                                    <input type="text" id="postal_code" readonly="readonly" class="form-control m-input" placeholder="NPA" value="@if(isset($dataTypeContent->zip_code)){{ $dataTypeContent->zip_code }}@endif" name="zip_code">
                                                </div>
                                                <div class="col-lg-3 margin_bottom_10">
                                                    <label>Ville</label>
                                                    <input type="text" id="locality" readonly="readonly" class="form-control m-input" placeholder="Ville" value="@if(isset($dataTypeContent->town)){{ $dataTypeContent->town }}@endif" name="town">
                                                </div>
                                                <div class="col-lg-3 margin_bottom_10">
                                                    <label>Pays</label>
                                                    <input type="text" id="country" readonly="readonly" class="form-control m-input" placeholder="Pays" value="@if(isset($dataTypeContent->country)){{ $dataTypeContent->country }}@endif" name="country">
                                                    {{--<select class="form-control m-select2 custom_select2" name="country" data-placeholder="Select a Country">--}}
                                                    {{--@foreach(TCG\Voyager\Models\Country::all() as $country)--}}
                                                    {{--<option value="{{ $country->reference }}" @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ 'selected="selected"' }}@endif>{{ $country->value }}</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Longitude</label>
                                                    <input disabled="disabled" type="number" min="0" id="longitude" class="form-control m-input" placeholder="Longitude" name="longitude">
                                                </div>
                                                <div class="col-lg-3">
                                                    <label>Latitude</label>
                                                    <input disabled="disabled" type="number" min="0" id="latitude" class="form-control m-input" placeholder="Longitude" name="latitude">
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
                        </div>
                        <div class="tab-pane" id="price_tab" role="tabpanel">
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
                                        <div class="form-group m-portlet__body">
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
                                            <div class="m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Prix</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->price)){{ $dataTypeContent->price }}@endif" name="price">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Prix au m<sup>2</sup></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->price_m2)){{ $dataTypeContent->price_m2 }}@endif" name="price_m2">
                                                            <span class="input-group-addon"><span class="currency">CHF</span>/m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Rendement brut</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->gross_yield)){{ $dataTypeContent->gross_yield }}@endif" name="gross_yield">
                                                            <span class="input-group-addon">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Rendement net</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->net_return)){{ $dataTypeContent->net_return }}@endif" name="net_return">
                                                            <span class="input-group-addon">%</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Montant négociable <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="Simulation du prix de vente possible honoraires inclus - ou - simulation du prix de location honoraires exclus" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->negotiable_amount)){{ $dataTypeContent->negotiable_amount }}@endif" name="negotiable_amount">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Montant estimé <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="A titre indicatif le prix estimé pour vos avis de valeur" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->estimate_price)){{ $dataTypeContent->estimate_price }}@endif" name="estimate_price">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Montant propriétaire <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="Dans le cadre d'une vente : somme des honoraires à charge du vendeur. Dans le cadre d'une location : honoraires pour l'entrée du locataire" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->owner_amount)){{ $dataTypeContent->owner_amount }}@endif" name="owner_amount">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Honoraire client <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="Dans le cadre d'une vente : somme des honoraires à charge du client acheteur. Dans le cadre d'une location : constitution du dossier, visite et rédaction du contrat" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->client_fees)){{ $dataTypeContent->client_fees }}@endif" name="client_fees">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Honoraire propriétaire <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="Dans le cadre d'une vente : somme des honoraires à charge du vendeur. Dans le cadre d'une location : honoraires pour l'entrée du locataire" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->owner_fees)){{ $dataTypeContent->owner_fees }}@endif" name="owner_fees">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Droits d’enregistrement <a tabindex="0" class="tooltip_btn" role="button" data-toggle="m-popover" data-placement="top" data-trigger="hover" title="" data-content="Simulation des frais de notaire et des droits de mutation" data-original-title=""><i class="la la-question-circle"></i></a></label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->recording_rights)){{ $dataTypeContent->recording_rights }}@endif" name="recording_rights">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Charges de chauffage</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->heating_loads)){{ $dataTypeContent->heating_loads }}@endif" name="heating_loads">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Charges PPE</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->ppe_charges)){{ $dataTypeContent->ppe_charges }}@endif" name="ppe_charges">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Charges de copropriété</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->condominium_fees)){{ $dataTypeContent->condominium_fees }}@endif" name="condominium_fees">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Charges annuelles</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->annual_charges)){{ $dataTypeContent->annual_charges }}@endif" name="annual_charges">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Taxe d'habitation</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->taxes_1)){{ $dataTypeContent->taxes_1 }}@endif" name="taxes_1">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Taxe foncière</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->property_tax)){{ $dataTypeContent->property_tax }}@endif" name="property_tax">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Caution locative</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->rental_security)){{ $dataTypeContent->rental_security }}@endif" name="rental_security">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Fonds de rénovation</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->renovation_fund)){{ $dataTypeContent->renovation_fund }}@endif" name="renovation_fund">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Revenus</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->earnings)){{ $dataTypeContent->earnings }}@endif" name="earnings">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Impôts</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->taxes)){{ $dataTypeContent->taxes }}@endif" name="taxes">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Fonds de commerce</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input disabled_element elem-categories" placeholder="..." value="@if(isset($dataTypeContent->commercial_property)){{ $dataTypeContent->commercial_property }}@endif" name="commercial_property">
                                                            <span class="input-group-addon"><span class="currency">CHF</span></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="">
                                                        <label>Régime</label>
                                                        <select class="form-control m-select2 custom_select2" name="regime" data-placeholder="Select currency">
                                                            @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                                                <option value="{{ $regime->reference }}" @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ 'selected="selected"' }}@endif>{{ $regime->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="">
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
                        </div>
                        <div class="tab-pane" id="layout_tab" role="tabpanel">
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
                                            <div class="m-form__group row">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de pièces</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_pieces)){{ $dataTypeContent->number_pieces }}@endif" name="number_pieces">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de chambres</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_rooms)){{ $dataTypeContent->number_rooms }}@endif" name="number_rooms">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de salles de douche</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_shower_rooms)){{ $dataTypeContent->number_shower_rooms }}@endif" name="number_shower_rooms">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de WC</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_toilets)){{ $dataTypeContent->number_toilets }}@endif" name="number_toilets">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de salles d'eau</label>
                                                        <div class="input-group summ">
                                                            <input type="number" min="0" disabled="disabled" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->number__bathrooms)){{ $dataTypeContent->number__bathrooms }}@endif" name="number__bathrooms">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Niveaux</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..."  value="@if(isset($dataTypeContent->levels)){{ $dataTypeContent->levels }}@endif" name="levels">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de terasses</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_terraces)){{ $dataTypeContent->number_terraces }}@endif" name="number_terraces">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb de balcons</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_balconies)){{ $dataTypeContent->number_balconies }}@endif" name="number_balconies">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="">
                                                        <label>Etage du bien</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="floor_property" data-placeholder="Select Floor">
                                                        @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)    <!-- todo  orderBy('value','ASC')->get() as $floor_property)  if need return -->
                                                            <option value="{{ $floor_property->reference }}" @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ 'selected="selected"' }}@endif>{{ $floor_property->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label>Nb d'étage du bâtiment</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->number_floors_building)){{ $dataTypeContent->number_floors_building }}@endif" name="number_floors_building">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="">
                                                        <label>Style</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="style" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Style::orderBy('value','ASC')->get() as $style)
                                                                <option value="{{ $style->reference }}" @if(isset($dataTypeContent->style) && $dataTypeContent->style == $style->reference){{ 'selected="selected"' }}@endif>{{ $style->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="">
                                                        <label>Minergie</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="divers_format" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Minergie::all() as $divers_format)
                                                                <option value="{{ $divers_format->reference }}" @if(isset($dataTypeContent->divers_format) && $dataTypeContent->divers_format == $divers_format->reference){{ 'selected="selected"' }}@endif>{{ $divers_format->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="">
                                                        <label>Sonorité</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="sonority" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Sonority::orderBy('value','ASC')->get() as $sonority)
                                                                <option value="{{ $sonority->reference }}" @if(isset($dataTypeContent->sonority) && $dataTypeContent->sonority == $sonority->reference){{ 'selected="selected"' }}@endif>{{ $sonority->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Agencement -->
                        </div>
                        <div class="tab-pane" id="surface_tab" role="tabpanel">
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
                                            <div class="m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface rez-de-chaussée inférieur</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->lower_ground_floor)){{ $dataTypeContent->lower_ground_floor }}@endif" name="lower_ground_floor">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->lower_ground_floor_child)){{ $dataTypeContent->lower_ground_floor_child }}@endif" name="lower_ground_floor_child"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface des combles</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->attic_space)){{ $dataTypeContent->attic_space }}@endif" name="attic_space">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->attic_space_child)){{ $dataTypeContent->attic_space_child }}@endif" name="attic_space_child"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface du balcon</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->surface_balcony)){{ $dataTypeContent->surface_balcony }}@endif" name="surface_balcony">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->surface_balcony_child)){{ $dataTypeContent->surface_balcony_child }}@endif" name="surface_balcony_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface du sous-sol</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->basement_area)){{ $dataTypeContent->basement_area }}@endif" name="basement_area">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->basement_area_child)){{ $dataTypeContent->basement_area_child }}@endif" name="basement_area_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de la cave</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->surface_cellar)){{ $dataTypeContent->surface_cellar }}@endif" name="surface_cellar">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->surface_cellar_child)){{ $dataTypeContent->surface_cellar_child }}@endif" name="surface_cellar_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de la terrasse solarium</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->surf_area_terr_solar)){{ $dataTypeContent->surf_area_terr_solar }}@endif" name="surf_area_terr_solar">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->surf_area_terr_solar_child)){{ $dataTypeContent->surf_area_terr_solar_child }}@endif" name="surf_area_terr_solar_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de l'abri de la toiture</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->roof_cover_area)){{ $dataTypeContent->roof_cover_area }}@endif" name="roof_cover_area">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->roof_cover_area_child)){{ $dataTypeContent->roof_cover_area_child }}@endif" name="roof_cover_area_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de la véranda</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->area_veranda)){{ $dataTypeContent->area_veranda }}@endif" name="area_veranda">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" value="@if(isset($dataTypeContent->area_veranda_child)){{ $dataTypeContent->area_veranda_child }}@endif" name="area_veranda_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de la cour anglaise</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->surface_eng_court)){{ $dataTypeContent->surface_eng_court }}@endif" name="surface_eng_court">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" step="any" min="0" class="form-control custom_input_for_coefficient elem-categories" placeholder="" value="@if(isset($dataTypeContent->surface_eng_court_child)){{ $dataTypeContent->surface_eng_court_child }}@endif" name="surface_eng_court_child" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface pondérée</label>
                                                        <div class="input-group summ">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" readonly  disabled="disabled" placeholder="Total" value="@if(isset($dataTypeContent->weighted_surface)){{ $dataTypeContent->weighted_surface }}@endif" name="weighted_surface">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface PPE</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->ppe_area)){{ $dataTypeContent->ppe_area }}@endif" name="ppe_area">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface utille</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->useful_surface)){{ $dataTypeContent->useful_surface }}@endif" name="useful_surface">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface du garage</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->garage_area)){{ $dataTypeContent->garage_area }}@endif" name="garage_area">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Surface de l'emprise</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->row_area)){{ $dataTypeContent->row_area }}@endif" name="row_area">
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Volume</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->volume)){{ $dataTypeContent->volume }}@endif" name="volume">
                                                            <span class="input-group-addon">m<sup>3</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Hauteur des plafonds</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->ceiling_height)){{ $dataTypeContent->ceiling_height }}@endif" name="ceiling_height">
                                                            <span class="input-group-addon">m</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Terrain</label>
                                                        <div class="input-group multiplication">
                                                            <input type="number" min="0" class="form-control m-input elem-categories multiplier" placeholder="Longeur" value="@if(isset($dataTypeContent->ground_length)){{ $dataTypeContent->ground_length }}@endif" name="ground_length" />
                                                            <span class="input-group-addon">m</span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-close"></i></span>
                                                            <input type="number" min="0" class="form-control elem-categories multiplier" placeholder="Largeur" value="@if(isset($dataTypeContent->ground_width)){{ $dataTypeContent->ground_width }}@endif" name="ground_width" />
                                                            <span class="input-group-addon">m</span>
                                                            <span class="input-group-addon custom_additional_addon"><i class="la la-pause" style="-webkit-transform: rotate(90deg);-moz-transform: rotate(90deg);-ms-transform: rotate(90deg);-o-transform: rotate(90deg);transform: rotate(90deg);"></i></span>
                                                            <input type="number" min="0" class="form-control" placeholder="{{ ($dataTypeContent->ground_length && $dataTypeContent->ground_width) ? $dataTypeContent->ground_length*$dataTypeContent->ground_width : 'Total' }}" disabled="disabled" value="@if(isset($dataTypeContent->surface_ground)){{ $dataTypeContent->surface_ground }}@endif" name="surface_ground" />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="">
                                                        <label>Type de terrain</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="type_land" data-placeholder="Select Floor">
                                                            @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                                                <option value="{{ $type_land->reference }}" @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ 'selected="selected"' }}@endif>{{ $type_land->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="">
                                                        <label>Viabilisé</label>
                                                        <div class="">
                                                            <span class="m-switch m-switch--icon">
                                                                <label>
                                                                    {{--@if(isset($dataTypeContent->id))--}}
                                                                    {{--<input value="{{ $dataTypeContent->exclusiveness }}" type="checkbox" {{ ($dataTypeContent->exclusiveness == 1) ? 'checked' : '' }} name="exclusiveness">--}}
                                                                    {{--@else--}}
                                                                    {{--<input value="1" checked type="checkbox" name="exclusiveness">--}}
                                                                    {{--@endif--}}
                                                                    <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->serviced) && $dataTypeContent->serviced == 1){{ 'checked="checked"' }}@endif name="serviced">
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
                        </div>
                        <div class="tab-pane" id="parking_tab" role="tabpanel">
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
                                            <div class="m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Box/garage int.</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->box_interior_garage)){{ $dataTypeContent->box_interior_garage }}@endif" name="box_interior_garage">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Box/garage double int.</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->box_gar_inter_doub)){{ $dataTypeContent->box_gar_inter_doub }}@endif" name="box_gar_inter_doub">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Box/garage ext.</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->outdoor_garage)){{ $dataTypeContent->outdoor_garage }}@endif" name="outdoor_garage">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Box/garage double ext.</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->box_garage_outside_double)){{ $dataTypeContent->box_garage_outside_double }}@endif" name="box_garage_outside_double">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Place de parc ext. couverte</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->covered_outdoor_parking_space)){{ $dataTypeContent->covered_outdoor_parking_space }}@endif" name="covered_outdoor_parking_space">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Place de parc ext. non-couverte</label>
                                                        <div class="input-group summand">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->outside_parking_space_uncovered)){{ $dataTypeContent->outside_parking_space_uncovered }}@endif" name="outside_parking_space_uncovered">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Nombre de places de parc</label>
                                                        <div class="input-group summ">
                                                            <input type="number" min="0" disabled="disabled" class="form-control m-input" placeholder="Total" value="@if(isset($dataTypeContent->number_parking_spaces)){{ $dataTypeContent->number_parking_spaces }}@endif" name="number_parking_spaces">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Hangar à bateau</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->boat_shed)){{ $dataTypeContent->boat_shed }}@endif" name="boat_shed">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Place d'amarrage</label>
                                                        <div class="input-group">
                                                            <input type="number" min="0" class="form-control m-input elem-categories" placeholder="..." value="@if(isset($dataTypeContent->mooring)){{ $dataTypeContent->mooring }}@endif" name="mooring">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Stationnement -->
                        </div>
                        <div class="tab-pane" id="kitchen_tab" role="tabpanel">
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
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="type" data-placeholder="Select Type">
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
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->freezer) && $dataTypeContent->freezer){{ 'checked="checked"' }}@endif name="freezer">Congélateur
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->cooker) && $dataTypeContent->cooker){{ 'checked="checked"' }}@endif name="cooker">Cusinière
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->oven) && $dataTypeContent->oven){{ 'checked="checked"' }}@endif name="oven">Four
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->microwave_oven) && $dataTypeContent->microwave_oven){{ 'checked="checked"' }}@endif name="microwave_oven">Four à micro-ondes
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->extractor_hood) && $dataTypeContent->extractor_hood){{ 'checked="checked"' }}@endif name="extractor_hood">Hotte aspirante
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->washmachine) && $dataTypeContent->washmachine){{ 'checked="checked"' }}@endif name="washmachine">Lave-linge
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->dishwasher) && $dataTypeContent->dishwasher){{ 'checked="checked"' }}@endif name="dishwasher">Lave-vaiselle
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->plates) && $dataTypeContent->plates){{ 'checked="checked"' }}@endif name="plates">Plaques à gaz
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->induction_plates) && $dataTypeContent->induction_plates){{ 'checked="checked"' }}@endif name="induction_plates">Plaques à induction
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->hotplates) && $dataTypeContent->hotplates){{ 'checked="checked"' }}@endif name="hotplates">Plaques électriques
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->ceramic_plates) && $dataTypeContent->ceramic_plates){{ 'checked="checked"' }}@endif name="ceramic_plates">Plaques vitrocéram
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->fridge) && $dataTypeContent->fridge){{ 'checked="checked"' }}@endif name="fridge">Réfrigérateur
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->cuisine_tumble_drier) && $dataTypeContent->cuisine_tumble_drier){{ 'checked="checked"' }}@endif name="cuisine_tumble_drier">Sèche-linge
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->coffee_maker) && $dataTypeContent->coffee_maker){{ 'checked="checked"' }}@endif name="coffee_maker">Cafetière
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
                        </div>
                        <div class="tab-pane" id="heating_tab" role="tabpanel">
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
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="format" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Heating::all() as $format)
                                                                <option value="{{ $format->reference }}" @if(isset($dataTypeContent->format) && $dataTypeContent->format == $format->reference){{ 'selected="selected"' }}@endif>{{ $format->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Energie</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="chauffage_energy" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Energy::all() as $chauffage_energy)
                                                                <option value="{{ $chauffage_energy->reference }}" @if(isset($dataTypeContent->chauffage_energy) && $dataTypeContent->chauffage_energy == $chauffage_energy->reference){{ 'selected="selected"' }}@endif>{{ $chauffage_energy->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Type de chauffage</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="type_heating" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\HeatingType::all() as $type_heating)
                                                                <option value="{{ $type_heating->reference }}" @if(isset($dataTypeContent->type_heating) && $dataTypeContent->type_heating == $type_heating->reference){{ 'selected="selected"' }}@endif>{{ $type_heating->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Type de radiateur</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="type_radiator" data-placeholder="Select Type" disabled="disabled">
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
                        </div>
                        <div class="tab-pane" id="water_tab" role="tabpanel">
                            <!-- Eaux -->
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
                                                    <h3 class="m-portlet__head-text">Eaux</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Distribution de l’eau chaude</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="distribution" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\WaterDistribution::all() as $distribution)
                                                                <option value="{{ $distribution->reference }}" @if(isset($dataTypeContent->distribution) && $dataTypeContent->distribution == $distribution->reference){{ 'selected="selected"' }}@endif>{{ $distribution->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Energie de l’eau chaude</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="eau_chaude_energy" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\WaterEnergy::all() as $eau_chaude_energy)
                                                                <option value="{{ $eau_chaude_energy->reference }}" @if(isset($dataTypeContent->eau_chaude_energy) && $dataTypeContent->eau_chaude_energy == $eau_chaude_energy->reference){{ 'selected="selected"' }}@endif>{{ $eau_chaude_energy->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Distribution des eaux usées</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="usees_distribution" data-placeholder="Select Type">
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
                            <!-- End Eaux -->
                        </div>
                        <div class="tab-pane" id="conveniences_tab" role="tabpanel">
                            <!-- Commodités-->
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
                                                <div class="col-sm-12">
                                                    <label class="form-group_subtitle">Equipement intérieur</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->shelter) && $dataTypeContent->shelter){{ 'checked="checked"' }}@endif name="shelter">Abri
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->access_disabled) && $dataTypeContent->access_disabled){{ 'checked="checked"' }}@endif name="access_disabled">Accès pour handicapé
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->water_softener) && $dataTypeContent->water_softener){{ 'checked="checked"' }}@endif name="water_softener">Adoucisseur d'eau
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->air_conditioning) && $dataTypeContent->air_conditioning){{ 'checked="checked"' }}@endif name="air_conditioning">Air conditionné
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->pets_welcome) && $dataTypeContent->pets_welcome){{ 'checked="checked"' }}@endif name="pets_welcome">Animaux bienvenus
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->fitted_wardrobes) && $dataTypeContent->fitted_wardrobes){{ 'checked="checked"' }}@endif name="fitted_wardrobes">Armoires encastrées
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->private_lift) && $dataTypeContent->private_lift){{ 'checked="checked"' }}@endif name="private_lift">Ascenseur privé
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->central_aspiration) && $dataTypeContent->central_aspiration){{ 'checked="checked"' }}@endif name="central_aspiration">Aspiration centralisée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->workshop) && $dataTypeContent->workshop){{ 'checked="checked"' }}@endif name="workshop">Atelier
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->patch_panel) && $dataTypeContent->patch_panel){{ 'checked="checked"' }}@endif name="patch_panel">Baie de brassage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->windows) && $dataTypeContent->windows){{ 'checked="checked"' }}@endif name="windows">Baies vitrées
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->bath) && $dataTypeContent->bath){{ 'checked="checked"' }}@endif name="bath">Baignoire
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->balneo_bath) && $dataTypeContent->balneo_bath){{ 'checked="checked"' }}@endif name="balneo_bath">Baignoire balnéo
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->private_laundry_room) && $dataTypeContent->private_laundry_room){{ 'checked="checked"' }}@endif name="private_laundry_room">Buanderie privée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->cafeteria) && $dataTypeContent->cafeteria){{ 'checked="checked"' }}@endif name="cafeteria">Cafétéria
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->carnotzet) && $dataTypeContent->carnotzet){{ 'checked="checked"' }}@endif name="carnotzet">Carnotzet
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->cave) && $dataTypeContent->cave){{ 'checked="checked"' }}@endif name="cave">Cave
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->wine_cellar) && $dataTypeContent->wine_cellar){{ 'checked="checked"' }}@endif name="wine_cellar">Cave à vin
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->cellar) && $dataTypeContent->cellar){{ 'checked="checked"' }}@endif name="cellar">Cellier
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->fireplace) && $dataTypeContent->fireplace){{ 'checked="checked"' }}@endif name="fireplace">Cheminée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" @if(isset($dataTypeContent->air_conditioner) && $dataTypeContent->air_conditioner){{ 'checked="checked"' }}@endif name="air_conditioner">Climatisation
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->removable_partitions) && $dataTypeContent->removable_partitions){{ 'checked="checked"' }}@endif name="removable_partitions">Cloisons amovibles
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->addiction) && $dataTypeContent->addiction){{ 'checked="checked"' }}@endif name="addiction">Dépendance
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->automation) && $dataTypeContent->automation){{ 'checked="checked"' }}@endif name="automation">Domotique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->double_glazing) && $dataTypeContent->double_glazing){{ 'checked="checked"' }}@endif name="double_glazing">Double vitrage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->shower) && $dataTypeContent->shower){{ 'checked="checked"' }}@endif name="shower">Douche
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->dressing) && $dataTypeContent->dressing){{ 'checked="checked"' }}@endif name="dressing">Dressing
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->automatic_fire_extinguisher) && $dataTypeContent->automatic_fire_extinguisher){{ 'checked="checked"' }}@endif name="automatic_fire_extinguisher">Extincteur automatique à eau
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->false_ceiling) && $dataTypeContent->false_ceiling){{ 'checked="checked"' }}@endif name="false_ceiling">Faux plafond
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->optical_fiber) && $dataTypeContent->optical_fiber){{ 'checked="checked"' }}@endif name="optical_fiber">Fibre optique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->attic) && $dataTypeContent->attic){{ 'checked="checked"' }}@endif name="attic">Grenier
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->generator) && $dataTypeContent->generator){{ 'checked="checked"' }}@endif name="generator">Groupe électrogène
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->hammam) && $dataTypeContent->hammam){{ 'checked="checked"' }}@endif name="hammam">Hammam
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->high_internet) && $dataTypeContent->high_internet){{ 'checked="checked"' }}@endif name="high_internet">Internet Haut Débit
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->jacuzzi) && $dataTypeContent->jacuzzi){{ 'checked="checked"' }}@endif name="jacuzzi">Jacuzzi
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->winter_garden) && $dataTypeContent->winter_garden){{ 'checked="checked"' }}@endif name="winter_garden">Jardin d'hiver
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->ski_locker) && $dataTypeContent->ski_locker){{ 'checked="checked"' }}@endif name="ski_locker">Local à ski
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->bicycle_storage) && $dataTypeContent->bicycle_storage){{ 'checked="checked"' }}@endif name="bicycle_storage">Local à velo
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->loggia) && $dataTypeContent->loggia){{ 'checked="checked"' }}@endif name="loggia">Loggia
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->net) && $dataTypeContent->net){{ 'checked="checked"' }}@endif name="net">Monstiquaire
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->hoist) && $dataTypeContent->hoist){{ 'checked="checked"' }}@endif name="hoist">Monte-charge
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->open_plan) && $dataTypeContent->open_plan){{ 'checked="checked"' }}@endif name="open_plan">Open-space
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->outdoor_pool) && $dataTypeContent->outdoor_pool){{ 'checked="checked"' }}@endif name="outdoor_pool">Piscine extérieure
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->indoor_pool) && $dataTypeContent->indoor_pool){{ 'checked="checked"' }}@endif name="indoor_pool">Piscine intérieure
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->ceramic_stove) && $dataTypeContent->ceramic_stove){{ 'checked="checked"' }}@endif name="ceramic_stove">Poêle en céramique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->swedish_stove) && $dataTypeContent->swedish_stove){{ 'checked="checked"' }}@endif name="swedish_stove">Poêle suédois
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->loading_dock) && $dataTypeContent->loading_dock){{ 'checked="checked"' }}@endif name="loading_dock">Quai de déchargement
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->connection_chimney) && $dataTypeContent->connection_chimney){{ 'checked="checked"' }}@endif name="connection_chimney">Raccord. pour cheminée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->connection_swedish_stove) && $dataTypeContent->connection_swedish_stove){{ 'checked="checked"' }}@endif name="connection_swedish_stove">Raccord. pour poêle suédois
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->reception) && $dataTypeContent->reception){{ 'checked="checked"' }}@endif name="reception">Réception
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->metallic_curtain) && $dataTypeContent->metallic_curtain){{ 'checked="checked"' }}@endif name="metallic_curtain">Rideau métallique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->armed_with_fire_tap) && $dataTypeContent->armed_with_fire_tap){{ 'checked="checked"' }}@endif name="armed_with_fire_tap">Robinet d'incendie armé
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->do_it_yourself_room) && $dataTypeContent->do_it_yourself_room){{ 'checked="checked"' }}@endif name="do_it_yourself_room">Salle de bricolage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->theater) && $dataTypeContent->theater){{ 'checked="checked"' }}@endif name="theater">Salle de cinéma
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->game_room) && $dataTypeContent->game_room){{ 'checked="checked"' }}@endif name="game_room">Salle de jeux
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->fitness_room) && $dataTypeContent->fitness_room){{ 'checked="checked"' }}@endif name="fitness_room">Salle fitness
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->conference_room) && $dataTypeContent->conference_room){{ 'checked="checked"' }}@endif name="conference_room">Salle de conférence
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->satellite) && $dataTypeContent->satellite){{ 'checked="checked"' }}@endif name="satellite">Satellite
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->sauna) && $dataTypeContent->sauna){{ 'checked="checked"' }}@endif name="sauna">Sauna
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->subsoil) && $dataTypeContent->subsoil){{ 'checked="checked"' }}@endif name="subsoil">Sous-sol
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->blinds) && $dataTypeContent->blinds){{ 'checked="checked"' }}@endif name="blinds">Stores
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->electric_blinds) && $dataTypeContent->electric_blinds){{ 'checked="checked"' }}@endif name="electric_blinds">Stores électriques
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->thermostat_connected) && $dataTypeContent->thermostat_connected){{ 'checked="checked"' }}@endif name="thermostat_connected">Thermostat connecté
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->triple_glazing) && $dataTypeContent->triple_glazing){{ 'checked="checked"' }}@endif name="triple_glazing">Triple vitrage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->veranda) && $dataTypeContent->veranda){{ 'checked="checked"' }}@endif name="veranda">Véranda
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->crawlspace) && $dataTypeContent->crawlspace){{ 'checked="checked"' }}@endif name="crawlspace">Vide sanitaire
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->electric_shutters) && $dataTypeContent->electric_shutters){{ 'checked="checked"' }}@endif name="electric_shutters">Volets roulants électriques
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->tumble_drier) && $dataTypeContent->tumble_drier){{ 'checked="checked"' }}@endif name="tumble_drier">Sèche-linge
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->hair_dryer) && $dataTypeContent->hair_dryer){{ 'checked="checked"' }}@endif name="hair_dryer">Sèche-cheveux
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->satellite_tv) && $dataTypeContent->satellite_tv){{ 'checked="checked"' }}@endif name="satellite_tv">TV Satellite
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->phone) && $dataTypeContent->phone){{ 'checked="checked"' }}@endif name="phone">Téléphone
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Equipement extérieur -->
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12">
                                                    <label class="form-group_subtitle">Equipement extérieur</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->car_shelter) && $dataTypeContent->car_shelter){{ 'checked="checked"' }}@endif name="car_shelter">Abri de voiture
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->spray) && $dataTypeContent->spray){{ 'checked="checked"' }}@endif name="spray">Arrosage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->barbecue) && $dataTypeContent->barbecue){{ 'checked="checked"' }}@endif name="barbecue">Barbecue
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->exterior_lighting) && $dataTypeContent->exterior_lighting){{ 'checked="checked"' }}@endif name="exterior_lighting">Eclairage extérieur
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->drilling) && $dataTypeContent->drilling){{ 'checked="checked"' }}@endif name="drilling">Forage
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->heliport) && $dataTypeContent->heliport){{ 'checked="checked"' }}@endif name="heliport">Héliport
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->well) && $dataTypeContent->well){{ 'checked="checked"' }}@endif name="well">Puits
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->source) && $dataTypeContent->source){{ 'checked="checked"' }}@endif name="source">Source
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Immeuble -->
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12">
                                                    <label class="form-group_subtitle">Immeuble</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->collective_lift) && $dataTypeContent->collective_lift){{ 'checked="checked"' }}@endif name="collective_lift">Ascenseur collectif
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->communal_laundry_room) && $dataTypeContent->communal_laundry_room){{ 'checked="checked"' }}@endif name="communal_laundry_room">Buanderie collective
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->network_cabling) && $dataTypeContent->network_cabling){{ 'checked="checked"' }}@endif name="network_cabling">Câblage réseau
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->collective_optical_fiber) && $dataTypeContent->collective_optical_fiber){{ 'checked="checked"' }}@endif name="collective_optical_fiber">Fibre optique collective
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->parable) && $dataTypeContent->parable){{ 'checked="checked"' }}@endif name="parable">Parabole
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Sécurité -->
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12">
                                                    <label class="form-group_subtitle">Sécurité</label>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->alarm) && $dataTypeContent->alarm){{ 'checked="checked"' }}@endif name="alarm">Alamre
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->magnetic_card) && $dataTypeContent->magnetic_card){{ 'checked="checked"' }}@endif name="magnetic_card">Carte magnétique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->fenced) && $dataTypeContent->fenced){{ 'checked="checked"' }}@endif name="fenced">Clôturé
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->safe) && $dataTypeContent->safe){{ 'checked="checked"' }}@endif name="safe">Coffre-fort
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->digidode) && $dataTypeContent->digidode){{ 'checked="checked"' }}@endif name="digidode">DigiCode
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->guardian) && $dataTypeContent->guardian){{ 'checked="checked"' }}@endif name="guardian">Gardien
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->caretaker) && $dataTypeContent->caretaker){{ 'checked="checked"' }}@endif name="caretaker">Gardien d'immeuble
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->intercom) && $dataTypeContent->intercom){{ 'checked="checked"' }}@endif name="intercom">Interphone
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->electric_gate) && $dataTypeContent->electric_gate){{ 'checked="checked"' }}@endif name="electric_gate">Portail électrique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->reinforced_door) && $dataTypeContent->reinforced_door){{ 'checked="checked"' }}@endif name="reinforced_door">Porte blindée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->videophone) && $dataTypeContent->videophone){{ 'checked="checked"' }}@endif name="videophone">Vidéophone
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
                        </div>
                        <div class="tab-pane" id="view_tab" role="tabpanel">
                            <!-- Vue-->
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
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->clear) && $dataTypeContent->clear){{ 'checked="checked"' }}@endif name="clear">Dégagée
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->impregnable) && $dataTypeContent->impregnable){{ 'checked="checked"' }}@endif name="impregnable">Imprenable
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->panoramic) && $dataTypeContent->panoramic){{ 'checked="checked"' }}@endif name="panoramic">Panoramique
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->courtyard) && $dataTypeContent->courtyard){{ 'checked="checked"' }}@endif name="courtyard">Sur cour
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_countryside) && $dataTypeContent->on_countryside){{ 'checked="checked"' }}@endif name="on_countryside">Sur la campagne
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_forest) && $dataTypeContent->on_forest){{ 'checked="checked"' }}@endif name="on_forest">Sur la forêt
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_sea) && $dataTypeContent->on_sea){{ 'checked="checked"' }}@endif name="on_sea">Sur la mer
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_pool) && $dataTypeContent->on_pool){{ 'checked="checked"' }}@endif name="on_pool">Sur la piscine
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_river) && $dataTypeContent->on_river){{ 'checked="checked"' }}@endif name="on_river">Sur la rivière
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_street) && $dataTypeContent->on_street){{ 'checked="checked"' }}@endif name="on_street">Sur la rue
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_city) && $dataTypeContent->on_city){{ 'checked="checked"' }}@endif name="on_city">Sur la ville
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_garden) && $dataTypeContent->on_garden){{ 'checked="checked"' }}@endif name="on_garden">Sur le jardin
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_lake) && $dataTypeContent->on_lake){{ 'checked="checked"' }}@endif name="on_lake">Sur le lac
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_park) && $dataTypeContent->on_park){{ 'checked="checked"' }}@endif name="on_park">Sur le parc
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_haven) && $dataTypeContent->on_haven){{ 'checked="checked"' }}@endif name="on_haven">Sur le port
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_hills) && $dataTypeContent->on_hills){{ 'checked="checked"' }}@endif name="on_hills">Sur les collines
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_mountains) && $dataTypeContent->on_mountains){{ 'checked="checked"' }}@endif name="on_mountains">Sur les montagnes
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->on_ski_slopes) && $dataTypeContent->on_ski_slopes){{ 'checked="checked"' }}@endif name="on_ski_slopes">Sur les piste de ski
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->vis_a_vis) && $dataTypeContent->vis_a_vis){{ 'checked="checked"' }}@endif name="vis_a_vis">Vis-à-vis
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
                        </div>
                        <div class="tab-pane" id="state_tab" role="tabpanel">
                            <!-- Etat -->
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
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="interior_condition" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\State::orderBy('value', 'ASC')->get() as $state_front)
                                                                <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Etat extérieur</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="external_state" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\State::orderBy('value', 'ASC')->get() as $state_front)
                                                                <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Etat de la façade</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="state_front" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\State::orderBy('value', 'ASC')->get() as $state_front)
                                                                <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Type de construction</label>
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="type_construction" data-placeholder="Select Type">
                                                            @foreach(TCG\Voyager\Models\Construction::orderBy('value', 'ASC')->get() as $type_construction)
                                                                <option value="{{ $type_construction->reference }}" @if(isset($dataTypeContent->type_construction) && $dataTypeContent->type_construction == $type_construction->reference){{ 'selected="selected"' }}@endif>{{ $type_construction->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Année de construction</label>
                                                        <div class="input-group date years_only">
                                                            <input type="text" class="form-control m-input elem-categories" readonly="" placeholder="{{ ($dataTypeContent->year_construction) ? $dataTypeContent->year_construction : 'Sélectionner la date' }}" name="year_construction">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <div class="form-group">
                                                        <label>Année de rénovation</label>
                                                        <div class="input-group date years_only">
                                                            <input type="text" class="form-control m-input elem-categories" readonly="" placeholder="{{ ($dataTypeContent->year_renovation) ? $dataTypeContent->year_renovation : 'Sélectionner la date' }}" name="year_renovation">
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
                        </div>
                        <div class="tab-pane" id="exposition_tab" role="tabpanel">
                            <!-- Exposition -->
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
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->nord) && $dataTypeContent->nord){{ 'checked="checked"' }}@endif name="nord">Nord
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->south) && $dataTypeContent->south){{ 'checked="checked"' }}@endif name="south">Sud
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->est) && $dataTypeContent->est){{ 'checked="checked"' }}@endif name="est">Est
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2">
                                                    <div class="form-group">
                                                        <label class="m-checkbox">
                                                            <input type="checkbox" class="elem-categories" @if(isset($dataTypeContent->west) && $dataTypeContent->west){{ 'checked="checked"' }}@endif name="west">Ouest
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
                        </div>
                        <div class="tab-pane" id="gallery_tab" role="tabpanel">
                            <!-- Galeries -->
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
                                                    <h3 class="m-portlet__head-text">Galeries</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="row">
                                                <div class="col-lg-12 margin_bottom_10">
                                                    <label>Gallery images dropzone</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="image[]" multiple="multiple" type="file" accept="image/*" id="avatar" class="input_file">
                                                            <label for="avatar">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                            <div class="thumbnails_container">
                                                                @if(isset($dataTypeContent->image))
                                                                    @foreach(json_decode($dataTypeContent->image) as $image)
                                                                        <img src="{{ Voyager::image($image) }}" style="max-width:150px;max-height:50px;" />
                                                                    @endforeach
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{--<div class="m-dropzone dropzone m-dropzone--success" id="m-dropzone-three"><!--action="inc/api/dropzone/upload.php" -->--}}
                                                    {{--<div class="m-dropzone__msg dz-message needsclick">--}}
                                                    {{--@if(isset($dataTypeContent->image))--}}
                                                    {{--@foreach(json_decode($dataTypeContent->image) as $image)--}}
                                                    {{--<img src="{{ Voyager::image($image) }}" style="max-width:150px;max-height:50px;" />--}}
                                                    {{--@endforeach--}}
                                                    {{--@endif--}}
                                                    {{--<input type="file" name="image[]" multiple="multiple">--}}
                                                    {{--<h3 class="m-dropzone__msg-title">--}}
                                                    {{--Drop files here or click to upload.--}}
                                                    {{--</h3>--}}
                                                    {{--<span class="m-dropzone__msg-desc">--}}
                                                    {{--Only image, pdf and psd files are allowed for upload--}}
                                                    {{--</span>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
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
                            <!-- End Galeries -->
                        </div>
                    </div>
                </div>

                <!-- Actions block -->
                <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="pure_switch">
                                <span class="m-switch m-switch--outline m-switch--brand">
                                    <label>
                                        <input type="checkbox" {{ ($dataTypeContent->publicate == 1) ? 'checked' : '' }} name="publicate">
                                        <span></span>
                                    </label>
                                </span>
                                <label class="pure_switch_label">Publier</label>
                            </div>
                        </div>
                        <div class="col-lg-6 m--align-right">
                            <button type="button" data-toggle="modal" data-target="#save_checklist" class="btn btn-success btn-lg m-btn m-btn--air m-btn--custom">Enregistrer</button>
                        </div>
                    </div>
                </div>
                <!-- End Actions block -->

                <!--begin::Modal-->
                <div class="modal fade" id="save_checklist" tabindex="-1" role="dialog" aria-labelledby="save_checklist" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">
                                    Check all checkboxes in order to save this object
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label"> Título de propiedad del transmitente.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">Último recibo anual IBI.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">Nota simple del Registro de la Propiedad.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">Contratos de alquiler en vigor.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">Últimos recibos de servicios al corriente de pago: agua, luz, gas, etc.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">ITE, Inspección Técnica de Edificios.</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="pure_switch">
                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                <label>
                                                    <input type="checkbox" name="save_check1">
                                                    <span></span>
                                                </label>
                                            </span>
                                            <label class="pure_switch_label">Planos catastrales.</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" value="submit" class="btn btn-primary" disabled="disabled">Enregistrer</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Modal-->

            </form>
            <!-- End Form -->
        </div>
    </div>

    <!--begin::Modal-->
    <div class="modal fade" id="address_map_modal" tabindex="-1" role="dialog" aria-labelledby="addressMapModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressMapModal">Positionner votre adresse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="map_block">
                        <div id="address_map" style="height: 500px; width: 100%;"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Sauver et fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal-->
@stop

@section('javascript')
    <!--begin::Page Resources -->
    <script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/dropzone.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZhPguGsxnAK4WdGML3Qew_KMleHvRdzw&libraries=places&callback=initAutocomplete"async defer></script>
    <!--end::Google Maps -->

    <script>
        $('#main_tabs_nav a[data-toggle="tab"]').on('click', function(e) {
            e.preventDefault();
            var this_tab_id = $(this).attr('href').replace('#','');
            $(this).closest('.nav').find('.nav-item a.nav-link.active').removeClass('active');
            $(this).addClass('active');
            $(this).closest('.main_tabs_container').find('.tab-content#main_tabs > .tab-pane.active').removeClass('active');
            $('.tab-content .tab-pane#' + this_tab_id).addClass('active');
        });

        $(".years_only").datepicker( {
            format: "yyyy", // Notice the Extra space at the beginning
            viewMode: "yyyy",
            minViewMode: "years"
        });

        $('#save_checklist').on('show.bs.modal', function () {
            checkChecklict();
        });

        $("#save_checklist .pure_switch input[type='checkbox']").change(function(){
            checkChecklict();
        });
        function checkChecklict() {
            var checkboxes =  $("#save_checklist .pure_switch input[type='checkbox']");
            var checked =  $("#save_checklist .pure_switch input[type='checkbox']:checked");
            if ($(checkboxes).length == $(checked).length) {
                $("#save_checklist button[type='submit']").prop('disabled', false)
            } else {
                $("#save_checklist button[type='submit']").prop('disabled', true)
            }
        }

        function setSelectedCurrency(currency) {
            console.log(currency)
            $('#price_tab .input-group-addon .currency').html(currency);
        }

        $('#heating_tab select[name="type_heating"]').on('select2:select', function (e) {
            var heating_type = e.params.data.text;
            if(heating_type == "Radiateur") {
                $('#heating_tab select[name="type_radiator"]').attr('disabled', false);
            } else {
                $('#heating_tab select[name="type_radiator"]').select2({minimumResultsForSearch: Infinity}).val("1").trigger("change");
                $('#heating_tab select[name="type_radiator"]').attr('disabled', true);
            }
        });

        $('#price_tab select').on('select2:select', function (e) {
            var currency = e.params.data.text;
            if(currency != "CHF") {
                currency = currency.split(' ')[0];
            }
            setSelectedCurrency(currency);
        });

        /* action for change announce type */
        $('input[name="ann_type"]').on("change", function(){
            $('.rent').val('');
            $('.locat').val('');

            if($(this).val() === 1) {
                $('.rent').attr('disabled', true);
            }
        });

        /* Summ of surfaces */
        $("#surface_tab .input-group.summand input").on("change paste keyup", function() {
            summInputValues('surface_tab');
        });

        /* Summ of parking places */
        $("#parking_tab .input-group.summand input").on("change paste keyup", function() {
            summInputValues('parking_tab');
        });

        /* Summ of bathrooms and WCs */
        $("#layout_tab .input-group.summand input").on("change paste keyup", function() {
            summInputValues('layout_tab');
        });

        function summInputValues(tab_id) {
            var summable_input_group = $("#"+tab_id+" .input-group.summand")
            var summ_input = $("#"+tab_id+" .input-group.summ input");
            var summ = 0;

            if(tab_id === 'surface_tab') {
                jQuery.each( summable_input_group, function( i, val ) {
                    var summable_input_val = $(this).find('input:not(.custom_input_for_coefficient)').val();
                    var summable_input_coef_val = $(this).find('input.custom_input_for_coefficient').val();
                    console.log(summable_input_val*summable_input_coef_val);
                    if(summable_input_val) {
                        if(summable_input_coef_val) {
                            summ += parseInt(summable_input_val * summable_input_coef_val);
                        }else {
                            summ += parseInt(summable_input_val);
                        }
                    }
                });
            } else {
                jQuery.each( summable_input_group, function( i, val ) {
                    var summable_input_val = $(this).find('input:not(.custom_input_for_coefficient)').val();
                    if(summable_input_val) {
                        summ += parseInt(summable_input_val);
                    }
                });
            }
            summ_input.attr('placeholder', summ);
        }
        $("#surface_tab .input-group input[name='ground_width'], #surface_tab .input-group input[name='ground_length']").on("change paste keyup", function() {
            terrainSurface();
        });
        function terrainSurface() {
            var terrain_width = $("#surface_tab .input-group input[name='ground_width']").val();
            var terrain_length = $("#surface_tab .input-group input[name='ground_length']").val();
            var terrain_surface = $("#surface_tab .input-group input[name='surface_ground']");
            var terrain_surface_val = 'Total';

            if(terrain_width && terrain_length) {
                terrain_surface_val = parseInt(terrain_width) * parseInt(terrain_length)
            }
            terrain_surface.attr('placeholder', terrain_surface_val);
        }

        $(function() {
            $('.bar_rating').barrating({
                theme: 'fontawesome-stars'
            });
        });

        /* hide or show inputs*/
        var fields = [
            { id: 1, field: $('input[name="heating_loads"]') },
            { id: 2, field: $('input[name="ppe_charges"]') },
            { id: 3, field: $('input[name="condominium_fees"]') },
            { id: 4, field: $('input[name="property_tax"]') },
            { id: 5, field: $('input[name="taxes_1"]') },
            { id: 6, field: $('input[name="rental_security"]') },
            { id: 7, field: $('input[name="commercial_property"]') },
            { id: 8, field: $('input[name="number_rooms"]') },
            { id: 9, field: $('input[name="number_pieces"]') },
            { id: 10, field: $('input[name="number_balconies"]') },
            { id: 11, field: $('input[name="number_shower_rooms"]') },
            { id: 12, field: $('input[name="number_toilets"]') },
            { id: 13, field: $('input[name="number_terraces"]') },
            { id: 14, field: $('input[name="number_floors_building"]') },
            { id: 15, field: $('select[name="floor_property"]') },
            { id: 16, field: $('input[name="levels"]') },
            { id: 17, field: $('input[name="surface_cellar"]') },
            { id: 18, field: $('input[name="surface_cellar_child"]') },// вместе
            { id: 19, field: $('input[name="ceiling_height"]') },
            { id: 20, field: $('input[name="roof_cover_area"]') },
            { id: 21, field: $('input[name="roof_cover_area_child"]') },
            { id: 22, field: $('input[name="surf_area_terr_solar"]') },
            { id: 23, field: $('input[name="surf_area_terr_solar_child"]') },
            { id: 24, field: $('input[name="area_veranda"]') },
            { id: 25, field: $('input[name="area_veranda_child"]') },
            { id: 26, field: $('input[name="attic_space"]') },
            { id: 27, field: $('input[name="attic_space_child"]') },
            { id: 28, field: $('input[name="surface_balcony"]') },
            { id: 29, field: $('input[name="surface_balcony_child"]') },
            { id: 30, field: $('input[name="basement_area"]') },
            { id: 31, field: $('input[name="basement_area_child"]') },
            { id: 32, field: $('input[name="surface_ground"]') },
            { id: 33, field: $('input[name="ground_length"]') },
            { id: 34, field: $('input[name="ground_width"]') },
            { id: 35, field: $('input[name="serviced"]') },
            { id: 36, field: $('select[name="type_land"]') },
            { id: 37, field: $('input[name="useful_surface"]') },
            { id: 38, field: $('input[name="ppe_area"]') },
            { id: 39, field: $('input[name="volume"]') },
            { id: 40, field: $('input[name="surface_eng_court"]') },
            { id: 41, field: $('input[name="surface_eng_court_child"]') },
            { id: 42, field: $('input[name="lower_ground_floor"]') },
            { id: 43, field: $('input[name="lower_ground_floor_child"]') },
            { id: 44, field: $('input[name="row_area"]') },
            { id: 45, field: $('input[name="garage_area"]') },
            { id: 46, field: $('input[name="weighted_surface"]') },
            { id: 47, field: $('input[name="box_interior_garage"]') },
            { id: 48, field: $('input[name="box_gar_inter_doub"]') },
            { id: 49, field: $('input[name="outdoor_garage"]') },
            { id: 50, field: $('input[name="box_garage_outside_double"]') },
            { id: 51, field: $('input[name="covered_outdoor_parking_space"]') },
            { id: 52, field: $('input[name="outside_parking_space_uncovered"]') },
            { id: 53, field: $('input[name="number_parking_spaces"]') },
            { id: 54, field: $('input[name="boat_shed"]') },
            { id: 55, field: $('input[name="mooring"]') },
            { id: 56, field: $('select[name="type"]') },
            { id: 57, field: $('input[name="freezer"]') },
            { id: 58, field: $('input[name="cooker"]') },
            { id: 59, field: $('input[name="oven"]') },
            { id: 60, field: $('input[name="microwave_oven"]') },
            { id: 61, field: $('input[name="extractor_hood"]') },
            { id: 62, field: $('input[name="washmachine"]') },
            { id: 63, field: $('input[name="dishwasher"]') },
            { id: 64, field: $('input[name="plates"]') },
            { id: 65, field: $('input[name="induction_plates"]') },
            { id: 66, field: $('input[name="hotplates"]') },
            { id: 67, field: $('input[name="ceramic_plates"]') },
            { id: 68, field: $('input[name="fridge"]') },
            { id: 69, field: $('input[name="cuisine_tumble_drier"]') },
            { id: 70, field: $('input[name="coffee_maker"]') },
            { id: 71, field: $('select[name="format"]') },
            { id: 72, field: $('select[name="chauffage_energy"]') },
            { id: 73, field: $('select[name="type_heating"]') },
            { id: 74, field: $('select[name="type_radiator"]') },
            { id: 75, field: $('select[name="distribution"]') },
            { id: 76, field: $('select[name="eau_chaude_energy"]') },
            { id: 77, field: $('select[name="usees_distribution"]') },
            { id: 78, field: $('select[name="divers_format"]') },
            { id: 79, field: $('select[name="sonority"]') },
            { id: 80, field: $('select[name="style"]') },
            { id: 81, field: $('input[name="shelter"]') },
            { id: 82, field: $('input[name="access_disabled"]') },
            { id: 83, field: $('input[name="water_softener"]') },
            { id: 84, field: $('input[name="air_conditioning"]') },
            { id: 85, field: $('input[name="pets_welcome"]') },
            { id: 86, field: $('input[name="fitted_wardrobes"]') },
            { id: 87, field: $('input[name="private_lift"]') },
            { id: 88, field: $('input[name="central_aspiration"]') },
            { id: 89, field: $('input[name="workshop"]') },
            { id: 90, field: $('input[name="patch_panel"]') },
            { id: 91, field: $('input[name="windows"]') },
            { id: 92, field: $('input[name="bath"]') },
            { id: 93, field: $('input[name="balneo_bath"]') },
            { id: 94, field: $('input[name="private_laundry_room"]') },
            { id: 95, field: $('input[name="cafeteria"]') },
            { id: 96, field: $('input[name="carnotzet"]') },
            { id: 97, field: $('input[name="cave"]') },
            { id: 98, field: $('input[name="wine_cellar"]') },
            { id: 99, field: $('input[name="cellar"]') },
            { id: 100, field: $('input[name="fireplace"]') },
            { id: 101, field: $('input[name="removable_partitions"]') },
            { id: 102, field: $('input[name="addiction"]') },
            { id: 103, field: $('input[name="automation"]') },
            { id: 104, field: $('input[name="double_glazing"]') },
            { id: 105, field: $('input[name="shower"]') },
            { id: 106, field: $('input[name="dressing"]') },
            { id: 107, field: $('input[name="automatic_fire_extinguisher"]') },
            { id: 108, field: $('input[name="false_ceiling"]') },
            { id: 109, field: $('input[name="optical_fiber"]') },
            { id: 110, field: $('input[name="attic"]') },
            { id: 111, field: $('input[name="generator"]') },
            { id: 112, field: $('input[name="hammam"]') },
            { id: 113, field: $('input[name="high_internet"]') },
            { id: 114, field: $('input[name="jacuzzi"]') },
            { id: 115, field: $('input[name="winter_garden"]') },
            { id: 116, field: $('input[name="ski_locker"]') },
            { id: 117, field: $('input[name="bicycle_storage"]') },
            { id: 118, field: $('input[name="loggia"]') },
            { id: 119, field: $('input[name="net"]') },
            { id: 120, field: $('input[name="hoist"]') },
            { id: 121, field: $('input[name="open_plan"]') },
            { id: 122, field: $('input[name="outdoor_pool"]') },
            { id: 123, field: $('input[name="indoor_pool"]') },
            { id: 124, field: $('input[name="ceramic_stove"]') },
            { id: 125, field: $('input[name="swedish_stove"]') },
            { id: 126, field: $('input[name="loading_dock"]') },
            { id: 127, field: $('input[name="connection_chimney"]') },
            { id: 128, field: $('input[name="connection_swedish_stove"]') },
            { id: 129, field: $('input[name="reception"]') },
            { id: 130, field: $('input[name="metallic_curtain"]') },
            { id: 131, field: $('input[name="armed_with_fire_tap"]') },
            { id: 132, field: $('input[name="do_it_yourself_room"]') },
            { id: 133, field: $('input[name="theater"]') },
            { id: 134, field: $('input[name="game_room"]') },
            { id: 135, field: $('input[name="fitness_room"]') },
            { id: 136, field: $('input[name="conference_room"]') },
            { id: 137, field: $('input[name="satellite"]') },
            { id: 138, field: $('input[name="sauna"]') },
            { id: 139, field: $('input[name="subsoil"]') },
            { id: 140, field: $('input[name="blinds"]') },
            { id: 141, field: $('input[name="electric_blinds"]') },
            { id: 142, field: $('input[name="thermostat_connected"]') },
            { id: 143, field: $('input[name="triple_glazing"]') },
            { id: 144, field: $('input[name="veranda"]') },
            { id: 145, field: $('input[name="crawlspace"]') },
            { id: 146, field: $('input[name="electric_shutters"]') },
            { id: 147, field: $('input[name="tumble_drier"]') },
            { id: 148, field: $('input[name="hair_dryer"]') },
            { id: 149, field: $('input[name="satellite_tv"]') },
            { id: 150, field: $('input[name="phone"]') },
            { id: 151, field: $('input[name="car_shelter"]') },
            { id: 152, field: $('input[name="spray"]') },
            { id: 153, field: $('input[name="barbecue"]') },
            { id: 154, field: $('input[name="exterior_lighting"]') },
            { id: 155, field: $('input[name="drilling"]') },
            { id: 156, field: $('input[name="heliport"]') },
            { id: 157, field: $('input[name="well"]') },
            { id: 158, field: $('input[name="source"]') },
            { id: 159, field: $('input[name="collective_lift"]') },
            { id: 160, field: $('input[name="communal_laundry_room"]') },
            { id: 161, field: $('input[name="network_cabling"]') },
            { id: 162, field: $('input[name="collective_optical_fiber"]') },
            { id: 163, field: $('input[name="parable"]') },
            { id: 164, field: $('input[name="alarm"]') },
            { id: 165, field: $('input[name="magnetic_card"]') },
            { id: 166, field: $('input[name="fenced"]') },
            { id: 167, field: $('input[name="safe"]') },
            { id: 168, field: $('input[name="digidode"]') },
            { id: 169, field: $('input[name="guardian"]') },
            { id: 170, field: $('input[name="caretaker"]') },
            { id: 171, field: $('input[name="intercom"]') },
            { id: 172, field: $('input[name="electric_gate"]') },
            { id: 173, field: $('input[name="reinforced_door"]') },
            { id: 174, field: $('input[name="videophone"]') },
            { id: 175, field: $('input[name="clear"]') },
            { id: 176, field: $('input[name="impregnable"]') },
            { id: 177, field: $('input[name="panoramic"]') },
            { id: 178, field: $('input[name="courtyard"]') },
            { id: 179, field: $('input[name="on_countryside"]') },
            { id: 180, field: $('input[name="on_forest"]') },
            { id: 181, field: $('input[name="on_sea"]') },
            { id: 182, field: $('input[name="on_pool"]') },
            { id: 183, field: $('input[name="on_river"]') },
            { id: 184, field: $('input[name="on_street"]') },
            { id: 185, field: $('input[name="on_city"]') },
            { id: 186, field: $('input[name="on_garden"]') },
            { id: 187, field: $('input[name="on_lake"]') },
            { id: 188, field: $('input[name="on_park"]') },
            { id: 189, field: $('input[name="on_haven"]') },
            { id: 190, field: $('input[name="on_hills"]') },
            { id: 191, field: $('input[name="on_mountains"]') },
            { id: 192, field: $('input[name="on_ski_slopes"]') },
            { id: 193, field: $('input[name="vis_a_vis"]') },
            { id: 194, field: $('select[name="interior_condition"]') },
            { id: 195, field: $('select[name="type_construction"]') },
            { id: 196, field: $('select[name="state_front"]') },
            { id: 197, field: $('select[name="external_state"]') },
            { id: 198, field: $('input[name="year_construction"]') },
            { id: 199, field: $('input[name="year_renovation"]') },
            { id: 200, field: $('input[name="nord"]') },
            { id: 201, field: $('input[name="south"]') },
            { id: 202, field: $('input[name="est"]') },
            { id: 203, field: $('input[name="west"]') }
        ];

        var categories = [
            { id: 1, name: 'Maison', fields: [4,7,14,15,35,38,101,120,121,126,129,159,160,161,162,163,196] },
            { id: 2, name: 'Appartement', fields: [4,7,15,35,101,120,121,126,129,155,195] },
            { id: 3, name: 'Terrain constructible', fields: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199] },
            { id: 4, name: 'Terrain non-constructible', fields: [1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199] },
            { id: 5, name: 'Surface commerciale', fields: [4,15,16,116,35,102,106,195,197] },
            { id: 6, name: 'Immeuble', fields: [4,6,8,9,10,11,12,13,16,17,18,22,23,24,25,26,27,28,29,35,46,87,89,96,98,99,102,106,115,118,119,121,124,125,127,128,132,134,135,136,138,197] },
            { id: 7, name: 'Stationnement', fields: [1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203] },
            { id: 8, name: 'Autre', fields: [4,20,21,35,102,197] }
        ];

        function setCategoryFields(category_id) {

            // Находим все поля относязиеся к категориям
            var elems = $('body').find($('.elem-categories'));
            // Очищаем их
            $.each(elems, function () {
                $(this).removeAttr('disabled');
                $(this).parent().parent().removeClass('disabled_element');
            });

            // Стилизуем только необходимые
            $.each(categories, function () {
                var category = this;

                if (category.id === parseInt(category_id)) {
                    for (var i = 0; i < category.fields.length; i++) {
                        $.each(fields, function () {
                            if (this.id === category.fields[i]) {
                                this.field.attr('disabled', true);
                                this.field.parent().parent().addClass('disabled_element');
                            }
                        })
                    }
                }
            })
        }

        $('a[cat_id]').on('click', function(e) {
            setCategoryFields($(this).attr('cat_id'));
        });

        $('input.announce_type').click(function() {
            var type = $(this).attr('value');

            var availability = $('input[name="availability"]'),
                availab_from = $('input[name="availab_from"]'),
                availab_until = $('input[name="availab_until"]');

//            var forType = $('body').find($('.for-type'));

//            $.each(forType, function () {
//                $(this).removeAttr('disabled');
////                $(this).parent().parent().removeClass('disabled_element'); // todo дописать
//            });

            if(parseInt(type) === 1) {
                availability.removeAttr('disabled');
                availability.parent().parent().removeClass('disabled_element');

                availab_from.attr('disabled', true);
                availab_from.parent().parent().addClass('disabled_element');

                availab_until.attr('disabled', true);
                availab_until.parent().parent().addClass('disabled_element');
            } else {
                availability.attr('disabled', true);
                availability.parent().parent().addClass('disabled_element');

                availab_from.removeAttr('disabled');
                availab_from.parent().parent().removeClass('disabled_element');

                availab_until.removeAttr('disabled');
                availab_until.parent().parent().removeClass('disabled_element');
            }
            ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            var ann_type = $('.announce_type:checked').attr('value');
            $('input[name="rental_security"]').removeAttr('disabled');
            $('input[name="rental_security"]').parent().parent().removeClass('disabled_element');

            if(parseInt(ann_type) === 1) {
                $('input[name="rental_security"]').attr('disabled', true);
                $('input[name="rental_security"]').parent().parent().addClass('disabled_element');
            }

            $('a[cat_id]').click(function(e) {
                var catId = $(this).attr('cat_id');
//                var ann_type = $('.announce_type:checked').attr('value');

                $('input[name="rental_security"]').removeAttr('disabled');
                $('input[name="rental_security"]').parent().parent().removeClass('disabled_element');

                if(parseInt(catId) === 1 || parseInt(catId) === 4 || parseInt(catId) === 7) {
//                    console.log('success CAtegorie');
                    if(parseInt(ann_type) === 1) {
                        $('input[name="rental_security"]').attr('disabled', true);
                        $('input[name="rental_security"]').parent().parent().addClass('disabled_element');
                    }
                }
            });
        });

        function Trigger(val) {
            var availability = $('input[name="availability"]'),
                availab_from = $('input[name="availab_from"]'),
                availab_until = $('input[name="availab_until"]');

            if(parseInt(val) === 1) {
                availability.removeAttr('disabled');
                availability.parent().parent().removeClass('disabled_element');

                availab_from.attr('disabled', true);
                availab_from.parent().parent().addClass('disabled_element');

                availab_until.attr('disabled', true);
                availab_until.parent().parent().addClass('disabled_element');
            } else {
                availability.attr('disabled', true);
                availability.parent().parent().addClass('disabled_element');

                availab_from.removeAttr('disabled');
                availab_from.parent().parent().removeClass('disabled_element');

                availab_until.removeAttr('disabled');
                availab_until.parent().parent().removeClass('disabled_element');
            }
        }

        var typeAnnounce = $('.announce_type:checked').attr('value');
        Trigger(typeAnnounce);

        // if fields of titles not filled
        $('button[type="submit"]').click(function() {
            var titleFR = $('input[name="title_fr"]').val(),
                titleEN = $('input[name="title_en"]').val(),
                titleES = $('input[name="title_es"]').val(),
                prixInputs = $('.form-group input[type="text"]').closest('#price_tab');
            console.log(prixInputs);

            if(titleFR === '') {
                $('a[href="#redaction_tab"]').trigger('click');
                $('a[href="#fr_redaction"]').trigger('click');
            }else if(titleEN === '') {
                $('a[href="#redaction_tab"]').trigger('click');
                $('a[href="#en_redaction"]').trigger('click');
            } else if(titleES === '') {
                $('a[href="#redaction_tab"]').trigger('click');
                $('a[href="#es_redaction"]').trigger('click');
            }
        });

        // add category id in input for back-end
        $('a[cat_id]').on('click', function() {
            var category = $(this).attr('cat_id');
            $('#categories_ul input[name="category_id"]').attr('value',category);
        });


        // trigger to category tab for edit object page
        var p = $('p[data]').attr('data'); // to find out what page
        if(p != ''){ // if not create page
            var categoryId = $('a.active[cat_id]').attr('cat_id');
            $('a[cat_id="'+categoryId+'"]').trigger('click');
        }

        $('#categories_ul .nav-item .nav-link.active').trigger('click');

    </script>
    <script>
        jQuery(document).ready(function () {
            jQuery("#edit_create_form").validate({
                rules: {
                    title_fr: {
                        required: true,
                        /*minlength: 2*/
                    },
                    title_en: {
                        required: true,
                        /*minlength: 2*/
                    },
                    title_es: {
                        required: true,
                        /*minlength: 2*/
                    }
                },
                /*messages: {
                 title_fr: {
                 minlength: "Danger! Input 2 more symbols"
                 },
                 title_en: {
                 minlength: "Danger! Input 2 more symbols"
                 },
                 title_es: {
                 minlength: "Danger! Input 2 more symbols"
                 }
                 },*/
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>

    <script>
        // This example displays an address form, using the autocomplete feature
        // of the Google Places API to help users fill in the information.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        var placeSearch, autocomplete;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
//            administrative_area_level_1: 'short_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            autocomplete = new google.maps.places.Autocomplete(
                /** @type {!HTMLInputElement} */(document.getElementById('autocomplete')),
                {types: ['geocode']});

            // When the user selects an address from the dropdown, populate the address
            // fields in the form.
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }

            $('#latitude').val('');
            $('#longitude').val('');
        }

        // Bias the autocomplete object to the user's geographical location,
        // as supplied by the browser's 'navigator.geolocation' object.
        function geolocate() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var geolocation = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    var circle = new google.maps.Circle({
                        center: geolocation,
                        radius: position.coords.accuracy
                    });
                    autocomplete.setBounds(circle.getBounds());
                });
            }
        }

        $('#address_map_modal').on('shown.bs.modal', function (e) {
            initializeAddressMap();
        });

        var map, infoWindow;
        function initializeAddressMap() {

            var current_position = {
                lat: 40.416775,
                lng: -3.703790
            };

            var myLatlng = new google.maps.LatLng(current_position);

            map = document.getElementById('address_map');
            var geocoder = new google.maps.Geocoder;
            var mapOptions = {
                zoom: 15,
                minZoom: 2,
                maxZoom: 20,
                scrollwheel: false,
                mapTypeControl: true,
                mapTypeControlOptions: {
                    position: google.maps.ControlPosition.TOP_RIGHT
                },
                streetViewControl: true,
                streetViewControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP
                },
                zoomControl: true,
                zoomControlOptions: {
                    position: google.maps.ControlPosition.RIGHT_TOP
                },
                center: myLatlng
            };
            var map = new google.maps.Map(map, mapOptions);
            var marker = new google.maps.Marker({
                map: map,
                position: myLatlng,
                draggable: true
                //icon: '/images/pin_map_white.svg'
            });

            console.log(current_position);

            google.maps.event.addListener(marker, 'dragend', function(e){
                myLatlng = marker.getPosition();
                geocoder.geocode({
                    latLng: marker.getPosition()
                }, function(responses) {
                    if (responses && responses.length > 0) {

                        $('#latitude').val(e.latLng.lat());
                        $('#longitude').val(e.latLng.lng());
                        $('#autocomplete').val(responses[0].formatted_address);

                        $('#street_number').val('');
                        $('#route').val('');
                        $('#locality').val('');
                        $('#country').val('');
                        $('#postal_code').val('');

                        responses[0].address_components.forEach(function(a) {
                            if (a.long_name !== undefined && a.long_name.length > 0) {
                                if (a.types[0] == 'street_number') {
                                    $('#street_number').val(a.long_name);
                                }
                                if (a.types[0] == 'route' || a.types[0] == 'street_address') {
                                    $('#route').val(a.long_name);
                                }
                                if (a.types[0] == 'locality') {
                                    $('#locality').val(a.long_name);
                                }
                                if (a.types[0] == 'country') {
                                    $('#country').val(a.long_name);
                                }
                                if (a.types[0] == 'postal_code') {
                                    $('#postal_code').val(a.long_name);
                                }
                            }
                        });

                    } else {
                        console.log('Cannot determine address at this location.');
                    }
                });
            });

            infoWindow = new google.maps.InfoWindow;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };

                    infoWindow.setPosition(pos);
                    infoWindow.setContent('Location found.');
                    infoWindow.open(map);
                    map.setCenter(pos);
                }, function() {
                    handleLocationError(true, infoWindow, map.getCenter());
                });
            } else {
                // Browser doesn't support Geolocation
                handleLocationError(false, infoWindow, map.getCenter());
            }
        }

        function handleLocationError(browserHasGeolocation, infoWindow, pos) {
            infoWindow.setPosition(pos);
            infoWindow.setContent(browserHasGeolocation ?
                'Error: The Geolocation service failed.' :
                'Error: Your browser doesn\'t support geolocation.');
            infoWindow.open(map);
        }
    </script>
@stop