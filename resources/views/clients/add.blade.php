@extends('voyager::master_metronic')

@section('css')
@stop

{{--@section('page_header')--}}
    {{--<h1 class="page-title">--}}
        {{--<i class="{{ $dataType->icon }}"></i>--}}
        {{--{{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}--}}
    {{--</h1>--}}
    {{--@include('voyager::multilingual.language-selector')--}}
{{--@stop--}}

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
                                    Clients
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Create client
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
            <form id="edit_create_clients" class="form-edit-add m-form m-form--group-seperator-dashed" role="form" action="" method="POST"> {{-- todo action --}}
                {{ csrf_field() }}

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
                                                Create Client
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-3 margin_bottom_10">
                                            <label>Name</label>
                                            <input type="text" id="" class="form-control m-input" placeholder="Name" value="" name="name">
                                        </div>
                                        <div class="col-lg-3 margin_bottom_10">
                                            <label>Second Name</label>
                                            <input type="text" id="" class="form-control m-input" placeholder="Second Name" value="" name="last_name">
                                        </div>
                                        <div class="col-lg-3 margin_bottom_10">
                                            <label for="lng_corres">Langue de correspondance</label>
                                            <select name="lng_corres" id="lng_corres">
                                                @foreach(TCG\Voyager\Models\UserLanguage::all() as $lng)
                                                    <option value="{{ $lng->reference }}">{{ $lng->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-lg-3 margin_bottom_10">
                                            <label>Password</label>
                                            <input type="text" id="" class="form-control m-input" placeholder="Password" value="" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 m--align-right">
                                    <button type="button" class="btn btn-primary btn-lg">Enregistrer</button>
                                </div>
                            </div>
                            <!--end::Portlet-->
                        </div>
                    </div>
                    <!-- End Adresse -->
                </div>
            </form>
        </div>
    </div>

@stop