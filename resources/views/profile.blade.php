@extends('voyager::master_metronic')

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
    @if(Auth::user()->role_id == 5)
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            Mon Profil
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__body">
                                <div class="m-card-profile">
                                    <div class="m-card-profile__title m--hide">
                                        Votre Profil
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img src="{{ Voyager::image( Auth::user()->avatar ) }}" alt="{{ Auth::user()->name }}"/>
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span class="m-card-profile__name">{{ Auth::user()->name }}</span>
                                        <a href="" class="m-card-profile__email m-link">{{ Auth::user()->email }}</a>
                                    </div>
                                </div>
                                <ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
                                    <li class="m-nav__separator m-nav__separator--fit"></li>
                                    <li class="m-nav__item">
                                        <a href="{{ URL::to('admin/posts') }}" class="m-nav__link">
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
                    <div class="col-lg-9">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link {{ (Auth::user()->counter > 1) ? 'active' : '' }}" data-toggle="tab" href="#profile_info" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Mettre à jour le profil
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_spouse" role="tab">
                                                Epoux/Epouse
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child" role="tab">
                                                Enfant(s)
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link {{ (Auth::user()->counter == 1) ? 'active' : '' }}" data-toggle="tab" href="#profile_settings" role="tab">
                                                Paramètres
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form class="m-form m-form--fit m-form--label-align-right form-edit-add m-form--group-seperator-dashed"
                                  action="{{ route('voyager.users.update', Auth::user()->id) }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">
                                <!-- PUT Method if we are editing -->
                            @if(isset(Auth::user()->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <input type="hidden" name="role_id" value="{{ Auth::user()->role_id }}">
                                <div class="tab-content">
                                    <input type="hidden" name="type_profile" value="Profile">
                                    <div class="tab-pane {{ (Auth::user()->counter > 1) ? 'active' : '' }}" id="profile_info" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Client</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label>Civilité</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="select_civil" name="civility" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset(Auth::user()->civility) && Auth::user()->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Sélectionner la langue</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Sélectionner la langue">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres) && Auth::user()->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Nom</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="Nom" value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                                </div>
                                                <div class="col-md-4 margin_bottom_10">
                                                    <label class="">Deuxième prénom</label>
                                                    <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Deuxième prénom" value="{{ (Auth::user()->middle_name) ? Auth::user()->middle_name : '' }}">
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Prenom</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Prenom" value="{{ (Auth::user()->last_name) ? Auth::user()->last_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-md-4 margin_bottom_10">
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
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Etat civil</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="Etat civil">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset(Auth::user()->civil_status) && Auth::user()->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Nationalité</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Nationalité">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset(Auth::user()->nationality) && Auth::user()->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Date de naissance</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Date de naissance" name="birth_date" value="{{ (Auth::user()->birth_date) ? Auth::user()->birth_date : '' }}">
                                                            {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Lieu de naissance</label>
                                                    <input class="form-control m-input" type="text" placeholder="Lieu de naissance" name="birthplace" value="{{ (Auth::user()->birthplace) ? Auth::user()->birthplace : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ (Auth::user()->profession) ? Auth::user()->profession : '' }}">
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ (Auth::user()->service) ? Auth::user()->service : '' }}">
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Entreprise</label>
                                                    <input class="form-control m-input" id="business" type="text" placeholder="Entreprise" name="business" value="{{ (Auth::user()->business) ? Auth::user()->business : '' }}">
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Site Internet</label>
                                                    <input class="form-control m-input" id="website" type="text" placeholder="Site Internet" name="website" value="{{ (Auth::user()->website) ? Auth::user()->website : '' }}">
                                                </div>
                                            </div>
                                            <div class="m-form__group row">
                                                <div class="col-md-4 margin_bottom_10">
                                                    <label class="">Type de Courriel</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset(Auth::user()->email_type) && Auth::user()->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Courriel</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Courriel" name="email" value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}">
                                                </div>
                                                <div class="col-md-4 margin_bottom_10">
                                                    <label class="">Type de téléphone</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type" id="phone_type" data-placeholder="Type de téléphone">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Téléphone</label>
                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Téléphone" name="phone" value="{{ (Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                                </div>
                                                <div class="col-md-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ (Auth::user()->country_code) ? Auth::user()->country_code : '' }}">
                                                </div>
                                                <div class="col-md-4 margin_bottom_10">
                                                    <label class="">Moyen de contact préféré</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Moyen de contact préféré">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(Auth::user()->preferred_means_contact) && Auth::user()->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            {{--address block--}}
                                            <div id="address_container">
                                                @if(!empty(json_decode(Auth::user()->address)))
                                                    @foreach (json_decode(Auth::user()->address) as $key => $address)
                                                        <div class="m-form__group row address_form_group" id="address_form_{{ $key }}">
                                                            <div class="col-md-{{ ($key != 0) ? '10' : '12' }} margin_bottom_10">
                                                                <label>Nom de l’adresse</label>
                                                                <div class="m-input-icon m-input-icon--right">
                                                                    <input type="text" class="form-control m-input" name="address_name[]" value="{{ (isset($address->address_name)) ? $address->address_name : '' }}" placeholder="Entrer votre Nom de l’adresse">
                                                                </div>
                                                            </div>
                                                            @if($key != 0)
                                                                <div class="col-md-2 margin_bottom_10">
                                                                    <button id="{{ $key }}" type="button" class="btn btn-danger remove_address_btn" style="margin-top: 24px; width: 100%;">Effacer</button>
                                                                </div>
                                                            @endif
                                                            <div class="col-md-8 margin_bottom_10">
                                                                <label>Adresse</label>
                                                                <div class="m-input-icon m-input-icon--right">
                                                                    <input type="text" id="autocomplete_{{ $key }}" class="form-control m-input autocomplete_input" name="address[]" value="{{ (isset($address->address)) ? $address->address : '' }}" placeholder="Entrer votre adresse" onFocus="geolocate()">
                                                                    <span class="m-input-icon__icon m-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-map-marker"></i>
                                                                    </span>
                                                                </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 margin_bottom_10">
                                                                <button type="button" id="open_map_btn_{{ $key }}" class="btn btn-secondary open_map_btn" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 28px; width: 100%;">Placer l’adresse sur la carte</button>
                                                            </div>

                                                            <div class="col-md-3 margin_bottom_10">
                                                                <label>Rue</label>
                                                                <input type="text" id="route_{{ $key }}" readonly="readonly" class="form-control m-input" placeholder="Rue" value="{{ (isset($address->street)) ? $address->street : '' }}" name="street[]">
                                                            </div>
                                                            <div class="col-md-2 margin_bottom_10">
                                                                <label>N°</label>
                                                                <input type="text" id="street_number_{{ $key }}" readonly="readonly" class="form-control m-input" placeholder="N°" value="{{ (isset($address->number)) ? $address->number : '' }}" name="number[]">
                                                            </div>
                                                            <div class="col-md-2 margin_bottom_10">
                                                                <label>CP</label>
                                                                <input type="number" min="0" class="form-control m-input" placeholder="CP" value="{{ (isset($address->po_box)) ? $address->po_box : '' }}" name="po_box[]">
                                                            </div>
                                                            <div class="col-md-2 margin_bottom_10">
                                                                <label>NPA</label>
                                                                <input type="text" id="postal_code_{{ $key }}" readonly="readonly" class="form-control m-input" placeholder="NPA" value="{{ (isset($address->zip_code)) ? $address->zip_code : '' }}" name="zip_code[]">
                                                            </div>
                                                            <div class="col-md-3 margin_bottom_10">
                                                                <label>Ville</label>
                                                                <input type="text" id="locality_{{ $key }}" readonly="readonly" class="form-control m-input" placeholder="Ville" value="{{ (isset($address->town)) ? $address->town : '' }}" name="town[]">
                                                            </div>
                                                            <div class="col-md-3 margin_bottom_10">
                                                                <label>Pays</label>
                                                                <input type="text" id="country_{{ $key }}" readonly="readonly" class="form-control m-input" placeholder="Pays" value="{{ (isset($address->country)) ? $address->country : '' }}" name="country[]">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Longitude</label>
                                                                <input disabled="disabled" type="number" min="0" id="longitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->longitude)) ? $address->longitude : '' }}" name="longitude[]">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label>Latitude</label>
                                                                <input disabled="disabled" type="number" min="0" id="latitude_{{ $key }}" class="form-control m-input" placeholder="Longitude" value="{{ (isset($address->latitude)) ? $address->latitude : '' }}" name="latitude[]">
                                                            </div>
                                                            <div class="col-md-3 margin_bottom_10">
                                                                <label>Localisation</label>
                                                                <select class="form-control m-select2 custom_select2" name="location[]" data-placeholder="Select Location">
                                                                    @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                                        <option value="{{ $location->reference }}" @if(isset($address->location) && $address->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="m-form__group row address_form_group" id="address_form_1">
                                                        <div class="col-md-12 margin_bottom_10">
                                                            <label>Nom de l’adresse</label>
                                                            <div class="m-input-icon m-input-icon--right">
                                                                <input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre Nom de l’adresse">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 margin_bottom_10">
                                                            <label>Adresse</label>
                                                            <div class="m-input-icon m-input-icon--right">
                                                                <input type="text" id="autocomplete_1" class="form-control m-input autocomplete_input" name="address[]"  placeholder="Entrer votre adresse" onFocus="geolocate()">
                                                                <span class="m-input-icon__icon m-input-icon__icon--right">
                                                                    <span>
                                                                        <i class="la la-map-marker"></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 margin_bottom_10">
                                                            <button type="button" id="open_map_btn_1" class="btn btn-secondary open_map_btn" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 24px; width: 100%;">Placer l’adresse sur la carte</button>
                                                        </div>

                                                        <div class="col-md-3 margin_bottom_10">
                                                            <label>Rue</label>
                                                            <input type="text" id="route_1" readonly="readonly" class="form-control m-input" placeholder="Rue"  name="street[]">
                                                        </div>
                                                        <div class="col-md-2 margin_bottom_10">
                                                            <label>N°</label>
                                                            <input type="text" id="street_number_1" readonly="readonly" class="form-control m-input" placeholder="N°" name="number[]">
                                                        </div>
                                                        <div class="col-md-2 margin_bottom_10">
                                                            <label>CP</label>
                                                            <input type="number" min="0" class="form-control m-input" placeholder="CP" name="po_box[]">
                                                        </div>
                                                        <div class="col-md-2 margin_bottom_10">
                                                            <label>NPA</label>
                                                            <input type="text" id="postal_code_1" readonly="readonly" class="form-control m-input" placeholder="NPA"  name="zip_code[]">
                                                        </div>
                                                        <div class="col-md-3 margin_bottom_10">
                                                            <label>Ville</label>
                                                            <input type="text" id="locality_1" readonly="readonly" class="form-control m-input" placeholder="Ville"  name="town[]">
                                                        </div>
                                                        <div class="col-md-3 margin_bottom_10">
                                                            <label>Pays</label>
                                                            <input type="text" id="country_1" readonly="readonly" class="form-control m-input" placeholder="Pays"  name="country[]">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Longitude</label>
                                                            <input disabled="disabled" type="number" min="0" id="longitude_1" class="form-control m-input" placeholder="Longitude" name="longitude[]">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label>Latitude</label>
                                                            <input disabled="disabled" type="number" min="0" id="latitude_1" class="form-control m-input" placeholder="Longitude" name="latitude[]">
                                                        </div>
                                                        <div class="col-md-3 margin_bottom_10">
                                                            <label>Localisation</label>
                                                            <select class="form-control m-select2 custom_select2" name="location[]" data-placeholder="Select Location">
                                                                @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                                    <option value="{{ $location->reference }}">{{ $location->value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-md-4 margin_bottom_10">
                                                    <button id="add_new_address" type="button" class="btn btn-accent" style="width: 100%;">Ajouter une nouvelle adresse</button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="tab-pane {{ (Auth::user()->counter == 1) ? 'active' : '' }}" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset(Auth::user()->id))
                                                    <div class="form-group col-md-6 margin_bottom_10">
                                                        <label class="">Nouveau mot de passe</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Changer le mot de passe" name="password">
                                                    </div>
                                                    <div class="form-group col-md-6 margin_bottom_10">
                                                        <label class="">Confirmer le mot de passe</label>
                                                        <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirmer le mot de passe" name="password_confirm">
                                                    </div>
                                                @else
                                                    <div class="col-md-6 margin_bottom_10">
                                                        <label class="">Entrer le mot de passe</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Entrer le mot de passe" name="password">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_spouse" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_info_child" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-12 m--align-right">
                                                <button type="reset" class="btn btn-danger m-btn m-btn--air m-btn--custom">
                                                    Annuler
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="button" class="btn btn-success m-btn m-btn--air m-btn--custom" data-toggle="modal" data-target="#client_profile_save_modal">
                                                    Sauver les modifications
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--begin::Modal save profile-->
                                <div class="modal fade" id="client_profile_save_modal" tabindex="-1" role="dialog" aria-labelledby="save_checklist" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="pure_switch">
                                                            <span class="m-switch m-switch--outline m-switch--brand">
                                                                <label>
                                                                    <input type="checkbox" name="save_check1">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <label class="pure_switch_label"> Vous certifiez que les informations que vous avez insérés sont conformes à la réalité.</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                                <button type="submit" value="submit" class="btn btn-primary" disabled="disabled">Enregistrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Modal-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            Profile ({{ Auth::user()->name }})
                        </h3>
                    </div>
                </div>
            </div>
            <!-- END: Subheader -->
            <div class="m-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="m-portlet m-portlet--full-height ">
                            <div class="m-portlet__body">
                                <div class="m-card-profile">
                                    <div class="m-card-profile__title m--hide">
                                        Mon profil
                                    </div>
                                    <div class="m-card-profile__pic">
                                        <div class="m-card-profile__pic-wrapper">
                                            <img src="{{ Voyager::image( Auth::user()->avatar ) }}" alt="{{ Auth::user()->name }} avatar"/>
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span class="m-card-profile__name">{{ Auth::user()->name }}</span>
                                        <a href="" class="m-card-profile__email m-link">{{ Auth::user()->email }}</a>
                                    </div>
                                </div>
                                <div class="m-portlet__body-separator"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile_info" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Mettre à jour le profil
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_settings" role="tab">
                                                Paramètres
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <form class="m-form m-form--fit m-form--label-align-right form-edit-add m-form--group-seperator-dashed"
                                  action="{{ route('voyager.users.update', Auth::user()->id) }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">

                            @if(isset(Auth::user()->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="tab-content">
                                    <input type="hidden" name="type_users" value="Users">
                                    <div class="tab-pane active" id="profile_info" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Utilisateur</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Nom</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="Nom" value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Prenom</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Prenom" value="{{ (Auth::user()->last_name) ? Auth::user()->last_name : '' }}">
                                                </div>
                                                <div class="form-group col-md-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}" aria-invalid="false">
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label>Role</label>
                                                    @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                        @if($role->id == Auth::user()->id)
                                                            <input class="form-control m-input" type="text" readonly value="{{ $role->display_name }}">
                                                        @endif
                                                    @endforeach
                                                    {{--<select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Civilité">--}}
                                                    {{--@foreach(TCG\Voyager\Models\Role::all() as $role)--}}
                                                    {{--@if($role->id != 5 && $role->id > Auth::user()->id)--}}
                                                    {{--<option value="{{ $role->id }}" @if(isset(Auth::user()->role_id) && Auth::user()->role_id == $role->id){{ 'selected="selected"' }} @endif>{{ $role->display_name }}</option>--}}
                                                    {{--@endif--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                </div>
                                                <div class="col-md-6 margin_bottom_10">
                                                    <label class="">Sélectionner la langue</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Sélectionner la langue">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres) && Auth::user()->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-md-4 margin_bottom_10">
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
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset(Auth::user()->id))
                                                    <div class="form-group col-md-6 margin_bottom_10">
                                                        <label class="">Nouveau mot de passe</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Changer le mot de passe" name="password">
                                                    </div>
                                                    <div class="form-group col-md-6 margin_bottom_10">
                                                        <label class="">Confirmer le mot de passe</label>
                                                        <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirmer le mot de passe" name="password_confirm">
                                                    </div>
                                                @else
                                                    <div class="col-md-6 margin_bottom_10">
                                                        <label class="">Entrer le mot de passe</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Entrer le mot de passe" name="password">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-12 m--align-right">
                                                <button type="reset" class="btn btn-danger m-btn m-btn--air m-btn--custom">
                                                    Annuler
                                                </button>
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
    @endif

    <!--begin::Modal address map-->
    <div class="modal fade" id="address_map_modal" tabindex="-1" role="dialog" aria-labelledby="addressMapModal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
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
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZhPguGsxnAK4WdGML3Qew_KMleHvRdzw&libraries=places&callback=initAutocomplete"async defer></script>
    <!--end::Google Maps -->

    <script>
        var i = 1;
        $('#add_new_address').click(function(){
            i++;
            $('#address_container').append(
                '<div class="form-group m-form__group row address_form_group" id="address_form_' + i  + '">' +
                '<div class="col-md-10 margin_bottom_10">' +
                '<label>Nom de l’adresse</label>' +
                '<div class="m-input-icon m-input-icon--right">' +
                '<input type="text" class="form-control m-input" name="address_name[]" placeholder="Entrer votre Nom de l’adresse">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-2 margin_bottom_10">' +
                '<button id="' + i  + '" type="button" class="btn btn-danger remove_address_btn" style="margin-top: 24px; width: 100%;">Effacer</button>' +
                '</div>' +
                '<div class="col-md-8 margin_bottom_10">' +
                '<label>Adresse</label>' +
                '<div class="m-input-icon m-input-icon--right">' +
                '<input type="text" id="autocomplete_' + i  + '" class="form-control m-input autocomplete_input" name="address[]" placeholder="Entrer votre adresse" onFocus="geolocate()">' +
                '<span class="m-input-icon__icon m-input-icon__icon--right">' +
                '<span>' +
                '<i class="la la-map-marker"></i>' +
                '</span>' +
                '</span>' +
                '</div>' +
                '</div>' +
                '<div class="col-md-4 margin_bottom_10">' +
                '<button type="button" id="open_map_btn_' + i  + '" class="btn btn-secondary open_map_btn" data-toggle="modal" data-target="#address_map_modal" style="margin-top: 24px; width: 100%;">Placer l’adresse sur la carte</button>' +
                '</div>' +
                '<div class="col-md-3 margin_bottom_10">' +
                '<label>Rue</label>' +
                '<input type="text" id="route_' + i  + '" readonly="readonly" class="form-control m-input" placeholder="Rue" name="street[]">' +
                '</div>' +
                '<div class="col-md-2 margin_bottom_10">' +
                '<label>N°</label>' +
                '<input type="text" id="street_number_' + i  + '" readonly="readonly" class="form-control m-input" placeholder="N°" name="number[]">' +
                '</div>' +
                '<div class="col-md-2 margin_bottom_10">' +
                '<label>CP</label>' +
                '<input type="number" min="0" class="form-control m-input" placeholder="CP" name="po_box[]">' +
                '</div>' +
                '<div class="col-md-2 margin_bottom_10">' +
                '<label>NPA</label>' +
                '<input type="text" id="postal_code_' + i  + '" readonly="readonly" class="form-control m-input" placeholder="NPA" name="zip_code[]">' +
                '</div>' +
                '<div class="col-md-3 margin_bottom_10">' +
                '<label>Ville</label>' +
                '<input type="text" id="locality_' + i  + '" readonly="readonly" class="form-control m-input" placeholder="Ville" name="town[]">' +
                '</div>' +
                '<div class="col-md-3 margin_bottom_10">' +
                '<label>Pays</label>' +
                '<input type="text" id="country_' + i  + '" readonly="readonly" class="form-control m-input" placeholder="Pays" name="country[]">' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label>Longitude</label>' +
                '<input disabled="disabled" type="number" min="0" id="longitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="longitude[]">' +
                '</div>' +
                '<div class="col-md-3">' +
                '<label>Latitude</label>' +
                '<input disabled="disabled" type="number" min="0" id="latitude_' + i  + '" class="form-control m-input" placeholder="Longitude" name="latitude[]">' +
                '</div>' +
                '<div class="col-md-3 margin_bottom_10">' +
                '<label>Localisation</label>' +
                '<select class="form-control m-select2 custom_select2" name="location[]" data-placeholder="Select Location">' +
                @foreach(TCG\Voyager\Models\Location::all() as $location)
                    '<option value="{{ $location->reference }}">{{ $location->value }}</option>' +
                @endforeach
                    '</select>' +
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


        $("#client_profile_save_modal .pure_switch input[type='checkbox']").change(function(){
            checkChecklict();
        });
        function checkChecklict() {
            var checkboxes =  $("#client_profile_save_modal .pure_switch input[type='checkbox']");
            var checked =  $("#client_profile_save_modal .pure_switch input[type='checkbox']:checked");
            if ($(checkboxes).length == $(checked).length) {
                $("#client_profile_save_modal button[type='submit']").prop('disabled', false)
            } else {
                $("#client_profile_save_modal button[type='submit']").prop('disabled', true)
            }
        }
    </script>

    <script>
        jQuery.validator.addMethod( 'passwordMatch', function(value, element) {

            var password = $("#password").val();
            var confirmPassword = $("#password_confirm").val();

            if(password != confirmPassword ) {
                return false;
            } else {
                return true;
            }

        }, "Your Passwords Must Match");

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
                    password: {
                        minlength: 3
                    },
                    password_confirm: {
                        minlength: 3,
                        passwordMatch: true
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
