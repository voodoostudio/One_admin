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
                                        <a href="{{ URL::to('/') }}" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">
                                                    Home
                                                </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="{{ URL::to('admin/posts') }}" class="m-nav__link">
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
                                  action="{{ URL::to('admin/clients/update') }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">
                                <!-- PUT Method if we are editing -->
                            @if(isset(Auth::user()->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <div class="tab-content">
                                    <input type="hidden" name="type_profile" value="Profile">
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
                                                            <option value="{{ $civility->reference }}" @if(isset(Auth::user()->civility) && Auth::user()->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres) && Auth::user()->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="{{ (Auth::user()->middle_name) ? Auth::user()->middle_name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ (Auth::user()->last_name) ? Auth::user()->last_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset(Auth::user()->civil_status) && Auth::user()->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset(Auth::user()->nationality) && Auth::user()->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Birth date" name="birth_date" value="{{ (Auth::user()->birth_date) ? Auth::user()->birth_date : '' }}">
                                                            {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                            <span class="input-group-addon">
                                                                        <i class="la la-calendar-check-o"></i>
                                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" type="text" placeholder="Birth place" name="birthplace" value="{{ (Auth::user()->birthplace) ? Auth::user()->birthplace : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ (Auth::user()->profession) ? Auth::user()->profession : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ (Auth::user()->service) ? Auth::user()->service : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="business" type="text" placeholder="Business" name="business" value="{{ (Auth::user()->business) ? Auth::user()->business : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website" type="text" placeholder="Website" name="website" value="{{ (Auth::user()->website) ? Auth::user()->website : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset(Auth::user()->email_type) && Auth::user()->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}">
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
                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Phone" name="phone" value="{{ (Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ (Auth::user()->country_code) ? Auth::user()->country_code : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(Auth::user()->preferred_means_contact) && Auth::user()->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset(Auth::user()->id))
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
                                            <img src="{{ Voyager::image( Auth::user()->avatar ) }}" alt="{{ Auth::user()->name }} avatar"/>
                                        </div>
                                    </div>
                                    <div class="m-card-profile__details">
                                        <span class="m-card-profile__name">{{ Auth::user()->name }}</span>
                                        <a href="" class="m-card-profile__email m-link">{{ Auth::user()->email }}</a>
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
                                  action="{{ route('voyager.users.update', Auth::user()->id) }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">
                                <!-- PUT Method if we are editing -->
                            @if(isset(Auth::user()->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <div class="tab-content">
                                    <input type="hidden" name="type_profile" value="Profile">
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
                                                            <option value="{{ $civility->reference }}" @if(isset(Auth::user()->civility) && Auth::user()->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres) && Auth::user()->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="{{ (Auth::user()->middle_name) ? Auth::user()->middle_name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ (Auth::user()->last_name) ? Auth::user()->last_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status" id="civil_status" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset(Auth::user()->civil_status) && Auth::user()->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality" name="nationality" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset(Auth::user()->nationality) && Auth::user()->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date" type="text" placeholder="Birth date" name="birth_date" value="{{ (Auth::user()->birth_date) ? Auth::user()->birth_date : '' }}">
                                                            {{--<input type='text' class="form-control m-input date-type rent for-type" value="" readonly  placeholder="Sélectionner la date" name="birth_date"/>--}}
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" type="text" placeholder="Birth place" name="birthplace" value="{{ (Auth::user()->birthplace) ? Auth::user()->birthplace : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ (Auth::user()->profession) ? Auth::user()->profession : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ (Auth::user()->service) ? Auth::user()->service : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="business" type="text" placeholder="Business" name="business" value="{{ (Auth::user()->business) ? Auth::user()->business : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website" type="text" placeholder="Website" name="website" value="{{ (Auth::user()->website) ? Auth::user()->website : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type" id="email_type" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset(Auth::user()->email_type) && Auth::user()->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}">
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
                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Phone" name="phone" value="{{ (Auth::user()->phone) ? Auth::user()->phone : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ (Auth::user()->country_code) ? Auth::user()->country_code : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact" id="preferred_means_contact" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(Auth::user()->preferred_means_contact) && Auth::user()->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Role</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="role_id" id="role_id" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            <option value="{{ $role->id }}" @if(isset(Auth::user()->role_id) && Auth::user()->role_id == $role->id){{ 'selected="selected"' }} @endif>{{ $role->display_name }}</option>
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
                                                            <option value="{{ $civility->reference }}" @if(isset(Auth::user()->civility_coup) && Auth::user()->civility_coup == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_coup" id="lng_corres_coup"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres_coup) && Auth::user()->lng_corres_coup == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="first_name_coup" type="text" name="first_name_coup" placeholder="First Name" value="{{ (Auth::user()->first_name_coup) ? Auth::user()->first_name_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name_coup" type="text" name="middle_name_coup" placeholder="Middle Name" value="{{ (Auth::user()->middle_name_coup) ? Auth::user()->middle_name_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name_coup" type="text" name="last_name_coup" placeholder="Last Name" value="{{ (Auth::user()->last_name_coup) ? Auth::user()->last_name_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_coup" id="civil_status_coup" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset(Auth::user()->civil_status_coup) && Auth::user()->civil_status_coup == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_coup" name="nationality_coup" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset(Auth::user()->nationality) && Auth::user()->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date_coup" type="text" placeholder="Birth date" name="birth_date_coup" value="{{ (Auth::user()->birth_date_coup) ? Auth::user()->birth_date_coup : '' }}">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" id="birthplace_coup" type="text" placeholder="Place birth" name="birthplace_coup" value="{{ (Auth::user()->birthplace_coup) ? Auth::user()->birthplace_coup : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession_coup" type="text" placeholder="Profession" name="profession_coup" value="{{ (Auth::user()->profession_coup) ? Auth::user()->profession_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service_coup" type="text" placeholder="Service" name="service_coup" value="{{ (Auth::user()->service_coup) ? Auth::user()->service_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="business_coup" type="text" placeholder="Business" name="business_coup" value="{{ (Auth::user()->business_coup) ? Auth::user()->business_coup : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website_coup" type="text" placeholder="Website" name="website_coup" value="{{ (Auth::user()->website_coup) ? Auth::user()->website_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_coup" id="email_type_coup" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset(Auth::user()->email_type_coup) && Auth::user()->email_type_coup == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email_coup" type="text" placeholder="Email" name="email_coup" value="{{ (Auth::user()->email_coup) ? Auth::user()->email_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_coup" id="phone_type_coup" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset(Auth::user()->phone_type_coup) && Auth::user()->phone_type_coup == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone number</label>
                                                    <input class="form-control m-input" id="phone_coup" type="text" placeholder="Phone" name="phone_coup" value="{{ (Auth::user()->phone_coup) ? Auth::user()->phone_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code_coup" type="text" placeholder="Country code" name="country_code_coup" value="{{ (Auth::user()->country_code_coup) ? Auth::user()->country_code_coup : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_coup" id="preferred_means_contact_coup" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(Auth::user()->preferred_means_contact_coup) && Auth::user()->preferred_means_contact_coup == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
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
                                                            <option value="{{ $civility->reference }}" @if(isset(Auth::user()->civility_child) && Auth::user()->civility_child == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres_child" id="lng_corres_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset(Auth::user()->lng_corres_child) && Auth::user()->lng_corres_child == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="first_name_child" type="text" name="first_name_child" placeholder="First Name" value="{{ (Auth::user()->first_name_child) ? Auth::user()->first_name_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Middle name</label>
                                                    <input class="form-control m-input" id="middle_name_child" type="text" name="middle_name_child" placeholder="Middle Name" value="{{ (Auth::user()->middle_name_child) ? Auth::user()->middle_name_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name_child" type="text" name="last_name_child" placeholder="Last Name" value="{{ (Auth::user()->last_name_child) ? Auth::user()->last_name_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Civil status</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="civil_status_child" id="civil_status_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset(Auth::user()->civil_status_child) && Auth::user()->civil_status_child == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Nationality</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="nationality_child" name="nationality_child" data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset(Auth::user()->nationality) && Auth::user()->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Birth date</label>
                                                        <div class='input-group date' id='m_datepicker_4'>
                                                            <input class="form-control m-input date-type" readonly id="birth_date_child" type="text" placeholder="Birth date" name="birth_date_child" value="{{ (Auth::user()->birth_date_child) ? Auth::user()->birth_date_child : '' }}">
                                                            <span class="input-group-addon">
                                                                <i class="la la-calendar-check-o"></i>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Birth place</label>
                                                    <input class="form-control m-input" id="birthplace_child" type="text" placeholder="Place birth" name="birthplace_child" value="{{ (Auth::user()->birthplace_child) ? Auth::user()->birthplace_child : '' }}">
                                                </div>
                                            </div>

                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Profession</label>
                                                    <input class="form-control m-input" id="profession_child" type="text" placeholder="Profession" name="profession_child" value="{{ (Auth::user()->profession_child) ? Auth::user()->profession_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Service</label>
                                                    <input class="form-control m-input" id="service_child" type="text" placeholder="Service" name="service_child" value="{{ (Auth::user()->service_child) ? Auth::user()->service_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Business</label>
                                                    <input class="form-control m-input" id="example-text-input" type="text" placeholder="Business" name="business_child" value="{{ (Auth::user()->business_child) ? Auth::user()->business_child : '' }}">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="">Website</label>
                                                    <input class="form-control m-input" id="website_child" type="text" placeholder="Website" name="website_child" value="{{ (Auth::user()->website_child) ? Auth::user()->website_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="email_type_child" id="email_type_child" data-placeholder="Email type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset(Auth::user()->email_type_child) && Auth::user()->email_type_child == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email_child" type="text" placeholder="Email" name="email_child" value="{{ (Auth::user()->email_child) ? Auth::user()->email_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone type</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="phone_type_child" id="phone_type_child" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset(Auth::user()->phone_type_child) && Auth::user()->phone_type_child == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Phone number</label>
                                                    <input class="form-control m-input" id="phone_child" type="text" placeholder="Phone" name="phone_child" value="{{ (Auth::user()->phone_child) ? Auth::user()->phone_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Country code</label>
                                                    <input class="form-control m-input" id="country_code_child" type="text" placeholder="Website" name="country_code_child" value="{{ (Auth::user()->country_code_child) ? Auth::user()->country_code_child : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Preferred means of contact</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="preferred_means_contact_child" id="preferred_means_contact_child" data-placeholder="Phone type">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset(Auth::user()->preferred_means_contact_child) && Auth::user()->preferred_means_contact_child == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="profile_settings" role="tabpanel">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                @if(isset(Auth::user()->id))
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
    @endif

@stop
