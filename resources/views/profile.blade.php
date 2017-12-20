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
                            Profile
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

                                <!-- CSRF TOKEN -->
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="tab-content">
                                    <input type="hidden" name="type_users" value="Users">
                                    <div class="tab-pane active" id="profile_info" role="tabpanel" aria-expanded="true">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group row">
                                                <div class="col-12 ml-auto">
                                                    <h3>User</h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ (Auth::user()->name) ? Auth::user()->name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ (Auth::user()->last_name) ? Auth::user()->last_name : '' }}">
                                                </div>
                                                <div class="col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ (Auth::user()->email) ? Auth::user()->email : '' }}" aria-invalid="false">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label>Role</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            @if($role->id != 5)
                                                                <option value="{{ $role->id }}" @if(isset(Auth::user()->role_id) && Auth::user()->role_id == $role->id){{ 'selected="selected"' }} @endif>{{ $role->display_name }}</option>
                                                            @endif
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
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4 margin_bottom_10">
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
    @endif
@stop
