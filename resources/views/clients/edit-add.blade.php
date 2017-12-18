@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('css/ga-embed.css') }}">
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
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-profile-1"></i>
                                            <span class="m-nav__link-title">
                                                <span class="m-nav__link-wrap">
                                                    <span class="m-nav__link-text">
                                                        My Profile
                                                    </span>
                                                    <span class="m-nav__link-badge">
                                                        <span class="m-badge m-badge--success">
                                                            2
                                                        </span>
                                                    </span>
                                                </span>
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-share"></i>
                                            <span class="m-nav__link-text">
                                                Activity
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                            <span class="m-nav__link-text">
                                                Messages
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-graphic-2"></i>
                                            <span class="m-nav__link-text">
                                                Sales
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-time-3"></i>
                                            <span class="m-nav__link-text">
                                                Events
                                            </span>
                                        </a>
                                    </li>
                                    <li class="m-nav__item">
                                        <a href="../header/profile&amp;demo=default.html" class="m-nav__link">
                                            <i class="m-nav__link-icon flaticon-lifebuoy"></i>
                                            <span class="m-nav__link-text">
                                                            Support
                                                        </span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="m-portlet__body-separator"></div>
                                <div class="m-widget1 m-widget1--paddingless">
                                    <div class="m-widget1__item">
                                        <div class="row m-row--no-padding align-items-center">
                                            <div class="col">
                                                <h3 class="m-widget1__title">
                                                    Member Profit
                                                </h3>
                                                <span class="m-widget1__desc">
                                                                Awerage Weekly Profit
                                                            </span>
                                            </div>
                                            <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-brand">
                                                                +$17,800
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="row m-row--no-padding align-items-center">
                                            <div class="col">
                                                <h3 class="m-widget1__title">
                                                    Orders
                                                </h3>
                                                <span class="m-widget1__desc">
                                                                Weekly Customer Orders
                                                            </span>
                                            </div>
                                            <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-danger">
                                                                +1,800
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-widget1__item">
                                        <div class="row m-row--no-padding align-items-center">
                                            <div class="col">
                                                <h3 class="m-widget1__title">
                                                    Issue Reports
                                                </h3>
                                                <span class="m-widget1__desc">
                                                                System bugs and issues
                                                            </span>
                                            </div>
                                            <div class="col m--align-right">
                                                            <span class="m-widget1__number m--font-success">
                                                                -27,49%
                                                            </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="m-portlet m-portlet--full-height m-portlet--tabs ">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-tools">
                                    <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                                <i class="flaticon-share m--hide"></i>
                                                Update Profile
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                                Messages
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                                Settings
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="m-portlet__head-tools">
                                    <ul class="m-portlet__nav">
                                        <li class="m-portlet__nav-item">
                                            <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">
                                                    <i class="la la-plus"></i>
                                                </a>
                                                <div class="m-dropdown__wrapper">
                                                    <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                                    <div class="m-dropdown__inner">
                                                        <div class="m-dropdown__body">
                                                            <div class="m-dropdown__content">
                                                                <ul class="m-nav">
                                                                    <li class="m-nav__section m-nav__section--first">
                                                                                    <span class="m-nav__section-text">
                                                                                        Quick Actions
                                                                                    </span>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-share"></i>
                                                                            <span class="m-nav__link-text">
                                                                                            Create Post
                                                                                        </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                            <span class="m-nav__link-text">
                                                                                            Send Messages
                                                                                        </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__item">
                                                                        <a href="" class="m-nav__link">
                                                                            <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                                            <span class="m-nav__link-text">
                                                                                            Upload File
                                                                                        </span>
                                                                        </a>
                                                                    </li>
                                                                    <li class="m-nav__section">
                                                                                    <span class="m-nav__section-text">
                                                                                        Useful Links
                                                                                    </span>
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
                                                                    <li class="m-nav__separator m-nav__separator--fit m--hide"></li>
                                                                    <li class="m-nav__item m--hide">
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
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                <form
                                        class="m-form m-form--fit m-form--label-align-right form-edit-add"
                                        action="{{ route('voyager.users.update', $dataTypeContent->id) }}"
                                        method="POST" enctype="multipart/form-data">
                                    <!-- PUT Method if we are editing -->
                                @if(isset($dataTypeContent->id))
                                    {{ method_field("PUT") }}
                                @endif
                                <!-- CSRF TOKEN -->
                                    {{ csrf_field() }}
                                    <input type="hidden" name="type_clients" value="Clients">
                                    <div class="tab-pane active" id="m_user_profile_tab_1">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group m--margin-top-10 m--hide">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-10 ml-auto">
                                                    <h3 class="m-form__section">
                                                        1. Personal Details
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Civilité
                                                </label>
                                                <div class="col-7">
                                                    <select name="civility" id="select_civil">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility) && $dataTypeContent->civility == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select language</label>
                                                <div class="col-7">
                                                    <select name="lng_corres" id="lng_corres">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you first name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="name" type="text" name="name" placeholder="First name" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you middle name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="middle_name" type="text" name="middle_name" placeholder="Middle name" value="{{ ($dataTypeContent->middle_name) ? $dataTypeContent->middle_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you last name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Select civil status
                                                </label>
                                                <div class="col-7">
                                                    <select name="civil_status" id="civil_status">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status) && $dataTypeContent->civil_status == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="birth_date" class="col-2 col-form-label">
                                                    Enter you birth date
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="birth_date" type="text" placeholder="Birth date" name="birth_date" value="{{ ($dataTypeContent->birth_date) ? $dataTypeContent->birth_date : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you place birth
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" type="text" placeholder="Place birth" name="birthplace" value="{{ ($dataTypeContent->birthplace) ? $dataTypeContent->birthplace : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter nationality
                                                </label>
                                                <div class="col-7">
                                                    <select id="nationality" name="nationality">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter profession
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="profession" type="text" placeholder="Profession" name="profession" value="{{ ($dataTypeContent->profession) ? $dataTypeContent->profession : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter service</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="service" type="text" placeholder="Service" name="service" value="{{ ($dataTypeContent->service) ? $dataTypeContent->service : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="business" class="col-2 col-form-label">Enter business</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="business" type="text" placeholder="Business" name="business" value="{{ ($dataTypeContent->business) ? $dataTypeContent->business : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter website</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="website" type="text" placeholder="Website" name="website" value="{{ ($dataTypeContent->website) ? $dataTypeContent->website : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select email type</label>
                                                <div class="col-7">
                                                    <select name="email_type" id="email_type">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type) && $dataTypeContent->email_type == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select phone type</label>
                                                <div class="col-7">
                                                    <select name="phone_type" id="phone_type">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter country code</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="country_code" type="text" placeholder="Country code" name="country_code" value="{{ ($dataTypeContent->country_code) ? $dataTypeContent->country_code : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter phone</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="phone" type="text" placeholder="Phone" name="phone" value="{{ ($dataTypeContent->phone) ? $dataTypeContent->phone : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter email</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                @if(isset($dataTypeContent->id))
                                                    <label for="example-text-input" class="col-2 col-form-label">Change password</label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Change password" name="password">
                                                    </div>
                                                @else
                                                    <label for="example-text-input" class="col-2 col-form-label">Enter password</label>
                                                    <div class="col-7">
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Enter password" name="password">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Preferred means of contact</label>
                                                <div class="col-7">
                                                    <select name="preferred_means_contact" id="preferred_means_contact">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact) && $dataTypeContent->preferred_means_contact == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">ROLE ID</label>
                                                <div class="col-7">
                                                    {{--{{ dd(TCG\Voyager\Models\Role::all()->toArray()) }}--}}
                                                    <select name="role_id" id="role_id">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            <option value="{{ $role->id }}" @if(isset($dataTypeContent->role_id) && $dataTypeContent->role_id == $role->id){{ 'selected="selected"' }} @endif>{{ $role->display_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active" id="m_user_profile_tab_2">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group m--margin-top-10 m--hide">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-10 ml-auto">
                                                    <h3 class="m-form__section">
                                                        2. Personal Details
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Civilité
                                                </label>
                                                <div class="col-7">
                                                    <select name="civility_coup" id="civility_coup">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_coup) && $dataTypeContent->civility_coup == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select language</label>
                                                <div class="col-7">
                                                    <select name="lng_corres_coup" id="lng_corres_coup">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_coup) && $dataTypeContent->lng_corres_coup == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you first name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="first_name_coup" type="text" name="first_name_coup" placeholder="First Name" value="{{ ($dataTypeContent->first_name_coup) ? $dataTypeContent->first_name_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you middle name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="middle_name_coup" type="text" name="middle_name_coup" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_coup) ? $dataTypeContent->middle_name_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you last name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="last_name_coup" type="text" name="last_name_coup" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_coup) ? $dataTypeContent->last_name_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Select civil status
                                                </label>
                                                <div class="col-7">
                                                    <select name="civil_status_coup" id="civil_status_coup">
                                                        {{--{{ dd(TCG\Voyager\Models\CivilStatus::all()->toArray()) }}--}}
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_coup) && $dataTypeContent->civil_status_coup == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="birth_date_coup" class="col-2 col-form-label">
                                                    Enter you birth date
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="birth_date_coup" type="text" placeholder="Birth date" name="birth_date_coup" value="{{ ($dataTypeContent->birth_date_coup) ? $dataTypeContent->birth_date_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="birthplace_coup" class="col-2 col-form-label">
                                                    Enter you place birth
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="birthplace_coup" type="text" placeholder="Place birth" name="birthplace_coup" value="{{ ($dataTypeContent->birthplace_coup) ? $dataTypeContent->birthplace_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter nationality
                                                </label>
                                                <div class="col-7">
                                                    <select id="nationality_coup" name="nationality_coup">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter profession
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="profession_coup" type="text" placeholder="Profession" name="profession_coup" value="{{ ($dataTypeContent->profession_coup) ? $dataTypeContent->profession_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter service</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="service_coup" type="text" placeholder="Service" name="service_coup" value="{{ ($dataTypeContent->service_coup) ? $dataTypeContent->service_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter Business</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="business_coup" type="text" placeholder="Business" name="business_coup" value="{{ ($dataTypeContent->business_coup) ? $dataTypeContent->business_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter website</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="website_coup" type="text" placeholder="Website" name="website_coup" value="{{ ($dataTypeContent->website_coup) ? $dataTypeContent->website_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select email type</label>
                                                <div class="col-7">
                                                    <select name="email_type_coup" id="email_type_coup">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_coup) && $dataTypeContent->email_type_coup == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select phone type</label>
                                                <div class="col-7">
                                                    <select name="phone_type_coup" id="phone_type_coup">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_coup) && $dataTypeContent->phone_type_coup == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="country_code_coup" class="col-2 col-form-label">Enter country code</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="country_code_coup" type="text" placeholder="Country code" name="country_code_coup" value="{{ ($dataTypeContent->country_code_coup) ? $dataTypeContent->country_code_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter phone</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="phone_coup" type="text" placeholder="Phone" name="phone_coup" value="{{ ($dataTypeContent->phone_coup) ? $dataTypeContent->phone_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="email_coup" class="col-2 col-form-label">Enter email</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="email_coup" type="text" placeholder="Email" name="email_coup" value="{{ ($dataTypeContent->email_coup) ? $dataTypeContent->email_coup : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Preferred means of contact</label>
                                                <div class="col-7">
                                                    <select name="preferred_means_contact_coup" id="preferred_means_contact_coup">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_coup) && $dataTypeContent->preferred_means_contact_coup == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane active" id="m_user_profile_tab_3">
                                        <div class="m-portlet__body">
                                            <div class="form-group m-form__group m--margin-top-10 m--hide">
                                                <div class="alert m-alert m-alert--default" role="alert">
                                                    The example form below demonstrates common HTML form elements that receive updated styles from Bootstrap with additional classes.
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-10 ml-auto">
                                                    <h3 class="m-form__section">
                                                        3. Personal Details
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Civilité
                                                </label>
                                                <div class="col-7">
                                                    <select name="civility_child" id="civility_child">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <option value="{{ $civility->reference }}" @if(isset($dataTypeContent->civility_child) && $dataTypeContent->civility_child == $civility->reference){{ 'selected="selected"' }} @endif>{{ $civility->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select language</label>
                                                <div class="col-7">
                                                    <select name="lng_corres_child" id="lng_corres_child">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres_child) && $dataTypeContent->lng_corres_child == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you first name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="first_name_child" type="text" name="first_name_child" placeholder="First Name" value="{{ ($dataTypeContent->first_name_child) ? $dataTypeContent->first_name_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you middle name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="middle_name_child" type="text" name="middle_name_child" placeholder="Middle Name" value="{{ ($dataTypeContent->middle_name_child) ? $dataTypeContent->middle_name_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter you last name
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="last_name_child" type="text" name="last_name_child" placeholder="Last Name" value="{{ ($dataTypeContent->last_name_child) ? $dataTypeContent->last_name_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Select civil status
                                                </label>
                                                <div class="col-7">
                                                    <select name="civil_status_child" id="civil_status_child">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <option value="{{ $civil_stat->reference }}" @if(isset($dataTypeContent->civil_status_child) && $dataTypeContent->civil_status_child == $civil_stat->reference){{ 'selected="selected"' }} @endif>{{ $civil_stat->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="birth_date_child" class="col-2 col-form-label">
                                                    Enter you birth date
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="birth_date_child" type="text" placeholder="Birth date" name="birth_date_child" value="{{ ($dataTypeContent->birth_date_child) ? $dataTypeContent->birth_date_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for=birthplace_child" class="col-2 col-form-label">
                                                    Enter you place birth
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="birthplace_child" type="text" placeholder="Place birth" name="birthplace_child" value="{{ ($dataTypeContent->birthplace_child) ? $dataTypeContent->birthplace_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter nationality
                                                </label>
                                                <div class="col-7">
                                                    <select id="nationality_child" name="nationality_child">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <option value="{{ $nationality->reference }}" @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference){{ 'selected="selected"' }} @endif>{{ $nationality->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">
                                                    Enter profession
                                                </label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="profession_child" type="text" placeholder="Profession" name="profession_child" value="{{ ($dataTypeContent->profession_child) ? $dataTypeContent->profession_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter service</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="service_child" type="text" placeholder="Service" name="service_child" value="{{ ($dataTypeContent->service_child) ? $dataTypeContent->service_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter business</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="example-text-input" type="text" placeholder="Business" name="business_child" value="{{ ($dataTypeContent->business_child) ? $dataTypeContent->business_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter website</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="website_child" type="text" placeholder="Website" name="website_child" value="{{ ($dataTypeContent->website_child) ? $dataTypeContent->website_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select email type</label>
                                                <div class="col-7">
                                                    <select name="email_type_child" id="email_type_child">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <option value="{{ $email_type->reference }}" @if(isset($dataTypeContent->email_type_child) && $dataTypeContent->email_type_child == $email_type->reference){{ 'selected="selected"' }} @endif>{{ $email_type->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Select phone type</label>
                                                <div class="col-7">
                                                    <select name="phone_type_child" id="phone_type_child">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <option value="{{ $phone->reference }}" @if(isset($dataTypeContent->phone_type_child) && $dataTypeContent->phone_type_child == $phone->reference){{ 'selected="selected"' }} @endif>{{ $phone->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="country_code_child" class="col-2 col-form-label">Select country code</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="country_code_child" type="text" placeholder="Website" name="country_code_child" value="{{ ($dataTypeContent->country_code_child) ? $dataTypeContent->country_code_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter phone</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="phone_child" type="text" placeholder="Phone" name="phone_child" value="{{ ($dataTypeContent->phone_child) ? $dataTypeContent->phone_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Enter email</label>
                                                <div class="col-7">
                                                    <input class="form-control m-input" id="email_child" type="text" placeholder="Email" name="email_child" value="{{ ($dataTypeContent->email_child) ? $dataTypeContent->email_child : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <label for="example-text-input" class="col-2 col-form-label">Preferred means of contact</label>
                                                <div class="col-7">
                                                    <select name="preferred_means_contact_child" id="preferred_means_contact_child">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <option value="{{ $contact->reference }}" @if(isset($dataTypeContent->preferred_means_contact_child) && $dataTypeContent->preferred_means_contact_child == $contact->reference){{ 'selected="selected"' }} @endif>{{ $contact->value }}</option>
                                                        @endforeach
                                                    </select>
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
                                    </div>
                                </form>
                            </div>
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
