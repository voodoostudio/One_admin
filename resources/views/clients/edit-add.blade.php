@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}
{{--{{ dd(json_decode($dataTypeContent->second_child)) }}--}}

@section('css')
    {{--<link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">--}}
    <style>
        .user-email {
            font-size: .85rem;
            margin-bottom: 1.5em;
        }
    </style>
@stop

@section('content')
    @if(isset($dataTypeContent->id))
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            Editer le profil <b>({{ (isset($dataTypeContent->name)) ? $dataTypeContent->name : '' }} {{ (isset($dataTypeContent->last_name)) ? $dataTypeContent->last_name : '' }})</b>
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="row">
                    <div class="col-sm-12 col-xl-3">
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__body">
                                <div class="m-card-profile">
                                    <div class="m-card-profile__title m--hide">
                                        Votre profil
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img id="client_photo" class="hide-all" style="display: block;" src="{{ Voyager::image( $dataTypeContent->avatar ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                            @if($dataTypeContent->photo_coup)
                                                <img id="coup_photo" class="hide-all" style="display: none;" src="{{ Voyager::image( $dataTypeContent->photo_coup ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                            @else
                                                <img id="coup_photo" class="hide-all" style="display: none;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                            @endif

                                            @if($dataTypeContent->photo_child)
                                                <img id="child_photo" class="hide-all" style="display: none;" src="{{ Voyager::image( $dataTypeContent->photo_child ) }}" alt="Avatar"/>
                                            @else
                                                <img id="child_photo" class="hide-all" style="display: none;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="Default avatar"/>
                                            @endif
                                        <!-- Second Child photo -->
                                            @if($dataTypeContent->second_child_photo)
                                                <img id="child_photo_s" class="hide-all" style="display: none;" src="{{ Voyager::image( $dataTypeContent->second_child_photo ) }}" alt=" Avatar"/>
                                            @else
                                                <img id="child_photo_s" class="hide-all" style="display: none;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="Default avatar"/>
                                            @endif
                                        <!-- Third Child photo -->
                                            @if($dataTypeContent->third_child_photo)
                                                <img id="child_photo_t" class="hide-all" style="display: none;" src="{{ Voyager::image( $dataTypeContent->third_child_photo ) }}" alt="Avatar"/>
                                            @else
                                                <img id="child_photo_t" class="hide-all" style="display: none;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="Default avatar"/>
                                            @endif
                                        <!-- Fourth Child photo -->
                                            @if($dataTypeContent->third_child_photo)
                                                <img id="child_photo_f" class="hide-all" style="display: none;" src="{{ Voyager::image( $dataTypeContent->fourth_child_photo ) }}" alt="Avatar"/>
                                            @else
                                                <img id="child_photo_f" class="hide-all" style="display: none;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="Default avatar"/>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span id="client_name" class="hide-all" style="display: block;" class="m-card-profile__name">{{ $dataTypeContent->name }}</span>
                                        <a id="client_email" class="hide-all" style="display: block;" href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email }}</a>

                                        <span id="coup_name" class="hide-all" style="display: none;" class="m-card-profile__name">{{ $dataTypeContent->first_name_coup }}</span>
                                        <a id="coup_email" class="hide-all" style="display: none;" href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email_coup }}</a>

                                        <span id="child_name" class="hide-all" style="display: none;" class="m-card-profile__name">{{ $dataTypeContent->first_name_child }}</span>
                                        <a id="child_email" class="hide-all" style="display: none;" href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email_child }}</a>

                                        <span id="child_name_s" class="hide-all" style="display: none;" class="m-card-profile__name">@if(isset(json_decode($dataTypeContent->second_child)->first_name)){{ json_decode($dataTypeContent->second_child)->first_name }}@endif</span>
                                        @if($dataTypeContent->fourth_child_emails != null)
                                            @for($i = 0; $i < 1;$i++)
                                                <a id="child_email_s" class="hide-all" style="display: none;" href="" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->second_child_emails)[$i]->email }}</a>
                                            @endfor
                                        @endif
                                    <!-- Third Child photo -->
                                        <span id="child_name_t" class="hide-all" style="display: none;" class="m-card-profile__name">@if(isset(json_decode($dataTypeContent->third_child)->first_name)){{ json_decode($dataTypeContent->third_child)->first_name }}@endif</span>
                                        @if($dataTypeContent->third_child_emails != null)
                                            @for($i = 0; $i < 1;$i++)
                                                <a id="child_email_t" class="hide-all" style="display: none;" href="" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->third_child_emails)[$i]->email }}</a>
                                            @endfor
                                        @endif
                                    <!-- Fourth Child photo -->
                                        <span id="child_name_f" class="hide-all" style="display: none;" class="m-card-profile__name">@if(isset(json_decode($dataTypeContent->fourth_child)->first_name)){{ json_decode($dataTypeContent->fourth_child)->first_name }}@endif</span>
                                        @if($dataTypeContent->fourth_child_emails != null)
                                            @for($i = 0; $i < 1;$i++)
                                                <a id="child_email_f" class="hide-all" style="display: none;" href="" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->fourth_child_emails)[$i]->email }}</a>
                                            @endfor
                                        @endif
                                    </div>
                                </div>
                                <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="{{ URL::to('admin/posts') }}?client_id={{$dataTypeContent->id}}" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-signs-1"></i>
                                            <span class="m-nav__link-text">
                                                Biens immobilier
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="m-portlet__body-separator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xl-9">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a id="client" class="nav-link m-tabs__link active" data-toggle="tab" href="#profile_info_client" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                {{ $dataTypeContent->name }}
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a id="client_spouse" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_spouse" role="tab"  aria-expanded="false">
                                                <i class="flaticon-share m--hide"></i>
                                                Epoux/Epouse
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child" role="tab"  aria-expanded="false">
                                                <i class="flaticon-share m--hide"></i>
                                                Enfant
                                            </a>
                                        </li>
                                        @if(!empty(json_decode($dataTypeContent->second_child)->first_name))
                                            <li class="nav-item m-tabs__item" id="child_tab_0">
                                                <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_0" role="tab"  aria-expanded="false">
                                                    <i class="flaticon-share m--hide"></i>
                                                    Enfant(2)
                                                    <button href="#" id="0" class="remove_children_tab"><i class="la la-close"></i></button>
                                                </a>
                                            </li>
                                        @endif

                                        @if(!empty(json_decode($dataTypeContent->third_child)->first_name))
                                            <li class="nav-item m-tabs__item" id="child_tab_1">
                                                <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_1" role="tab"  aria-expanded="false">
                                                    <i class="flaticon-share m--hide"></i>
                                                    Enfant(3)
                                                    <button href="#" id="1" class="remove_children_tab"><i class="la la-close"></i></button>
                                                </a>
                                            </li>
                                        @endif

                                        @if(!empty(json_decode($dataTypeContent->fourth_child)->first_name))
                                            <li class="nav-item m-tabs__item" id="child_tab_2" >
                                                <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_2" role="tab"  aria-expanded="false">
                                                    <i class="flaticon-share m--hide"></i>
                                                    Enfant(4)
                                                    <button href="#" id="2" class="remove_children_tab"><i class="la la-close"></i></button>
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 m--align-right">
                                    <button id="add_new_child" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill" style="margin: 15px 15px 0;">
                                        <span>
                                            <i class="la la-cart-plus"></i>
                                            <span>
                                                Nouveau Enfant
                                            </span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                            <form class="m-form m-form--fit m-form--label-align-right form-edit-add m-form--group-seperator-dashed"
                                  action="{{ route('voyager.users.update', $dataTypeContent->id) }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">
                                <!-- PUT Method if we are editing -->
                            @if(isset($dataTypeContent->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <input type="hidden" name="role_id" value="5">
                                <div class="tab-content">
                                    <input type="hidden" name="type_clients" value="Clients">
                                    <div class="tab-pane active" id="profile_info_client" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Client</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="select_civil" name="civility" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility) && $dataTypeContent->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Sélectionner la langu">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="name" type="text" name="name" placeholder="Nom" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Second prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Second prénom" value="{{ ($dataTypeContent->middle_name) ? $dataTypeContent->middle_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Prenom" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="avatar" type="file" accept="image/*" id="avatar" class="input_file">
                                                            <label for="avatar">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status) && $dataTypeContent->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Nationalité">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Date de naissance" name="birth_date" value="{{ ($dataTypeContent->birth_date) ? date("d.m.Y", strtotime($dataTypeContent->birth_date)) : '' }}">
                                                        {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" type="text" placeholder="Lieu de naissance" name="birthplace" value="{{ ($dataTypeContent->birthplace) ? $dataTypeContent->birthplace : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ ($dataTypeContent->profession) ? $dataTypeContent->profession : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ ($dataTypeContent->service) ? $dataTypeContent->service : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="business" type="text" placeholder="Entreprise" name="business" value="{{ ($dataTypeContent->business) ? $dataTypeContent->business : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website" type="text" placeholder="Site Internet" name="website" value="{{ ($dataTypeContent->website) ? $dataTypeContent->website : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="email_container">
                                                <div class="m-form__group row" id="client_email">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de courriel</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Type de courriel">
                                                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                        <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type) && $dataTypeContent->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4">
                                                                <label class="">Courriel</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="email" type="text" placeholder="Courriel" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->client_emails))
                                                        @foreach(json_decode($dataTypeContent->client_emails) as $key => $client_email)
                                                            <div class="col-sm-12" id="client_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="client_email_type[]" id="client_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($client_email->email_type) && $client_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="client_email" type="text" placeholder="Courriel" name="client_emails[]" value="{{ ($client_email->email) ? $client_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="offset-md-2 col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_client_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_client_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <div class="m-form__group row client" id="client_phone" style="padding-bottom: 10px">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de téléphone</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type" id="phone_type" data-placeholder="Phone type">
                                                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                                        <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-2">
                                                                <label class="">Indicatif</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Indicatif" name="country_code" value="{{ ($dataTypeContent->country_code) ? $dataTypeContent->country_code : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4">
                                                                <label class="">Téléphone</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Téléphone" name="phone" value="{{ ($dataTypeContent->phone) ? $dataTypeContent->phone : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->client_phones))
                                                        @foreach(json_decode($dataTypeContent->client_phones) as $key => $client_phone)
                                                            <div class="col-sm-12" id="client_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="client_phone_type[]" id="client_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($client_phone->phone_type) && $client_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="client_country_code" type="text" placeholder="Indicatif" name="client_country_code[]" value="{{ ($client_phone->country_code) ? $client_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="client_phones" type="text" placeholder="Téléphone" name="client_phones[]" value="{{ ($client_phone->phone) ? $client_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_client_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_client_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact) && $dataTypeContent->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{--address block--}}
                                            <div id="address_container">
                                                @if(!empty(json_decode($dataTypeContent->address)))
                                                    @foreach (json_decode($dataTypeContent->address) as $key => $address)
                                                        <div class="m-form__group row address_form_group" id="address_form_{{ $key }}">
                                                            <div class="col-lg-{{ ($key != 0) ? '10' : '12' }} ">
                                                                <label>Nom de l’adresse</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control m-input" name="address_name[]" value="{{ (isset($address->address_name)) ? $address->address_name : '' }}" placeholder="Entrer votre nom de l’adresse">
                                                                </div>
                                                            </div>
                                                            @if($key != 0)
                                                                <div class="col-md-2 ">
                                                                    <button id="{{ $key }}" type="button" class="btn btn-danger remove_address_btn" style="margin-top: 24px; width: 100%;">Effacer</button>
                                                                </div>
                                                            @endif
                                                            <div class="col-lg-8 ">
                                                                <label>Adresse</label>
                                                                <div class="m-input-icon m-input-icon--right input-group">
                                                                    <input type="text" id="autocomplete_{{ $key }}" class="form-control m-input autocomplete_input switchable_form_item" name="address[]" value="{{ (isset($address->address)) ? $address->address : '' }}" placeholder="Entrer votre adresse" onFocus="geolocate()">
                                                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-map-marker"></i>
                                                                    </span>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-4 ">
                                                                <button type="button" id="open_map_btn_1" class="btn btn-secondary open_map_btn switchable_form_item" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 28px; width: 100%;">Placer l’adresse sur la carte</button>
                                                            </div>

                                                            {{--<div class="col-sm-12 col-md-3 ">--}}
                                                            {{--<label>Rue</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input type="text" id="route_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Rue" value="{{ (isset($address->street)) ? $address->street : '' }}" name="street[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-2 ">--}}
                                                            {{--<label>N°</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input type="text" id="street_number_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="N°" value="{{ (isset($address->number)) ? $address->number : '' }}" name="number[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-2 ">--}}
                                                            {{--<label>CP</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input type="number" min="0" class="form-control m-input switchable_form_item" placeholder="CP" value="{{ (isset($address->po_box)) ? $address->po_box : '' }}" name="po_box[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-2 ">--}}
                                                            {{--<label>NPA</label>--}}
                                                            {{--<input type="text" id="postal_code_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="NPA" value="{{ (isset($address->zip_code)) ? $address->zip_code : '' }}" name="zip_code[]">--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-3 ">--}}
                                                            {{--<label>Ville</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input type="text" id="locality_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Ville" value="{{ (isset($address->town)) ? $address->town : '' }}" name="town[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-3 ">--}}
                                                            {{--<label>Pays</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input type="text" id="country_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Pays" value="{{ (isset($address->country)) ? $address->country : '' }}" name="country[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-3">--}}
                                                            {{--<label>Longitude</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input disabled="disabled" type="number" min="0" id="longitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->longitude)) ? $address->longitude : '' }}" name="longitude[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-3">--}}
                                                            {{--<label>Latitude</label>--}}
                                                            {{--<div class="input-group">--}}
                                                            {{--<input disabled="disabled" type="number" min="0" id="latitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->latitude)) ? $address->latitude : '' }}" name="latitude[]">--}}
                                                            {{--</div>--}}
                                                            {{--</div>--}}
                                                            {{--<div class="col-sm-12 col-md-3 ">--}}
                                                            {{--<label>Localisation</label>--}}
                                                            {{--<select class="form-control m-select2 custom_select2 switchable_form_item" name="location[]" data-placeholder="Select Location">--}}
                                                            {{--@foreach(TCG\Voyager\Models\Location::all() as $location)--}}
                                                            {{--<option value="{{ $location->reference }}" @if(isset($address->location) && $address->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>--}}
                                                            {{--@endforeach--}}
                                                            {{--</select>--}}
                                                            {{--</div>--}}
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="m-form__group row address_form_group" id="address_form_1">
                                                        <div class="col-lg-12 ">
                                                            <label>Nom de l’adresse</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre nom de l’adresse">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-8 ">
                                                            <label>Adresse</label>
                                                            <div class="m-input-icon m-input-icon--right input-group">
                                                                <input type="text" id="autocomplete_1" disabled="disabled" class="form-control m-input autocomplete_input switchable_form_item" name="address[]"  placeholder="Entrer votre adresse" onFocus="geolocate()">
                                                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                                            <span>
                                                                <i class="la la-map-marker"></i>
                                                            </span>
                                                        </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-4 ">
                                                            <button type="button" id="open_map_btn_1" disabled="disabled" class="btn btn-secondary open_map_btn switchable_form_item" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 28px; width: 100%;">Placer l’adresse sur la carte</button>
                                                        </div>

                                                        {{--<div class="col-sm-12 col-md-3 ">--}}
                                                        {{--<label>Rue</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="text" id="route_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Rue"  name="street[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-2 ">--}}
                                                        {{--<label>N°</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="text" id="street_number_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="N°" name="number[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-2 ">--}}
                                                        {{--<label>CP</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="number" min="0" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="CP" name="po_box[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-2 ">--}}
                                                        {{--<label>NPA</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="text" id="postal_code_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="NPA"  name="zip_code[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-3 ">--}}
                                                        {{--<label>Ville</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="text" id="locality_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Ville"  name="town[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-3 ">--}}
                                                        {{--<label>Pays</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input type="text" id="country_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Pays"  name="country[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-3">--}}
                                                        {{--<label>Longitude</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input disabled="disabled" type="number" min="0" id="longitude_1" class="form-control m-input" placeholder="Longitude" name="longitude[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-3">--}}
                                                        {{--<label>Latitude</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<input disabled="disabled" type="number" min="0" id="latitude_1" class="form-control m-input" placeholder="Longitude" name="latitude[]">--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                        {{--<div class="col-sm-12 col-md-3 ">--}}
                                                        {{--<label>Localisation</label>--}}
                                                        {{--<div class="input-group">--}}
                                                        {{--<select class="form-control m-select2 custom_select2 switchable_form_item" disabled="disabled" name="location[]" data-placeholder="Select Location">--}}
                                                        {{--@foreach(TCG\Voyager\Models\Location::all() as $location)--}}
                                                        {{--<option value="{{ $location->reference }}">{{ $location->value }}</option>--}}
                                                        {{--@endforeach--}}
                                                        {{--</select>--}}
                                                        {{--</div>--}}
                                                        {{--</div>--}}
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_address" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle adresse </button>
                                                </div>
                                            </div>
                                            @if(Auth::user()->role_id != 5)
                                                <div class="form-group m-form__group row">
                                                    <div class="col-sm-12 ">
                                                        <label class="">Informations sur le client</label>
                                                        <div class="input-group">
                                                            <textarea class="form-control m-input" name="user_info" cols="30" rows="7">{{ ($dataTypeContent->user_info) ? $dataTypeContent->user_info : '' }}</textarea>
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_spouse" role="tabpanel" aria-expanded="false">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Epoux/Epouse</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civility_coup" id="civility_coup" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_coup) && $dataTypeContent->civility_coup == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_coup" id="lng_corres_coup"  data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_coup) && $dataTypeContent->lng_corres_coup == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="first_name_coup" type="text" name="first_name_coup" placeholder="Nom" value="{{ ($dataTypeContent->first_name_coup) ? $dataTypeContent->first_name_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Deuxième prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name_coup" type="text" name="middle_name_coup" placeholder="Deuxième prénom" value="{{ ($dataTypeContent->middle_name_coup) ? $dataTypeContent->middle_name_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name_coup" type="text" name="last_name_coup" placeholder="Prenom" value="{{ ($dataTypeContent->last_name_coup) ? $dataTypeContent->last_name_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="photo_coup" type="file" accept="image/*" id="photo_coup" class="input_file">
                                                            <label for="photo_coup">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-sm-12 col-md-4 ">--}}
                                                {{--@if($dataTypeContent->photo_coup != null)--}}
                                                {{--<img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->photo_coup ) }}" alt="{{ $dataTypeContent->name }} avatar"/>--}}
                                                {{--@else--}}
                                                {{--<img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default coup avatar"/>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_coup" id="civil_status_coup" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_coup) && $dataTypeContent->civil_status_coup == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_coup" name="nationality_coup" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date_coup" type="text" placeholder="Date de naissance" name="birth_date_coup" value="{{ ($dataTypeContent->birth_date_coup) ? date("d.m.Y", strtotime($dataTypeContent->birth_date_coup)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="birthplace_coup" type="text" placeholder="Lieu de naissance" name="birthplace_coup" value="{{ ($dataTypeContent->birthplace_coup) ? $dataTypeContent->birthplace_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="profession_coup" type="text" placeholder="Profession" name="profession_coup" value="{{ ($dataTypeContent->profession_coup) ? $dataTypeContent->profession_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="service_coup" type="text" placeholder="Service" name="service_coup" value="{{ ($dataTypeContent->service_coup) ? $dataTypeContent->service_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="business_coup" type="text" placeholder="Entreprise" name="business_coup" value="{{ ($dataTypeContent->business_coup) ? $dataTypeContent->business_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website_coup" type="text" placeholder="Site Internet" name="website_coup" value="{{ ($dataTypeContent->website_coup) ? $dataTypeContent->website_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="email_container">
                                                <div class="m-form__group row" id="coup_email" style="padding-bottom: 10px;">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de courriel</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_coup" id="email_type_coup" data-placeholder="Type de courriel">
                                                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                        <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_coup) && $dataTypeContent->email_type_coup == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4">
                                                                <label class="">Courriel</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="email_coup" type="text" placeholder="Courriel" name="email_coup" value="{{ ($dataTypeContent->email_coup) ? $dataTypeContent->email_coup : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->coup_emails))
                                                        @foreach(json_decode($dataTypeContent->coup_emails) as $key => $coup_email)
                                                            <div class="col-sm-12" id="coup_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="coup_email_type[]" id="coup_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($coup_email->email_type) && $coup_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="coup_email" type="text" placeholder="Courriel" name="coup_emails[]" value="{{ ($coup_email->email) ? $coup_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_coup_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_coup_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <div class="m-form__group row client" id="coup_phone" style="padding-bottom: 10px;">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de téléphone</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_coup" id="phone_type_coup" data-placeholder="Phone type">
                                                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                        <option value="{{ $phone_type->reference }}" @if(isset($dataTypeContent->phone_type_coup) && $dataTypeContent->phone_type_coup == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-2">
                                                                <label class="">Indicatif</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="country_code_coup" type="text" placeholder="Indicatif" name="country_code_coup" value="{{ ($dataTypeContent->country_code_coup) ? $dataTypeContent->country_code_coup : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4">
                                                                <label class="">Téléphone</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="phone_coup" type="text" placeholder="Téléphone" name="phone_coup" value="{{ ($dataTypeContent->phone_coup) ? $dataTypeContent->phone_coup : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->coup_phones))
                                                        @foreach(json_decode($dataTypeContent->coup_phones) as $key => $coup_phone)
                                                            <div class="col-sm-12" id="coup_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="coup_phone_type[]" id="coup_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($coup_phone->phone_type) && $coup_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="coup_country_code" type="text" placeholder="Indicatif" name="coup_country_code[]" value="{{ ($coup_phone->country_code) ? $coup_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="coup_phones" type="text" placeholder="Téléphone" name="coup_phones[]" value="{{ ($coup_phone->phone) ? $coup_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_coup_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_coup_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_coup" id="preferred_means_contact_coup" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_coup) && $dataTypeContent->preferred_means_contact_coup == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child" role="tabpanel" aria-expanded="false">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Enfant</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civility_child" id="civility_child" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_child) && $dataTypeContent->civility_child == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_child" id="lng_corres_child" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_child) && $dataTypeContent->lng_corres_child == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="first_name_child" type="text" name="first_name_child" placeholder="Nom" value="{{ ($dataTypeContent->first_name_child) ? $dataTypeContent->first_name_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Deuxième prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name_child" type="text" name="middle_name_child" placeholder="Deuxième prénom" value="{{ ($dataTypeContent->middle_name_child) ? $dataTypeContent->middle_name_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name_child" type="text" name="last_name_child" placeholder="Prenom" value="{{ ($dataTypeContent->last_name_child) ? $dataTypeContent->last_name_child : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="photo_child" type="file" accept="image/*" id="photo_child" class="input_file">
                                                            <label for="photo_child">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-sm-12 col-md-2 ">--}}
                                                {{--@if($dataTypeContent->photo_coup != null)--}}
                                                {{--<img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->photo_child ) }}" alt="{{ $dataTypeContent->name }} avatar"/>--}}
                                                {{--@else--}}
                                                {{--<img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default child avatar"/>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_child" id="civil_status_child" data-placeholder="Etat civil">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_child) && $dataTypeContent->civil_status_child == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_child" name="nationality_child" data-placeholder="Nationalité">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality_child) && $dataTypeContent->nationality_child == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date_child" type="text" placeholder="Date de naissance" name="birth_date_child" value="{{ ($dataTypeContent->birth_date_child) ? date("d.m.Y", strtotime($dataTypeContent->birth_date_child)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="birthplace_child" type="text" placeholder="Lieu de naissance" name="birthplace_child" value="{{ ($dataTypeContent->birthplace_child) ? $dataTypeContent->birthplace_child : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="profession_child" type="text" placeholder="Profession" name="profession_child" value="{{ ($dataTypeContent->profession_child) ? $dataTypeContent->profession_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="service_child" type="text" placeholder="Service" name="service_child" value="{{ ($dataTypeContent->service_child) ? $dataTypeContent->service_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="example-text-input" type="text" placeholder="Entreprise" name="business_child" value="{{ ($dataTypeContent->business_child) ? $dataTypeContent->business_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website_child" type="text" placeholder="Site Internet" name="website_child" value="{{ ($dataTypeContent->website_child) ? $dataTypeContent->website_child : '' }}">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="email_container">
                                                <div class="m-form__group row" id="children_email" style="padding-bottom: 10px;">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de courriel</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_child" id="email_type_child" data-placeholder="Type de courriel">
                                                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                        <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_child) && $dataTypeContent->email_type_child == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4 form-group">
                                                                <label class="">Courriel</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="email_child" type="text" placeholder="Courriel" name="email_child" value="{{ ($dataTypeContent->email_child) ? $dataTypeContent->email_child : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->children_emails))
                                                        @foreach(json_decode($dataTypeContent->children_emails) as $key => $children_email)
                                                            <div class="col-sm-12" id="children_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="children_email_type[]" id="children_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($children_email->email_type) && $children_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="children_email" type="text" placeholder="Courriel" name="children_emails[]" value="{{ ($children_email->email) ? $children_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_children_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_children_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <div class="m-form__group row client" id="children_phone" style="padding-bottom: 10px;">
                                                    <div class="col-sm-12">
                                                        <div class="row">
                                                            <div class="col-sm-12 col-md-4">
                                                                <label class="">Type de téléphone</label>
                                                                <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_child" id="phone_type_child" data-placeholder="Phone type">
                                                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                        <option value="{{ $phone_type->reference }}" @if(isset($dataTypeContent->phone_type_child) && $dataTypeContent->phone_type_child == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-2">
                                                                <label class="">Indicatif</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="country_code_child" type="text" placeholder="Indicatif" name="country_code_child" value="{{ ($dataTypeContent->country_code_child) ? $dataTypeContent->country_code_child : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-sm-12 col-md-4">
                                                                <label class="">Téléphone</label>
                                                                <div class="input-group">
                                                                    <input class="form-control m-input" id="phone_child" type="text" placeholder="Téléphone" name="phone_child" value="{{ ($dataTypeContent->phone_child) ? $dataTypeContent->phone_child : '' }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty($dataTypeContent->children_phones))
                                                        @foreach(json_decode($dataTypeContent->children_phones) as $key => $children_phone)
                                                            <div class="col-sm-12" id="children_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="children_phone_type[]" id="children_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($children_phone->phone_type) && $children_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="children_country_code" type="text" placeholder="Indicatif" name="children_country_code[]" value="{{ (!empty($children_phone->country_code)) ? $children_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="children_phones" type="text" placeholder="Téléphone" name="children_phones[]" value="{{ (!empty($children_phone->phone)) ? $children_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <button id="{{ $key }}" type="button" class="btn btn-danger remove_children_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_children_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_child" id="preferred_means_contact_child" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_child) && $dataTypeContent->preferred_means_contact_child == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child_0" role="tabpanel" aria-expanded="false">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Enfant(2)</h3>
                                                </div>
                                            </div>
                                            <input type="hidden" name="second_child" value="second_child">
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_civility" id="second_child_civility" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset(json_decode($dataTypeContent->second_child)->civility) && json_decode($dataTypeContent->second_child)->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_language" id="second_child_language" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset(json_decode($dataTypeContent->second_child)->lng_corres) && json_decode($dataTypeContent->second_child)->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input created_child_name" id="second_child_name" type="text" name="second_child_name" placeholder="Nom" value="{{ (!empty(json_decode($dataTypeContent->second_child)->first_name)) ? json_decode($dataTypeContent->second_child)->first_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Deuxième prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_middle_name" type="text" name="second_child_middle_name" placeholder="Deuxième prénom" value="{{ (!empty(json_decode($dataTypeContent->second_child)->middle_name)) ? json_decode($dataTypeContent->second_child)->middle_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_last_name" type="text" name="second_child_last_name" placeholder="Prenom" value="{{ (!empty(json_decode($dataTypeContent->second_child)->last_name)) ? json_decode($dataTypeContent->second_child)->last_name : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="second_child_photo" type="file" accept="image/*" id="second_child_photo" class="input_file">
                                                            <label for="second_child_photo">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-sm-12 col-md-2 ">--}}
                                                {{--@if(!empty($dataTypeContent->second_child_photo))--}}
                                                {{--<img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->second_child_photo) }}" alt="avatar"/>--}}
                                                {{--@else--}}
                                                {{--<img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default child avatar"/>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_civil_status" id="second_child_civil_status" data-placeholder="Etat civil">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset(json_decode($dataTypeContent->second_child)->civil_status) && json_decode($dataTypeContent->second_child)->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="second_child_nationality" name="second_child_nationality" data-placeholder="Nationalité">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset(json_decode($dataTypeContent->second_child)->nationality) && json_decode($dataTypeContent->second_child)->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="second_child_birth_date" type="text" placeholder="Date de naissance" name="second_child_birth_date" value="{{ (!empty(json_decode($dataTypeContent->second_child)->birth_date)) ? date("d.m.Y", strtotime(json_decode($dataTypeContent->second_child)->birth_date)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_birthplace" type="text" placeholder="Lieu de naissance" name="second_child_birthplace" value="{{ (!empty(json_decode($dataTypeContent->second_child)->birthplace)) ? json_decode($dataTypeContent->second_child)->birthplace : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_profession" type="text" placeholder="Profession" name="second_child_profession" value="{{ (!empty(json_decode($dataTypeContent->second_child)->profession)) ? json_decode($dataTypeContent->second_child)->profession : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_service" type="text" placeholder="Service" name="second_child_service" value="{{ (!empty(json_decode($dataTypeContent->second_child)->service)) ? json_decode($dataTypeContent->second_child)->service : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_business" type="text" placeholder="Entreprise" name="second_child_business" value="{{ (!empty(json_decode($dataTypeContent->second_child)->business)) ? json_decode($dataTypeContent->second_child)->business : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="second_child_website" type="text" placeholder="Site Internet" name="second_child_website" value="{{ (!empty(json_decode($dataTypeContent->second_child)->website)) ? json_decode($dataTypeContent->second_child)->website : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="email_container">
                                                <input type="hidden" name="second_child_emails" value="second_child_emails">
                                                <div class="m-form__group row" id="second_child_email" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->second_child_emails)))
                                                        @foreach(json_decode($dataTypeContent->second_child_emails) as $key => $children_email)
                                                            <div class="col-sm-12" id="second_child_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_emails_email_type[]" id="second_child_emails_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($children_email->email_type) && $children_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="second_child_emails_emails" type="text" placeholder="Courriel" name="second_child_emails_emails[]" value="{{ (!empty($children_email->email)) ? $children_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_second_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de courriel</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_emails_email_type[]" id="second_child_emails_email_type" data-placeholder="Type de courriel">
                                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                            <option value="{{ $email_type->reference }}" >{{ $email_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Courriel</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="second_child_emails_emails" type="text" placeholder="Courriel" name="second_child_emails_emails[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_second_child_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <input type="hidden" name="second_child_phones" value="second_child_phones">
                                                <div class="m-form__group row client" id="second_child_phone" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->second_child_phones)))
                                                        @foreach(json_decode($dataTypeContent->second_child_phones) as $key => $children_phone)
                                                            <div class="col-sm-12" id="second_child_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_phones_phone_type[]" id="second_child_phones_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($children_phone->phone_type) && $children_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="second_child_phones_country_code" type="text" placeholder="Indicatif" name="second_child_phones_country_code[]" value="{{ (!empty($children_phone->country_code)) ? $children_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="second_child_phones_phones" type="text" placeholder="Téléphone" name="second_child_phones_phones[]" value="{{ (!empty($children_phone->phone)) ? $children_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_second_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de téléphone</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_phones_phone_type[]" id="second_child_phones_phone_type" data-placeholder="Phone type">
                                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                            <option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2">
                                                                    <label class="">Indicatif</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="second_child_phones_country_code" type="text" placeholder="Indicatif" name="second_child_phones_country_code[]">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Téléphone</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="second_child_phones_phones" type="text" placeholder="Téléphone" name="second_child_phones_phones[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_second_child_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="second_child_preferred_means_contact" id="second_child_preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(json_decode($dataTypeContent->second_child)->preferred_means_contact) && json_decode($dataTypeContent->second_child)->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child_1" role="tabpanel" aria-expanded="false">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Enfant(3)</h3>
                                                </div>
                                            </div>
                                            <input type="hidden" name="third_child" value="third_child">
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_civility" id="third_child_civility" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset(json_decode($dataTypeContent->third_child)->civility) && json_decode($dataTypeContent->third_child)->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_language" id="third_child_language" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset(json_decode($dataTypeContent->third_child)->lng_corres) && json_decode($dataTypeContent->third_child)->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input created_child_name" id="third_child_name" type="text" name="third_child_name" placeholder="Nom" value="{{ (!empty(json_decode($dataTypeContent->third_child)->first_name)) ? json_decode($dataTypeContent->third_child)->first_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Deuxième prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_middle_name" type="text" name="third_child_middle_name" placeholder="Deuxième prénom" value="{{ (!empty(json_decode($dataTypeContent->third_child)->middle_name)) ? json_decode($dataTypeContent->third_child)->middle_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_last_name" type="text" name="third_child_last_name" placeholder="Prenom" value="{{ (!empty(json_decode($dataTypeContent->third_child)->last_name)) ? json_decode($dataTypeContent->third_child)->last_name : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="third_child_photo" type="file" accept="image/*" id="third_child_photo" class="input_file">
                                                            <label for="third_child_photo">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-sm-12 col-md-2 ">--}}
                                                {{--@if(!empty($dataTypeContent->third_child_photo))--}}
                                                {{--<img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->third_child_photo) }}" alt="{{ !empty(json_decode($dataTypeContent->third_child)->name) ? json_decode($dataTypeContent->third_child)->name : '' }} avatar"/>--}}
                                                {{--@else--}}
                                                {{--<img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default child avatar"/>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_civil_status" id="third_child_civil_status" data-placeholder="Etat civil">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset(json_decode($dataTypeContent->third_child)->civil_status) && json_decode($dataTypeContent->third_child)->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="third_child_nationality" name="third_child_nationality" data-placeholder="Nationalité">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset(json_decode($dataTypeContent->third_child)->nationality) && json_decode($dataTypeContent->third_child)->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="third_child_birth_date" type="text" placeholder="Date de naissance" name="third_child_birth_date" value="{{ (!empty(json_decode($dataTypeContent->third_child)->birth_date)) ? date("d.m.Y", strtotime(json_decode($dataTypeContent->third_child)->birth_date)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_birthplace" type="text" placeholder="Lieu de naissance" name="third_child_birthplace" value="{{ (!empty(json_decode($dataTypeContent->third_child)->birthplace)) ? json_decode($dataTypeContent->third_child)->birthplace : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_profession" type="text" placeholder="Profession" name="third_child_profession" value="{{ (!empty(json_decode($dataTypeContent->third_child)->profession)) ? json_decode($dataTypeContent->third_child)->profession : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_service" type="text" placeholder="Service" name="third_child_service" value="{{ (!empty(json_decode($dataTypeContent->third_child)->service)) ? json_decode($dataTypeContent->third_child)->service : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_business" type="text" placeholder="Entreprise" name="third_child_business" value="{{ (!empty(json_decode($dataTypeContent->third_child)->business)) ? json_decode($dataTypeContent->third_child)->business : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="third_child_website" type="text" placeholder="Site Internet" name="third_child_website" value="{{ (!empty(json_decode($dataTypeContent->third_child)->website)) ? json_decode($dataTypeContent->third_child)->website : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="email_container">
                                                <input type="hidden" name="third_child_emails" value="third_child_emails">
                                                <div class="m-form__group row" id="third_child_email" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->third_child_emails)))
                                                        @foreach(json_decode($dataTypeContent->third_child_emails) as $key => $children_email)
                                                            <div class="col-sm-12" id="third_child_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_emails_email_type[]" id="third_child_emails_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($children_email->email_type) && $children_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="third_child_emails_emails" type="text" placeholder="Courriel" name="third_child_emails_emails[]" value="{{ (!empty($children_email->email)) ? $children_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_third_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de courriel</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_emails_email_type[]" id="third_child_emails_email_type" data-placeholder="Type de courriel">
                                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                            <option value="{{ $email_type->reference }}" >{{ $email_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Courriel</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="third_child_emails_emails" type="text" placeholder="Courriel" name="third_child_emails_emails[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_third_child_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <input type="hidden" name="third_child_phones" value="third_child_phones">
                                                <div class="m-form__group row client" id="third_child_phone" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->third_child_phones)))
                                                        @foreach(json_decode($dataTypeContent->third_child_phones) as $key => $children_phone)
                                                            <div class="col-sm-12" id="third_child_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_phones_phone_type[]" id="third_child_phones_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($children_phone->phone_type) && $children_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="third_child_phones_country_code" type="text" placeholder="Indicatif" name="third_child_phones_country_code[]" value="{{ (!empty($children_phone->country_code)) ? $children_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="third_child_phones_phones" type="text" placeholder="Téléphone" name="third_child_phones_phones[]" value="{{ (!empty($children_phone->phone)) ? $children_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_third_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de téléphone</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_phones_phone_type[]" id="third_child_phones_phone_type" data-placeholder="Phone type">
                                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                            <option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2">
                                                                    <label class="">Indicatif</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="third_child_phones_country_code" type="text" placeholder="Indicatif" name="third_child_phones_country_code[]">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Téléphone</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="third_child_phones_phones" type="text" placeholder="Téléphone" name="third_child_phones_phones[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_third_child_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="third_child_preferred_means_contact" id="third_child_preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(json_decode($dataTypeContent->third_child)->preferred_means_contact) && json_decode($dataTypeContent->third_child)->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child_2" role="tabpanel" aria-expanded="false">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Enfant(4)</h3>
                                                </div>
                                            </div>
                                            <input type="hidden" name="fourth_child" value="fourth_child">
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label>Civilité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_civility" id="fourth_child_civility" data-placeholder="Civilité">
                                                            @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                                <option value="{{ $civility->reference }}" @if(isset(json_decode($dataTypeContent->fourth_child)->civility) && json_decode($dataTypeContent->fourth_child)->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_language" id="fourth_child_language" data-placeholder="Sélectionner la langue">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset(json_decode($dataTypeContent->fourth_child)->lng_corres) && json_decode($dataTypeContent->fourth_child)->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input created_child_name" id="fourth_child_name" type="text" name="fourth_child_name" placeholder="Nom" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->first_name)) ? json_decode($dataTypeContent->fourth_child)->first_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Deuxième prénom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_middle_name" type="text" name="fourth_child_middle_name" placeholder="Deuxième prénom" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->middle_name)) ? json_decode($dataTypeContent->fourth_child)->middle_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_last_name" type="text" name="fourth_child_last_name" placeholder="Prenom" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->last_name)) ? json_decode($dataTypeContent->fourth_child)->last_name : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Image</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="fourth_child_photo" type="file" accept="image/*" id="fourth_child_photo" class="input_file">
                                                            <label for="fourth_child_photo">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="col-sm-12 col-md-2 ">--}}
                                                {{--@if(!empty($dataTypeContent->fourth_child_photo))--}}
                                                {{--<img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->fourth_child_photo) }}" alt="{{ !empty(json_decode($dataTypeContent->fourth_child)->name) ? json_decode($dataTypeContent->fourth_child)->name : '' }} avatar"/>--}}
                                                {{--@else--}}
                                                {{--<img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default child avatar"/>--}}
                                                {{--@endif--}}
                                                {{--</div>--}}
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Etat civil</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_civil_status" id="fourth_child_civil_status" data-placeholder="Etat civil">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset(json_decode($dataTypeContent->fourth_child)->civil_status) && json_decode($dataTypeContent->fourth_child)->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationalité</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="fourth_child_nationality" name="fourth_child_nationality" data-placeholder="Nationalité">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset(json_decode($dataTypeContent->fourth_child)->nationality) && json_decode($dataTypeContent->fourth_child)->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Date de naissance</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="fourth_child_birth_date" type="text" placeholder="Date de naissance" name="fourth_child_birth_date" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->birth_date)) ? date("d.m.Y", strtotime(json_decode($dataTypeContent->fourth_child)->birth_date)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Lieu de naissance</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_birthplace" type="text" placeholder="Lieu de naissance" name="fourth_child_birthplace" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->birthplace)) ? json_decode($dataTypeContent->fourth_child)->birthplace : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Profession</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_profession" type="text" placeholder="Profession" name="fourth_child_profession" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->profession)) ? json_decode($dataTypeContent->fourth_child)->profession : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Service</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_service" type="text" placeholder="Service" name="fourth_child_service" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->service)) ? json_decode($dataTypeContent->fourth_child)->service : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Entreprise</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_business" type="text" placeholder="Entreprise" name="fourth_child_business" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->business)) ? json_decode($dataTypeContent->fourth_child)->business : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Site Internet</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="fourth_child_website" type="text" placeholder="Site Internet" name="fourth_child_website" value="{{ (!empty(json_decode($dataTypeContent->fourth_child)->website)) ? json_decode($dataTypeContent->fourth_child)->website : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="email_container">
                                                <input type="hidden" name="fourth_child_emails" value="fourth_child_emails">
                                                <div class="m-form__group row" id="fourth_child_email" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->fourth_child_emails)))
                                                        @foreach(json_decode($dataTypeContent->fourth_child_emails) as $key => $children_email)
                                                            <div class="col-sm-12" id="fourth_child_email_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de courriel</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_emails_email_type[]" id="fourth_child_emails_email_type" data-placeholder="Type de courriel">
                                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                                <option value="{{ $email_type->reference }}" @if(isset($children_email->email_type) && $children_email->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Courriel</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="fourth_child_emails_emails" type="text" placeholder="Courriel" name="fourth_child_emails_emails[]" value="{{ (!empty($children_email->email)) ? $children_email->email : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_fourth_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de courriel</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_emails_email_type[]" id="fourth_child_emails_email_type" data-placeholder="Type de courriel">
                                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                            <option value="{{ $email_type->reference }}" >{{ $email_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Courriel</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="fourth_child_emails_emails" type="text" placeholder="Courriel" name="fourth_child_emails_emails[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_fourth_child_email" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle courriele </button>
                                                </div>
                                            </div>
                                            <div class="phone_container">
                                                <input type="hidden" name="fourth_child_phones" value="fourth_child_phones">
                                                <div class="m-form__group row client" id="fourth_child_phone" style="padding-bottom: 10px;">
                                                    @if(!empty(json_decode($dataTypeContent->fourth_child_phones)))
                                                        @foreach(json_decode($dataTypeContent->fourth_child_phones) as $key => $children_phone)
                                                            <div class="col-sm-12" id="fourth_child_phone_form_{{ $key }}">
                                                                <div class="row">
                                                                    <div class="col-sm-12 col-md-4">
                                                                        <label class="">Type de téléphone</label>
                                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_phones_phone_type[]" id="fourth_child_phones_phone_type" data-placeholder="Type de téléphone">
                                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                                <option value="{{ $phone_type->reference }}" @if(isset($children_phone->phone_type) && $children_phone->phone_type == $phone_type->reference){{ 'selected="selected"' }} @endif>{{ $phone_type->value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-2">
                                                                        <label class="">Indicatif</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="fourth_child_phones_country_code" type="text" placeholder="Indicatif" name="fourth_child_phones_country_code[]" value="{{ (!empty($children_phone->country_code)) ? $children_phone->country_code : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-sm-12 col-md-4">
                                                                        <label class="">Téléphone</label>
                                                                        <div class="input-group">
                                                                            <input class="form-control m-input" id="fourth_child_phones_phones" type="text" placeholder="Téléphone" name="fourth_child_phones_phones[]" value="{{ (!empty($children_phone->phone)) ? $children_phone->phone : '' }}">
                                                                        </div>
                                                                    </div>
                                                                    @if($key != 0)
                                                                        <div class="col-md-2">
                                                                            <button id="{{ $key }}" type="button" class="btn btn-danger remove_fourth_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="col-sm-12">
                                                            <div class="row">
                                                                <div class="col-sm-12 col-md-4">
                                                                    <label class="">Type de téléphone</label>
                                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_phones_phone_type[]" id="fourth_child_phones_phone_type" data-placeholder="Phone type">
                                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                            <option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-2">
                                                                    <label class="">Indicatif</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="fourth_child_phones_country_code" type="text" placeholder="Indicatif" name="fourth_child_phones_country_code[]">
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-sm-12 col-md-4">
                                                                    <label class="">Téléphone</label>
                                                                    <div class="input-group">
                                                                        <input class="form-control m-input" id="fourth_child_phones_phones" type="text" placeholder="Téléphone" name="fourth_child_phones_phones[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row" style="padding-top: 0">
                                                <div class="col-sm-12 col-md-4">
                                                    <button id="add_new_fourth_child_phone" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle téléphone </button>
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_preferred_means_contact" id="fourth_child_preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(json_decode($dataTypeContent->fourth_child)->preferred_means_contact) && json_decode($dataTypeContent->fourth_child)->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--<div class="tab-pane" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset($dataTypeContent->id))
                                                    <div class="col-sm-12 col-md-6 ">
                                                        <label class="">New password</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Change password" name="password">
                                                    </div>
                                                    <div class="col-sm-12 col-md-6 ">
                                                        <label class="">Confirm password</label>
                                                        <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirm password" name="password">
                                                    </div>
                                                @else
                                                    <div class="col-sm-12 col-md-6 ">
                                                        <label class="">Enter password</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Enter password" name="password">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>--}}
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-12 m--align-right">
                                                {{--<button type="reset" class="btn btn-danger m-btn m-btn--air m-btn--custom">--}}
                                                {{--Cancel--}}
                                                {{--</button>--}}
                                                <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ URL::to('admin/clients') }}">Annuler</a>
                                                &nbsp;&nbsp;
                                                <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
                                                    Sauver les modifications
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
    @else
        <div class="m-grid__item m-grid__item--fluid m-wrapper" style="">

            <!-- END: Subheader -->
            <div class="m-content">

                <!--begin::Form-->
                <form id="edit_create_clients" action="{{ URL::to('/admin/clients/create') }}" class="form-edit-add m-form m-form--group-seperator-dashed" role="form" method="POST">
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
                                                    Créer un client
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="form-group col-sm-12 col-md-6 col-lg-3 ">
                                                <label>Nom</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Nom" value="" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6 col-lg-3 ">
                                                <label>Prenom</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Prenom" value="" name="last_name">
                                                </div>
                                            </div>
                                            <div class="col-sm-12 col-md-6 col-lg-3 ">
                                                <label for="lng_corres">Langue de correspondance</label>
                                                <div class="input-group">
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="lng_corres" name="lng_corres" data-placeholder="Select Floor">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $lng)
                                                            <option value="{{ $lng->reference }}">{{ $lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6 col-lg-3 ">
                                                <label>Courriel</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Courriel" value="" name="email">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Portlet-->
                            </div>
                            <div class="col-lg-12 m--align-right">
                                <button type="submit" class="btn btn-primary btn-lg">Enregistrer</button>
                            </div>
                        </div>
                        <!-- End Adresse -->
                    </div>
                </form>
            </div>
        </div>
    @endif
@stop

@section('javascript')
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZhPguGsxnAK4WdGML3Qew_KMleHvRdzw&libraries=places&callback=initAutocomplete"async defer></script>
    <!--end::Google Maps -->

    <script>
        showSelectedFileName();
        var i = 1;
        $('#add_new_address').click(function(){
            i++;
            $('#address_container').append(
                '<div class="form-group m-form__group row address_form_group" id="address_form_' + i  + '">' +
                '<div class="col-md-10 ">' +
                '<label>Nom de l’adresse</label>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre nom de l’adresse">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-2 ">' +
                '<button id="' + i  + '" type="button" class="btn btn-danger remove_address_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '<div class="col-lg-8 ">' +
                '<label>Adresse</label>' +
                '<div class="m-input-icon m-input-icon--right input-group">' +
                '<input type="text" id="autocomplete_' + i  + '" disabled="disabled" class="form-control m-input autocomplete_input switchable_form_item" name="address[]" placeholder="Entrer votre adresse" onFocus="geolocate()">' +
                '<span class="m-input-icon__icon m-input-icon__icon--right">' +
                '<span>' +
                '<i class="la la-map-marker"></i>' +
                '</span>' +
                '</span>' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-4 ">' +
                '<button type="button" id="open_map_btn_' + i  + '" disabled="disabled" class="btn btn-secondary open_map_btn switchable_form_item" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 28px; width: 100%;">Placer l’adresse sur la carte</button>' +
                '</div>' +
                {{--'<div class="col-sm-12 col-md-3 ">' +--}}
                        {{--'<label>Rue</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="text" id="route_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Rue" name="street[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-2 ">' +--}}
                        {{--'<label>N°</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="text" id="street_number_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="N°" name="number[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-2 ">' +--}}
                        {{--'<label>CP</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="number" min="0" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="CP" name="po_box[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-2 ">' +--}}
                        {{--'<label>NPA</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="text" id="postal_code_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="NPA" name="zip_code[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-3 ">' +--}}
                        {{--'<label>Ville</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="text" id="locality_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Ville" name="town[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-3 ">' +--}}
                        {{--'<label>Pays</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input type="text" id="country_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Pays" name="country[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-3">' +--}}
                        {{--'<label>Longitude</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input disabled="disabled" type="number" min="0" id="longitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="longitude[]">' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-3">' +--}}
                        {{--'<label>Latitude</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<input disabled="disabled" type="number" min="0" id="latitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="latitude[]">' +--}}
                        {{--'</div> ' +--}}
                        {{--'</div>' +--}}
                        {{--'<div class="col-sm-12 col-md-3 ">' +--}}
                        {{--'<label>Localisation</label>' +--}}
                        {{--'<div class="input-group">' +--}}
                        {{--'<select class="form-control m-select2 custom_select2 switchable_form_item" disabled="disabled" name="location[]" data-placeholder="Select Location">' +--}}
                        {{--@foreach(TCG\Voyager\Models\Location::all() as $location)--}}
                        {{--'<option value="{{ $location->reference }}">{{ $location->value }}</option>' +--}}
                        {{--@endforeach--}}
                        {{--'</select>' +--}}
                        {{--'</div>' +--}}
                        {{--'</div>' +--}}
                    '</div>'
            );
            initAutocomplete();
            $("#address_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_address_btn', function(){
            var button_id = $(this).attr("id");
            $('#address_form_' + button_id).remove();
            initAutocomplete();
        });

        var n = 1;
        $('#add_new_client_email').click(function(){
            n++;
            $('.email_container > #client_email').append(
                '<div class="col-sm-12" id="client_email_form_' + n + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="client_email_type[]" id="client_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="client_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-offset-2 col-md-2">' +
                '<button id="' + n  + '" type="button" class="btn btn-danger remove_client_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_client_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#client_email_form_' + button_id).remove();
        });

        var c = 1;
        $('#add_new_coup_email').click(function(){
            c++;
            $('.email_container > #coup_email').append(
                '<div class="col-sm-12" id="coup_email_form_' + c + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="coup_email_type[]" id="coup_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="coup_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 offset-col-2 col-md-2">' +
                '<button id="' + c + '" type="button" class="btn btn-danger remove_coup_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_coup_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#coup_email_form_' + button_id).remove();
        });

        var che = 1;
        $('#add_new_children_email').click(function(){
            che++;
            $('.email_container > #children_email').append(
                '<div class="col-sm-12" id="children_email_form_' + che + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="children_email_type[]" id="children_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="children_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + che + '" type="button" class="btn btn-danger remove_children_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_children_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#children_email_form_' + button_id).remove();
        });

        var cnhe1 = 1;
        $('#add_new_second_child_email').click(function(){
            cnhe1++;
            $('.email_container > #second_child_email').append(
                '<div class="col-sm-12" id="second_child_email_form_' + cnhe1 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="second_child_emails_email_type[]" id="second_child_emails_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="second_child_emails_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhe1 + '" type="button" class="btn btn-danger remove_second_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_second_child_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#second_child_email_form_' + button_id).remove();
        });

        var cnhe2 = 1;
        $('#add_new_third_child_email').click(function(){
            cnhe2++;
            $('.email_container > #third_child_email').append(
                '<div class="col-sm-12" id="third_child_email_form_' + cnhe2 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="third_child_emails_email_type[]" id="third_child_emails_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="third_child_emails_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhe2 + '" type="button" class="btn btn-danger remove_third_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_third_child_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#third_child_email_form_' + button_id).remove();
        });

        var cnhe3 = 1;
        $('#add_new_fourth_child_email').click(function(){
            cnhe3++;
            $('.email_container > #fourth_child_email').append(
                '<div class="col-sm-12" id="fourth_child_email_form_' + cnhe3 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de courriel</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_emails_email_type[]" id="fourth_child_emails_email_type" data-placeholder="Type de courriel">'+
                '@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)'+
                '<option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Courriel</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Courriel" name="fourth_child_emails_emails[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhe3 + '" type="button" class="btn btn-danger remove_fourth_child_email_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".email_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_fourth_child_email_btn', function(){
            var button_id = $(this).attr("id");
            $('#fourth_child_email_form_' + button_id).remove();
        });

        var p = 1;
        $('#add_new_client_phone').click(function(){
            p++;
            $('.phone_container > #client_phone').append(
                '<div class="col-sm-12" id="client_phone_form_' + p + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="client_phone_type[]" id="client_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="client_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="client_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + p  + '" type="button" class="btn btn-danger remove_client_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_client_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#client_phone_form_' + button_id).remove();
        });

        var cp = 1;
        $('#add_new_coup_phone').click(function(){
            cp++;
            $('.phone_container > #coup_phone').append(
                '<div class="col-sm-12" id="coup_phone_form_' + cp + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="coup_phone_type[]" id="coup_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="coup_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="coup_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cp  + '" type="button" class="btn btn-danger remove_coup_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_coup_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#coup_phone_form_' + button_id).remove();
        });

        var chp = 1;
        $('#add_new_children_phone').click(function(){
            chp++;
            $('.phone_container > #children_phone').append(
                '<div class="col-sm-12" id="children_phone_form_' + chp + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="children_phone_type[]" id="children_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="children_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="children_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + chp  + '" type="button" class="btn btn-danger remove_children_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );

            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_children_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#children_phone_form_' + button_id).remove();
        });

        var cnhp1 = 1;
        $('#add_new_second_child_phone').click(function(){
            cnhp1++;
            $('.phone_container > #second_child_phone').append(
                '<div class="col-sm-12" id="second_child_phone_form_' + cnhp1 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="second_child_phones_phone_type[]" id="second_child_phones_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="second_child_phones_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="second_child_phones_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhp1  + '" type="button" class="btn btn-danger remove_second_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_second_child_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#second_child_phone_form_' + button_id).remove();
        });

        var cnhp2 = 1;
        $('#add_new_third_child_phone').click(function(){
            cnhp2++;
            $('.phone_container > #third_child_phone').append(
                '<div class="col-sm-12" id="third_child_phone_form_' + cnhp2 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="third_child_phones_phone_type[]" id="third_child_phones_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="third_child_phones_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="third_child_phones_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhp2  + '" type="button" class="btn btn-danger remove_third_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_third_child_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#third_child_phone_form_' + button_id).remove();
        });

        var cnhp3 = 1;
        $('#add_new_fourth_child_phone').click(function(){
            cnhp3++;
            $('.phone_container > #fourth_child_phone').append(
                '<div class="col-sm-12" id="fourth_child_phone_form_' + cnhp3 + '">'+
                '<div class="row">'+
                '<div class="col-sm-12 col-md-4">'+
                '<label class="">Type de téléphone</label>'+
                '<select class="form-control m-select2 custom_select2 elem-categories" name="fourth_child_phones_phone_type[]" id="fourth_child_phones_phone_type" data-placeholder="Type de téléphone">'+
                '@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)'+
                '<option value="{{ $phone_type->reference }}">{{ $phone_type->value }}</option>'+
                '@endforeach'+
                '</select>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-2">'+
                '<label class="">Indicatif</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Indicatif" name="fourth_child_phones_country_code[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="form-group col-sm-12 col-md-4">'+
                '<label class="">Téléphone</label>'+
                '<div class="input-group">'+
                '<input class="form-control m-input" type="text" placeholder="Téléphone" name="fourth_child_phones_phones[]" value="">'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 col-md-2">' +
                '<button id="' + cnhp3  + '" type="button" class="btn btn-danger remove_fourth_child_phone_btn" style="margin-top: 28px; width: 100%;">Effacer</button>' +
                '</div>' +
                '</div>'+
                '</div>'
            );
            $(".phone_container select.custom_select2").select2({minimumResultsForSearch: Infinity});
        });
        $(document).on('click', '.remove_fourth_child_phone_btn', function(){
            var button_id = $(this).attr("id");
            $('#fourth_child_phone_form_' + button_id).remove();
        });

        $('#add_new_child').click(function() {
            var all_items = $('.m-portlet__head-tools > .nav-tabs .remove_children_tab').length;
            var index;
            if(all_items <= 2) {
                if($("#child_tab_" + all_items).length == 0) {
                    index = all_items;
                } else if($("#child_tab_0").length == 0) {
                    index = 0;
                } else if($("#child_tab_1").length == 0) {
                    index = 1;
                } else if($("#child_tab_2").length == 0) {
                    index = 2;
                }
                var child_number = index+2;
                $('.m-portlet__head-tools > .nav-tabs').append(
                    '<li class="nav-item m-tabs__item" id="child_tab_' + index + '">' +
                    '<a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_' + index + '" role="tab"  aria-expanded="true">' +
                    '<i class="flaticon-share m--hide"></i>' +
                    'Enfant('+ child_number +') <button href="#" id="' + index + '" class="remove_children_tab"><i class="la la-close"></i></button>' +
                    '</a>' +
                    '</li>'
                );
                $('#profile_info_child_' + index + ' .created_child_name').attr('required', 'required')
            }

            $('a[href="#profile_info_child_' + index + '"]').click(function () {
                $('.hide-all').css('display', 'none');
                $('.m-card-profile__pic-wrapper').append(
                    '<img id="img_default'+index+'" class="hide-all default" style="display: block;" src="{{ Voyager::image( 'users/default.png' ) }}" alt="Default avatar"/>'
                );
            });

            $("#profile_info_child_" + all_items + " select.custom_select2").select2({minimumResultsForSearch: Infinity});

        });

        $(document).on('click', '.remove_children_tab', function(){
            var button_id = $(this).attr("id");
            $('#child_tab_' + button_id).remove();

            $('#profile_info_child_' + button_id + ' .created_child_name').attr('required', false)
            $('#profile_info_child_' + button_id + ' .m-form__group > .col-sm-12 .input-group input').attr('value', '');
            if(button_id === "2" || button_id === "1" || button_id === "0"){
                $('#client').trigger('click');
            }
        });

        $('button[type="submit"]').click(function() {
            setTimeout(function(){
                if($(document).find(".has-danger").length !== 0 ) {
                    var first_error_block_container_id = $(".has-danger:first").closest('.tab-pane').attr('id');
                    $('.nav-tabs .nav-link[href="#'+first_error_block_container_id+'"]').trigger('click');
                    console.log(first_error_block_container_id);
                }
            }, 1000);

        });

        $('.add_new_address').on('click', function () {
            var this_form_group = $(this).closest('.form-group');
            var new_form_group = document.createElement('div');
            console.log(new_form_group.classList);
            new_form_group.classList.add('form-group');
            new_form_group.classList.add('m-form__group');
            new_form_group.classList.add('row');
            new_form_group.innerHTML = this_form_group.html();
            new_form_group.
            $('.address_container').append(new_form_group);
        });

        function showSelectedFileName() {
            $( '.input_file' ).each( function()
            {
                var $input	 = $( this ),
                    $label	 = $input.next( 'label' ),
                    labelVal = $label.html();

                $input.on( 'change', function( e )
                {
                    var fileName = '';

                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else if( e.target.value )
                        fileName = e.target.value.split( '\\' ).pop();

                    if( fileName )
                        $label.find( 'span' ).html( fileName );
                    else
                        $label.html( labelVal );
                });
                $input.on( 'focus', function(){ $input.addClass( 'has-focus' ); });
                $input.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
            });
        }

        $(document).on("change paste keyup", "#address_container input[name='address_name[]']", function() {
            var this_container = $(this).closest('.address_form_group');
            if( !$(this).val() ) {
                this_container.find('.switchable_form_item').attr( "disabled", "disabled" );
            } else {
                this_container.find('.switchable_form_item').attr( "disabled", false );
            }
        });
    </script>
    <script>
        jQuery(document).ready(function () {

            jQuery.validator.addMethod("noSpace", function(value, element) {
                return $.trim(value) != "";
            }, "No space please and don't leave it empty");

            jQuery("#profile_edit_form").validate({
                rules: {
                    name: {
                        required: true
                    },
//                    second_child_name: {
//                        required: true
//                    },
//                    third_child_name: {
//                        required: true
//                    },
//                    fourth_child_name: {
//                        required: true
//                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    "client_emails[]": {
                        email: true
                    },
                    email_coup: {
                        email: true
                    },
                    "coup_emails[]": {
                        email: true
                    },
                    email_child: {
                        email: true
                    },
                    "children_emails[]": {
                        email: true
                    },
                    "second_child_emails_emails[]": {
                        email: true
                    },
                    "third_child_emails_emails[]": {
                        email: true
                    },
                    "fourth_child_emails_emails[]": {
                        email: true
                    },
                    phone: {
                        number: true,
                        maxlength: 15
                    },
                    "client_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    phone_coup: {
                        number: true,
                        maxlength: 15
                    },
                    "coup_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    phone_child: {
                        number: true,
                        maxlength: 15
                    },
                    "children_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    "second_child_phones_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    "third_child_phones_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    "fourth_child_phones_phones[]": {
                        number: true,
                        maxlength: 15
                    },
                    country_code: {
                        number: true,
                        maxlength: 15
                    },
                    "client_country_code[]": {
                        number: true,
                        maxlength: 15
                    },
                    country_code_coup: {
                        number: true,
                        maxlength: 15
                    },
                    "coup_country_code[]": {
                        number: true,
                        maxlength: 15
                    },
                    country_code_child: {
                        number: true,
                        maxlength: 15
                    },
                    "children_country_code[]": {
                        number: true,
                        maxlength: 15
                    },
                    "second_child_phones_country_code[]": {
                        number: true,
                        maxlength: 15
                    },
                    "third_child_phones_country_code[]": {
                        number: true,
                        maxlength: 15
                    },
                    "fourth_child_phones_country_code[]": {
                        number: true,
                        maxlength: 15
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            jQuery("#edit_create_clients").validate({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                rules: {
                    name: {
                        required: true,
                        noSpace: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true,
                        remote: {
                            url: "{{ URL::to('admin/clients/check-email') }}"
                        }
                    }
                },
                messages: {
                    email: {
                        remote: "Email already in use!"
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            /*
             * Translated default messages for the jQuery validation plugin.
             * Locale: FR (French; français)
             */
            $.extend( $.validator.messages, {
                required: "Ce champ est obligatoire.",
                remote: "Veuillez corriger ce champ.",
                email: "Veuillez fournir une adresse électronique valide.",
                url: "Veuillez fournir une adresse URL valide.",
                date: "Veuillez fournir une date valide.",
                dateISO: "Veuillez fournir une date valide (ISO).",
                number: "Veuillez fournir un numéro valide.",
                digits: "Veuillez fournir seulement des chiffres.",
                creditcard: "Veuillez fournir un numéro de carte de crédit valide.",
                equalTo: "Veuillez fournir encore la même valeur.",
                notEqualTo: "Veuillez fournir une valeur différente, les valeurs ne doivent pas être identiques.",
                extension: "Veuillez fournir une valeur avec une extension valide.",
                maxlength: $.validator.format( "Veuillez fournir au plus {0} caractères." ),
                minlength: $.validator.format( "Veuillez fournir au moins {0} caractères." ),
                rangelength: $.validator.format( "Veuillez fournir une valeur qui contient entre {0} et {1} caractères." ),
                range: $.validator.format( "Veuillez fournir une valeur entre {0} et {1}." ),
                max: $.validator.format( "Veuillez fournir une valeur inférieure ou égale à {0}." ),
                min: $.validator.format( "Veuillez fournir une valeur supérieure ou égale à {0}." ),
                step: $.validator.format( "Veuillez fournir une valeur multiple de {0}." ),
                maxWords: $.validator.format( "Veuillez fournir au plus {0} mots." ),
                minWords: $.validator.format( "Veuillez fournir au moins {0} mots." ),
                rangeWords: $.validator.format( "Veuillez fournir entre {0} et {1} mots." ),
                letterswithbasicpunc: "Veuillez fournir seulement des lettres et des signes de ponctuation.",
                alphanumeric: "Veuillez fournir seulement des lettres, nombres, espaces et soulignages.",
                lettersonly: "Veuillez fournir seulement des lettres.",
                nowhitespace: "Veuillez ne pas inscrire d'espaces blancs.",
                ziprange: "Veuillez fournir un code postal entre 902xx-xxxx et 905-xx-xxxx.",
                integer: "Veuillez fournir un nombre non décimal qui est positif ou négatif.",
                vinUS: "Veuillez fournir un numéro d'identification du véhicule (VIN).",
                dateITA: "Veuillez fournir une date valide.",
                time: "Veuillez fournir une heure valide entre 00:00 et 23:59.",
                phoneUS: "Veuillez fournir un numéro de téléphone valide.",
                phoneUK: "Veuillez fournir un numéro de téléphone valide.",
                mobileUK: "Veuillez fournir un numéro de téléphone mobile valide.",
                strippedminlength: $.validator.format( "Veuillez fournir au moins {0} caractères." ),
                email2: "Veuillez fournir une adresse électronique valide.",
                url2: "Veuillez fournir une adresse URL valide.",
                creditcardtypes: "Veuillez fournir un numéro de carte de crédit valide.",
                ipv4: "Veuillez fournir une adresse IP v4 valide.",
                ipv6: "Veuillez fournir une adresse IP v6 valide.",
                require_from_group: $.validator.format( "Veuillez fournir au moins {0} de ces champs." ),
                nifES: "Veuillez fournir un numéro NIF valide.",
                nieES: "Veuillez fournir un numéro NIE valide.",
                cifES: "Veuillez fournir un numéro CIF valide.",
                postalCodeCA: "Veuillez fournir un code postal valide."
            } );
        });

        /*-- show bio on sidebar --*/
        $('#client').click(function () {
            $('#client_photo').css('display','block');
            $('#coup_photo').css('display','none');
            $('#child_photo').css('display','none');

            $('#client_name').css('display','block');
            $('#coup_name').css('display','none');
            $('#child_name').css('display','none');

            $('#client_email').css('display','block');
            $('#coup_email').css('display','none');
            $('#child_email').css('display','none');

            /*-----*/
            $('#child_photo_s').css('display','none');
            $('#child_photo_t').css('display','none');
            $('#child_photo_f').css('display','none');
            /*-----*/
            $('#child_name_s').css('display','none');
            $('#child_email_s').css('display','none');

            $('#child_name_t').css('display','none');
            $('#child_email_t').css('display','none');

            $('#child_name_f').css('display','none');
            $('#child_email_f').css('display','none');
            $('.default').css('display','none');
        });
        $('#client_spouse').click(function () {
            $('#client_photo').css('display','none');
            $('#coup_photo').css('display','block');
            $('#child_photo').css('display','none');

            $('#client_name').css('display','none');
            $('#coup_name').css('display','block');
            $('#child_name').css('display','none');

            $('#client_email').css('display','none');
            $('#coup_email').css('display','block');
            $('#child_email').css('display','none');
            /*-----*/
            $('#child_photo_s').css('display','none');
            $('#child_photo_t').css('display','none');
            $('#child_photo_f').css('display','none');
            /*-----*/
            $('#child_name_s').css('display','none');
            $('#child_email_s').css('display','none');

            $('#child_name_t').css('display','none');
            $('#child_email_t').css('display','none');

            $('#child_name_f').css('display','none');
            $('#child_email_f').css('display','none');
            $('.default').css('display','none');
        });
        $('#client_child').click(function () {
            $('#client_photo').css('display','none');
            $('#coup_photo').css('display','none');
            $('#child_photo').css('display','block');

            $('#client_name').css('display','none');
            $('#coup_name').css('display','none');
            $('#child_name').css('display','block');

            $('#client_email').css('display','none');
            $('#coup_email').css('display','none');
            $('#child_email').css('display','block');
            /*-----*/
            $('#child_photo_s').css('display','none');
            $('#child_photo_t').css('display','none');
            $('#child_photo_f').css('display','none');
            /*-----*/
            $('#child_name_s').css('display','none');
            $('#child_email_s').css('display','none');

            $('#child_name_t').css('display','none');
            $('#child_email_t').css('display','none');

            $('#child_name_f').css('display','none');
            $('#child_email_f').css('display','none');
            $('.default').css('display','none');
        });
        /* second_child*/
        $('li a[href="#profile_info_child_0"]').click(function(){
            $('#client_photo').css('display','none');
            $('#coup_photo').css('display','none');
            $('#child_photo').css('display','none');

            $('#child_photo_s').css('display','block');
            $('#child_photo_t').css('display','none');
            $('#child_photo_f').css('display','none');
            /*----*/
            $('#client_name').css('display','none');
            $('#coup_name').css('display','none');
            $('#child_name').css('display','none');

            $('#client_email').css('display','none');
            $('#coup_email').css('display','none');
            $('#child_email').css('display','none');
            /*----*/
            $('#child_name_s').css('display','block');
            $('#child_email_s').css('display','block');

            $('#child_name_t').css('display','none');
            $('#child_email_t').css('display','none');

            $('#child_name_f').css('display','none');
            $('#child_email_f').css('display','none');
            $('.default').css('display','none');
        });
        $('li a[href="#profile_info_child_1"]').click(function(){
            $('#client_photo').css('display','none');
            $('#coup_photo').css('display','none');
            $('#child_photo').css('display','none');
            $('#child_photo_s').css('display','none');
            $('#child_photo_t').css('display','block');
            $('#child_photo_f').css('display','none');
            /*----*/
            $('#client_name').css('display','none');
            $('#coup_name').css('display','none');
            $('#child_name').css('display','none');

            $('#client_email').css('display','none');
            $('#coup_email').css('display','none');
            $('#child_email').css('display','none');
            /*----*/
            $('#child_name_s').css('display','none');
            $('#child_email_s').css('display','none');

            $('#child_name_t').css('display','block');
            $('#child_email_t').css('display','block');

            $('#child_name_f').css('display','none');
            $('#child_email_f').css('display','none');
            $('.default').css('display','none');
        });
        $('li a[href="#profile_info_child_2"]').click(function(){
            $('#client_photo').css('display','none');
            $('#coup_photo').css('display','none');
            $('#child_photo').css('display','none');
            $('#child_photo_s').css('display','none');
            $('#child_photo_t').css('display','none');
            $('#child_photo_f').css('display','block');
            /*----*/
            $('#client_name').css('display','none');
            $('#coup_name').css('display','none');
            $('#child_name').css('display','none');

            $('#client_email').css('display','none');
            $('#coup_email').css('display','none');
            $('#child_email').css('display','none');
            /*----*/
            $('#child_name_s').css('display','none');
            $('#child_email_s').css('display','none');

            $('#child_name_t').css('display','none');
            $('#child_email_t').css('display','none');

            $('#child_name_f').css('display','block');
            $('#child_email_f').css('display','block');
            $('.default').css('display','none');
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

        var address_block_id = $('#address_container input.autocomplete_input').attr('id');


        function initAutocomplete() {
            // Create the autocomplete object, restricting the search to geographical
            // location types.
            $('.address_form_group').each(function (index) {
                index += 1;
                autocomplete = new google.maps.places.Autocomplete(
                    /** @type {!HTMLInputElement} */(document.getElementById('autocomplete_'+index)),
                    {types: ['geocode']});

                // When the user selects an address from the dropdown, populate the address
                // fields in the form.
//                autocomplete.addListener('place_changed', fillInAddress);
            });
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

        var map_btn_id = 1;
        $(document).on('click', '.open_map_btn', function(){
            var this_id = $(this).attr('id');
            map_btn_id = this_id.replace ( /[^\d.]/g, '' );
            console.log(map_btn_id);
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

            google.maps.event.addListener(marker, 'dragend', function(e){
                myLatlng = marker.getPosition();
                geocoder.geocode({
                    latLng: marker.getPosition()
                }, function(responses) {
                    if (responses && responses.length > 0) {

                        $('#latitude_'+map_btn_id).val(e.latLng.lat());
                        $('#longitude_'+map_btn_id).val(e.latLng.lng());
                        $('#autocomplete_'+map_btn_id).val(responses[0].formatted_address);

                        $('#street_number_'+map_btn_id).val('');
                        $('#route_'+map_btn_id).val('');
                        $('#locality_'+map_btn_id).val('');
                        $('#country_'+map_btn_id).val('');
                        $('#postal_code_'+map_btn_id).val('');

                        responses[0].address_components.forEach(function(a) {
                            if (a.long_name !== undefined && a.long_name.length > 0) {
                                if (a.types[0] == 'street_number') {
                                    $('#street_number_'+map_btn_id).val(a.long_name);
                                }
                                if (a.types[0] == 'route' || a.types[0] == 'street_address') {
                                    $('#route_'+map_btn_id).val(a.long_name);
                                }
                                if (a.types[0] == 'locality') {
                                    $('#locality_'+map_btn_id).val(a.long_name);
                                    $('.autocomplete_input_'+map_btn_id).val(a.long_name);
                                }
                                if (a.types[0] == 'country') {
                                    $('#country_'+map_btn_id).val(a.long_name);
                                }
                                if (a.types[0] == 'postal_code') {
                                    $('#postal_code_'+map_btn_id).val(a.long_name);
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