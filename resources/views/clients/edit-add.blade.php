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
                            My Profile 1
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
                                    <li class="m-nav__section m--hide">
                                        <span class="m-nav__section-text">
                                            Section
                                        </span>
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">
                                                        My Profile
                                                    </span>
                                                    <span class="m-nav__link-badge">
                                                        <span class="m-badge m-badge--success">2</span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-signs-1"></i>
                                            <span class="m-nav__link-text">
                                                Properties
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item" style="display: none">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">
                                                Messages
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
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile_info" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Update Profile
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_settings" role="tab">
                                                Settings
                                            </a>
                                        </li>
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
                                <div class="tab-content">
                                    <input type="hidden" name="type_clients" value="Clients">
                                    <div class="tab-pane active" id="profile_info" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Client</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label>Civilité</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="select_civil" name="civility" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility) && $dataTypeContent->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="{{ ($dataTypeContent->middle_name) ? $dataTypeContent->middle_name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status) && $dataTypeContent->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Birth date" name="birth_date" value="{{ ($dataTypeContent->birth_date) ? $dataTypeContent->birth_date : '' }}">
                                                            {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" type="text" placeholder="Birth place" name="birthplace" value="{{ ($dataTypeContent->birthplace) ? $dataTypeContent->birthplace : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ ($dataTypeContent->profession) ? $dataTypeContent->profession : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ ($dataTypeContent->service) ? $dataTypeContent->service : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="business" type="text" placeholder="Business" name="business" value="{{ ($dataTypeContent->business) ? $dataTypeContent->business : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website" type="text" placeholder="Website" name="website" value="{{ ($dataTypeContent->website) ? $dataTypeContent->website : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type) && $dataTypeContent->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type" id="phone_type" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone number</label>
                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Phone" name="phone" value="{{ ($dataTypeContent->phone) ? $dataTypeContent->phone : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ ($dataTypeContent->country_code) ? $dataTypeContent->country_code : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact) && $dataTypeContent->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Role</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="role_id" id="role_id" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            <option value="{{ $role->id }}" @if(isset($dataTypeContent->role_id) && $dataTypeContent->role_id == $role->id){{ 'selected="selected"' }} @endif>{{ $role->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Spouse</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label>Civilité</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civility_coup" id="civility_coup" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_coup) && $dataTypeContent->civility_coup == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_coup" id="lng_corres_coup"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_coup) && $dataTypeContent->lng_corres_coup == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="first_name_coup" type="text" name="first_name_coup" placeholder="First Name" value="{{ ($dataTypeContent->first_name_coup) ? $dataTypeContent->first_name_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name_coup" type="text" name="middle_name_coup" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_coup) ? $dataTypeContent->middle_name_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name_coup" type="text" name="last_name_coup" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_coup) ? $dataTypeContent->last_name_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_coup" id="civil_status_coup" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_coup) && $dataTypeContent->civil_status_coup == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_coup" name="nationality_coup" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date_coup" type="text" placeholder="Birth date" name="birth_date_coup" value="{{ ($dataTypeContent->birth_date_coup) ? $dataTypeContent->birth_date_coup : '' }}">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" id="birthplace_coup" type="text" placeholder="Place birth" name="birthplace_coup" value="{{ ($dataTypeContent->birthplace_coup) ? $dataTypeContent->birthplace_coup : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession_coup" type="text" placeholder="Profession" name="profession_coup" value="{{ ($dataTypeContent->profession_coup) ? $dataTypeContent->profession_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service_coup" type="text" placeholder="Service" name="service_coup" value="{{ ($dataTypeContent->service_coup) ? $dataTypeContent->service_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="business_coup" type="text" placeholder="Business" name="business_coup" value="{{ ($dataTypeContent->business_coup) ? $dataTypeContent->business_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website_coup" type="text" placeholder="Website" name="website_coup" value="{{ ($dataTypeContent->website_coup) ? $dataTypeContent->website_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_coup" id="email_type_coup" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_coup) && $dataTypeContent->email_type_coup == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email_coup" type="text" placeholder="Email" name="email_coup" value="{{ ($dataTypeContent->email_coup) ? $dataTypeContent->email_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_coup" id="phone_type_coup" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_coup) && $dataTypeContent->phone_type_coup == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone number</label>
                                                    <input class="form-control m-input" id="phone_coup" type="text" placeholder="Phone" name="phone_coup" value="{{ ($dataTypeContent->phone_coup) ? $dataTypeContent->phone_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code_coup" type="text" placeholder="Country code" name="country_code_coup" value="{{ ($dataTypeContent->country_code_coup) ? $dataTypeContent->country_code_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_coup" id="preferred_means_contact_coup" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_coup) && $dataTypeContent->preferred_means_contact_coup == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>Children</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label>Civilité</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civility_child" id="civility_child" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_child) && $dataTypeContent->civility_child == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_child" id="lng_corres_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_child) && $dataTypeContent->lng_corres_child == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="first_name_child" type="text" name="first_name_child" placeholder="First Name" value="{{ ($dataTypeContent->first_name_child) ? $dataTypeContent->first_name_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name_child" type="text" name="middle_name_child" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_child) ? $dataTypeContent->middle_name_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name_child" type="text" name="last_name_child" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_child) ? $dataTypeContent->last_name_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_child" id="civil_status_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_child) && $dataTypeContent->civil_status_child == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_child" name="nationality_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date_child" type="text" placeholder="Birth date" name="birth_date_child" value="{{ ($dataTypeContent->birth_date_child) ? $dataTypeContent->birth_date_child : '' }}">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" id="birthplace_child" type="text" placeholder="Place birth" name="birthplace_child" value="{{ ($dataTypeContent->birthplace_child) ? $dataTypeContent->birthplace_child : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession_child" type="text" placeholder="Profession" name="profession_child" value="{{ ($dataTypeContent->profession_child) ? $dataTypeContent->profession_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service_child" type="text" placeholder="Service" name="service_child" value="{{ ($dataTypeContent->service_child) ? $dataTypeContent->service_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="example-text-input" type="text" placeholder="Business" name="business_child" value="{{ ($dataTypeContent->business_child) ? $dataTypeContent->business_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website_child" type="text" placeholder="Website" name="website_child" value="{{ ($dataTypeContent->website_child) ? $dataTypeContent->website_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_child" id="email_type_child" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_child) && $dataTypeContent->email_type_child == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email_child" type="text" placeholder="Email" name="email_child" value="{{ ($dataTypeContent->email_child) ? $dataTypeContent->email_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_child" id="phone_type_child" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_child) && $dataTypeContent->phone_type_child == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone number</label>
                                                    <input class="form-control m-input" id="phone_child" type="text" placeholder="Phone" name="phone_child" value="{{ ($dataTypeContent->phone_child) ? $dataTypeContent->phone_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code_child" type="text" placeholder="Website" name="country_code_child" value="{{ ($dataTypeContent->country_code_child) ? $dataTypeContent->country_code_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_child" id="preferred_means_contact_child" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_child) && $dataTypeContent->preferred_means_contact_child == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="tab-pane" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset($dataTypeContent->id))
                                                    <div class="col-lg-6 margin_bottom_10">
                                                        <label class="">New password</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Change password" name="password">
                                                    </div>
                                                    <div class="col-lg-6 margin_bottom_10">
                                                        <label class="">Confirm password</label>
                                                        <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirm password" name="password">
                                                    </div>
                                                @else
                                                    <div class="col-lg-6 margin_bottom_10">
                                                        <label class="">Enter password</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Enter password" name="password">
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions">
                                        <div class="row">
                                            <div class="col-2"></div>
                                            <div class="col-7">
                                                <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">
                                                    Save changes
                                                </button>
                                                &nbsp;&nbsp;
                                                <button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
                                                    Cancel
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
    @else
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
                </div>
            </div>

            <!-- END: Subheader -->
            <div class="m-content">

                <!--begin::Form-->
                <form id="edit_create_clients" action="{{ URL::to('/admin/clients/create') }}" class="form-edit-add m-form m-form--group-seperator-dashed" role="form" action="" method="POST"> {{-- todo action --}}
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
                                            <div class="col-lg-3 col-md-6 margin_bottom_10">
                                                <label>Name</label>
                                                <input type="text" id="" class="form-control m-input" placeholder="Name" value="" name="name">
                                            </div>
                                            <div class="col-lg-3 col-md-6 margin_bottom_10">
                                                <label>Second Name</label>
                                                <input type="text" id="" class="form-control m-input" placeholder="Second Name" value="" name="last_name">
                                            </div>
                                            <div class="col-lg-3 col-md-6 margin_bottom_10">
                                                <label for="lng_corres">Langue de correspondance</label>
                                                <select class="form-control m-select2 custom_select2 elem-categories" id="lng_corres" name="lng_corres" data-placeholder="Select Floor">
                                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $lng)
                                                        <option value="{{ $lng->reference }}">{{ $lng->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-3 col-md-6 margin_bottom_10">
                                                <label>Email</label>
                                                <input type="text" id="" class="form-control m-input" placeholder="Email" value="" name="email">
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
    <script>
        jQuery.validator.addMethod( 'passwordMatch', function(value, element) {

            // The two password inputs
            var password = $("#password").val();
            var confirmPassword = $("#password_confirm").val();

            // Check for equality with the password inputs
            if (password != confirmPassword ) {
                return false;
            } else {
                return true;
            }

        }, "Your Passwords Must Match");

        // ==========================================================================
        // Registration Form : jquery validation

        $('#profile_edit_form').validate({
            // rules
            rules: {
                register_password: {
                    required: true,
                    minlength: 3
                },
                register_pass_confirm: {
                    required: true,
                    minlength: 3,
                    passwordMatch: true // set this on the field you're trying to match
                }
            },

            // messages
            messages: {
                register_password: {
                    required: "What is your password?",
                    minlength: "Your password must contain more than 3 characters"
                },
                register_pass_confirm: {
                    required: "You must confirm your password",
                    minlength: "Your password must contain more than 3 characters",
                    passwordMatch: "Your Passwords Must Match" // custom message for mismatched passwords
                }
            }
        });//end validate
    </script>
@stop