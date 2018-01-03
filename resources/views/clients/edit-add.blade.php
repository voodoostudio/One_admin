@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

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
                            Edit profile <b>({{ (isset($dataTypeContent->name)) ? $dataTypeContent->name : '' }} {{ (isset($dataTypeContent->last_name)) ? $dataTypeContent->last_name : '' }})</b>
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
                                        Your Profile
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img src="{{ Voyager::image( $dataTypeContent->avatar ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span class="m-card-profile__name">{{ $dataTypeContent->name }}</span>
                                        <a href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email }}</a>
                                    </div>
                                </div>
                                <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="{{ URL::to('admin/posts') }}?client_id={{$dataTypeContent->id}}" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-signs-1"></i>
                                            <span class="m-nav__link-text">
                                                Properties
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
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile_info_client" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                {{ $dataTypeContent->name }}
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_spouse" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Spouse
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Child
                                            </a>
                                        </li>
                                        {{-- <li class="nav-item m-tabs__item">
                                             <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_settings" role="tab">
                                                 Settings
                                             </a>
                                         </li>--}}
                                    </ul>
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
                                                    <label class="">Select language</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">First name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Middle name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="{{ ($dataTypeContent->middle_name) ? $dataTypeContent->middle_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Last name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Photo</label>
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
                                                    <label class="">Civil status</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status) && $dataTypeContent->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Nationality</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Birth date</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Birth date" name="birth_date" value="{{ ($dataTypeContent->birth_date) ? date("d.m.Y", strtotime($dataTypeContent->birth_date)) : '' }}">
                                                        {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label class="">Birth place</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" type="text" placeholder="Birth place" name="birthplace" value="{{ ($dataTypeContent->birthplace) ? $dataTypeContent->birthplace : '' }}">
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
                                                    <label class="">Business</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="business" type="text" placeholder="Business" name="business" value="{{ ($dataTypeContent->business) ? $dataTypeContent->business : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Website</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website" type="text" placeholder="Website" name="website" value="{{ ($dataTypeContent->website) ? $dataTypeContent->website : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type) && $dataTypeContent->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-4">
                                                    <label class="">Email</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact) && $dataTypeContent->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type" id="phone_type" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Country code</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ ($dataTypeContent->country_code) ? $dataTypeContent->country_code : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4">
                                                    <label class="">Phone number</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="phone" type="text" placeholder="Phone" name="phone" value="{{ ($dataTypeContent->phone) ? $dataTypeContent->phone : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{--address block--}}
                                            <div id="address_container">
                                                @if(!empty(json_decode($dataTypeContent->address)))
                                                    @foreach (json_decode($dataTypeContent->address) as $key => $address)
                                                        <div class="m-form__group row address_form_group" id="address_form_{{ $key }}">
                                                            <div class="col-lg-{{ ($key != 0) ? '10' : '12' }} ">
                                                                <label>Adresse nom</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control m-input" name="address_name[]" value="{{ (isset($address->address_name)) ? $address->address_name : '' }}" placeholder="Entrer votre adresse nom">
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

                                                            <div class="col-sm-12 col-md-3 ">
                                                                <label>Rue</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="route_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Rue" value="{{ (isset($address->street)) ? $address->street : '' }}" name="street[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-2 ">
                                                                <label>N°</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="street_number_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="N°" value="{{ (isset($address->number)) ? $address->number : '' }}" name="number[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-2 ">
                                                                <label>CP</label>
                                                                <div class="input-group">
                                                                    <input type="number" min="0" class="form-control m-input switchable_form_item" placeholder="CP" value="{{ (isset($address->po_box)) ? $address->po_box : '' }}" name="po_box[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-2 ">
                                                                <label>NPA</label>
                                                                <input type="text" id="postal_code_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="NPA" value="{{ (isset($address->zip_code)) ? $address->zip_code : '' }}" name="zip_code[]">
                                                            </div>
                                                            <div class="col-sm-12 col-md-3 ">
                                                                <label>Ville</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="locality_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Ville" value="{{ (isset($address->town)) ? $address->town : '' }}" name="town[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-3 ">
                                                                <label>Pays</label>
                                                                <div class="input-group">
                                                                    <input type="text" id="country_{{ $key }}" readonly="readonly" class="form-control m-input switchable_form_item" placeholder="Pays" value="{{ (isset($address->country)) ? $address->country : '' }}" name="country[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-3">
                                                                <label>Longitude</label>
                                                                <div class="input-group">
                                                                    <input disabled="disabled" type="number" min="0" id="longitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->longitude)) ? $address->longitude : '' }}" name="longitude[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-3">
                                                                <label>Latitude</label>
                                                                <div class="input-group">
                                                                    <input disabled="disabled" type="number" min="0" id="latitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->latitude)) ? $address->latitude : '' }}" name="latitude[]">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 col-md-3 ">
                                                                <label>Localisation</label>
                                                                <select class="form-control m-select2 custom_select2 switchable_form_item" name="location[]" data-placeholder="Select Location">
                                                                    @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                                        <option value="{{ $location->reference }}" @if(isset($address->location) && $address->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="m-form__group row address_form_group" id="address_form_1">
                                                        <div class="col-lg-12 ">
                                                            <label>Adresse nom</label>
                                                            <div class="input-group">
                                                                <input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre adresse nom">
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

                                                        <div class="col-sm-12 col-md-3 ">
                                                            <label>Rue</label>
                                                            <div class="input-group">
                                                                <input type="text" id="route_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Rue"  name="street[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-2 ">
                                                            <label>N°</label>
                                                            <div class="input-group">
                                                                <input type="text" id="street_number_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="N°" name="number[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-2 ">
                                                            <label>CP</label>
                                                            <div class="input-group">
                                                                <input type="number" min="0" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="CP" name="po_box[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-2 ">
                                                            <label>NPA</label>
                                                            <div class="input-group">
                                                                <input type="text" id="postal_code_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="NPA"  name="zip_code[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3 ">
                                                            <label>Ville</label>
                                                            <div class="input-group">
                                                                <input type="text" id="locality_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Ville"  name="town[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3 ">
                                                            <label>Pays</label>
                                                            <div class="input-group">
                                                                <input type="text" id="country_1" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Pays"  name="country[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3">
                                                            <label>Longitude</label>
                                                            <div class="input-group">
                                                                <input disabled="disabled" type="number" min="0" id="longitude_1" class="form-control m-input" placeholder="Longitude" name="longitude[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3">
                                                            <label>Latitude</label>
                                                            <div class="input-group">
                                                                <input disabled="disabled" type="number" min="0" id="latitude_1" class="form-control m-input" placeholder="Longitude" name="latitude[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 col-md-3 ">
                                                            <label>Localisation</label>
                                                            <div class="input-group">
                                                                <select class="form-control m-select2 custom_select2 switchable_form_item" disabled="disabled" name="location[]" data-placeholder="Select Location">
                                                                    @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                                        <option value="{{ $location->reference }}">{{ $location->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-3 ">
                                                    <button id="add_new_address" type="button" class="btn btn-accent" style="width: 100%;">Add new address</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_spouse" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Spouse</h3>
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
                                                    <label class="">Select language</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_coup" id="lng_corres_coup"  data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_coup) && $dataTypeContent->lng_corres_coup == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">First name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="first_name_coup" type="text" name="first_name_coup" placeholder="First Name" value="{{ ($dataTypeContent->first_name_coup) ? $dataTypeContent->first_name_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Middle name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name_coup" type="text" name="middle_name_coup" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_coup) ? $dataTypeContent->middle_name_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Last name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name_coup" type="text" name="last_name_coup" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_coup) ? $dataTypeContent->last_name_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Photo</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="photo_coup" type="file" accept="image/*" id="photo_coup" class="input_file">
                                                            <label for="photo_coup">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    @if($dataTypeContent->photo_coup != null)
                                                        <img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->photo_coup ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                                    @else
                                                        <img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default coup avatar"/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Civil status</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_coup" id="civil_status_coup" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_coup) && $dataTypeContent->civil_status_coup == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationality</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_coup" name="nationality_coup" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Birth date</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date_coup" type="text" placeholder="Birth date" name="birth_date_coup" value="{{ ($dataTypeContent->birth_date_coup) ? date("d.m.Y", strtotime($dataTypeContent->birth_date_coup)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Birth place</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="birthplace_coup" type="text" placeholder="Place birth" name="birthplace_coup" value="{{ ($dataTypeContent->birthplace_coup) ? $dataTypeContent->birthplace_coup : '' }}">
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
                                                    <label class="">Business</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="business_coup" type="text" placeholder="Business" name="business_coup" value="{{ ($dataTypeContent->business_coup) ? $dataTypeContent->business_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Website</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website_coup" type="text" placeholder="Website" name="website_coup" value="{{ ($dataTypeContent->website_coup) ? $dataTypeContent->website_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Email type</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_coup" id="email_type_coup" data-placeholder="Email type">
                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_coup) && $dataTypeContent->email_type_coup == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Email</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="email_coup" type="text" placeholder="Email" name="email_coup" value="{{ ($dataTypeContent->email_coup) ? $dataTypeContent->email_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Preferred means of contact</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_coup" id="preferred_means_contact_coup" data-placeholder="Phone type">
                                                            @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                                <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_coup) && $dataTypeContent->preferred_means_contact_coup == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Phone type</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_coup" id="phone_type_coup" data-placeholder="Phone type">
                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                                <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_coup) && $dataTypeContent->phone_type_coup == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Country code</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="country_code_coup" type="text" placeholder="Country code" name="country_code_coup" value="{{ ($dataTypeContent->country_code_coup) ? $dataTypeContent->country_code_coup : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Phone number</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="phone_coup" type="text" placeholder="Phone" name="phone_coup" value="{{ ($dataTypeContent->phone_coup) ? $dataTypeContent->phone_coup : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Children</h3>
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
                                                    <label class="">Select language</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_child" id="lng_corres_child" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_child) && $dataTypeContent->lng_corres_child == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">First name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="first_name_child" type="text" name="first_name_child" placeholder="First Name" value="{{ ($dataTypeContent->first_name_child) ? $dataTypeContent->first_name_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Middle name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="middle_name_child" type="text" name="middle_name_child" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_child) ? $dataTypeContent->middle_name_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Last name</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name_child" type="text" name="last_name_child" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_child) ? $dataTypeContent->last_name_child : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Photo</label>
                                                    <div class="img_upload_container">
                                                        <div class="img_upload">
                                                            <input name="photo_child" type="file" accept="image/*" id="photo_child" class="input_file">
                                                            <label for="photo_child">
                                                                <span>Choisissez une image d'en-tête</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-2 ">
                                                    @if($dataTypeContent->photo_coup != null)
                                                        <img class="avatar_preview" src="{{ Voyager::image( $dataTypeContent->photo_child ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                                    @else
                                                        <img class="avatar_preview" src="/img/admin/default-coup.png" alt="Default child avatar"/>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Civil status</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_child" id="civil_status_child" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                                <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_child) && $dataTypeContent->civil_status_child == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Nationality</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_child" name="nationality_child" data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                                <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6">
                                                    <label>Birth date</label>
                                                    <div class='input-group date' id='m_datepicker_4'>
                                                        <input class="form-control m-input date-type" readonly id="birth_date_child" type="text" placeholder="Birth date" name="birth_date_child" value="{{ ($dataTypeContent->birth_date_child) ? date("d.m.Y", strtotime($dataTypeContent->birth_date_child)) : '' }}">
                                                        <span class="input-group-addon">
                                                            <i class="la la-calendar-check-o"></i>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Birth place</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="birthplace_child" type="text" placeholder="Place birth" name="birthplace_child" value="{{ ($dataTypeContent->birthplace_child) ? $dataTypeContent->birthplace_child : '' }}">
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
                                                    <label class="">Business</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="example-text-input" type="text" placeholder="Business" name="business_child" value="{{ ($dataTypeContent->business_child) ? $dataTypeContent->business_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-6 ">
                                                    <label class="">Website</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="website_child" type="text" placeholder="Website" name="website_child" value="{{ ($dataTypeContent->website_child) ? $dataTypeContent->website_child : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Email type</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_child" id="email_type_child" data-placeholder="Email type">
                                                            @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_child) && $dataTypeContent->email_type_child == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Email</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="email_child" type="text" placeholder="Email" name="email_child" value="{{ ($dataTypeContent->email_child) ? $dataTypeContent->email_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Preferred means of contact</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_child" id="preferred_means_contact_child" data-placeholder="Phone type">
                                                            @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                                <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_child) && $dataTypeContent->preferred_means_contact_child == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Phone type</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_child" id="phone_type_child" data-placeholder="Phone type">
                                                            @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                                <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_child) && $dataTypeContent->phone_type_child == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 col-md-4 ">
                                                    <label class="">Country code</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="country_code_child" type="text" placeholder="Website" name="country_code_child" value="{{ ($dataTypeContent->country_code_child) ? $dataTypeContent->country_code_child : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12 col-md-4 ">
                                                    <label class="">Phone number</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="phone_child" type="text" placeholder="Phone" name="phone_child" value="{{ ($dataTypeContent->phone_child) ? $dataTypeContent->phone_child : '' }}">
                                                    </div>
                                                </div>
                                                @if(Auth::user()->role_id != 5)
                                            </div>
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
                                                <button type="reset" class="btn btn-danger m-btn m-btn--air m-btn--custom">
                                                    Cancel
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
                                                    Save changes
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
                                                    Create Client
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="form-group col-sm-12 col-md-6 col-lg-3 ">
                                                <label>Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Name" value="" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group col-sm-12 col-md-6 col-lg-3 ">
                                                <label>Second Name</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Second Name" value="" name="last_name">
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
                                                <label>Email</label>
                                                <div class="input-group">
                                                    <input type="text" id="" class="form-control m-input" placeholder="Email" value="" name="email">
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
                '<label>Adresse nom</label>' +
                '<div class="input-group">' +
                '<input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre adresse nom">' +
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
                '<div class="col-sm-12 col-md-3 ">' +
                '<label>Rue</label>' +
                '<div class="input-group">' +
                '<input type="text" id="route_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Rue" name="street[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-2 ">' +
                '<label>N°</label>' +
                '<div class="input-group">' +
                '<input type="text" id="street_number_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="N°" name="number[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-2 ">' +
                '<label>CP</label>' +
                '<div class="input-group">' +
                '<input type="number" min="0" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="CP" name="po_box[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-2 ">' +
                '<label>NPA</label>' +
                '<div class="input-group">' +
                '<input type="text" id="postal_code_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="NPA" name="zip_code[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-3 ">' +
                '<label>Ville</label>' +
                '<div class="input-group">' +
                '<input type="text" id="locality_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Ville" name="town[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-3 ">' +
                '<label>Pays</label>' +
                '<div class="input-group">' +
                '<input type="text" id="country_' + i  + '" readonly="readonly" disabled="disabled" class="form-control m-input switchable_form_item" placeholder="Pays" name="country[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-3">' +
                '<label>Longitude</label>' +
                '<div class="input-group">' +
                '<input disabled="disabled" type="number" min="0" id="longitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="longitude[]">' +
                '</div>' +
                '</div>' +
                '<div class="col-sm-12 col-md-3">' +
                '<label>Latitude</label>' +
                '<div class="input-group">' +
                '<input disabled="disabled" type="number" min="0" id="latitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="latitude[]">' +
                '</div> ' +
                '</div>' +
                '<div class="col-sm-12 col-md-3 ">' +
                '<label>Localisation</label>' +
                '<div class="input-group">' +
                '<select class="form-control m-select2 custom_select2 switchable_form_item" disabled="disabled" name="location[]" data-placeholder="Select Location">' +
                @foreach(TCG\Voyager\Models\Location::all() as $location)
                    '<option value="{{ $location->reference }}">{{ $location->value }}</option>' +
                @endforeach
                    '</select>' +
                '</div>' +
                '</div>' +
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
            jQuery("#profile_edit_form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    phone: {
                        number: true,
                        maxlength: 15
                    },
                    email_coup: {
                        email: true
                    },
                    phone_coup: {
                        number: true,
                        maxlength: 15
                    },
                    email_child: {
                        email: true
                    },
                    phone_child: {
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
                        required: true
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
                autocomplete.addListener('place_changed', fillInAddress);
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