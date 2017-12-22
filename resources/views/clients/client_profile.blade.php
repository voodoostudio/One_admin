@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@php

$address = json_decode($dataTypeContent->address);

foreach ($address[0] as $key => $value) {
    echo '<br>';
    echo $key . ' <=KEY VALUE=> ' . $value;
    echo '<br>';
}



@endphp

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
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title ">
                        Profile ({{ $dataTypeContent->name }} {{ $dataTypeContent->last_name }})
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
                                    {{--<p>{{ Auth::user()->bio }}</p>--}}
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
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                            Husband / Wife
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                            Child
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
                            <div class="tab-pane active" id="m_user_profile_tab_1">
                                <form class="m-form m-form--fit m-form--label-align-right">
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
                                                Full Name
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->name . " " . $dataTypeContent->middle_name . " " . $dataTypeContent->last_name  }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Civilité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                    <span>{{ ($dataTypeContent->civility === $civility->reference) ? $civility->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Langue de correspondance
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                    <span class="m-form__help">{{ ($dataTypeContent->lng_corres === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Etat civil
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                    <span>{{ ($dataTypeContent->civil_status === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Date de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birth_date }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Lieu de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birthplace }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Nationalité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                    <span>{{ ($dataTypeContent->nationality === $nationality->reference) ? $nationality->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Profession
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->profession }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Service
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->service }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Entreprise
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->business }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Site Internet
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->website }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Courriel
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                    <span>{{ ($dataTypeContent->email_type === $email_type->reference) ? $email_type->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                    <span>{{ ($dataTypeContent->phone_type === $phone->reference) ? $phone->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->country_code . " " . $dataTypeContent->phone }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Moyen de contact préféré
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                    <span>{{ ($dataTypeContent->preferred_means_contact === $contact->reference) ? $contact->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Address
                                            </label>
                                            <div class="col-7">
                                                {{--{{ dd(json_decode($dataTypeContent->address)) }}--}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-7">
                                                    <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">
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
                            <div class="tab-pane active" id="m_user_profile_tab_2">
                                <form class="m-form m-form--fit m-form--label-align-right">
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
                                                Full Name
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->first_name_coup . " " . $dataTypeContent->middle_name_coup . " " . $dataTypeContent->last_name_coup  }}</span>
                                            </div>
                                            <div class="col-lg-2">
                                                <img style="max-width: 150px !important;" src="{{ Voyager::image( $dataTypeContent->photo_coup ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Civilité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                    <span>{{ ($dataTypeContent->civility_coup === $civility->reference) ? $civility->value : '' }}</span>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Langue de correspondance
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                    <span class="m-form__help">{{ ($dataTypeContent->lng_corres_coup === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Etat civil
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                    <span>{{ ($dataTypeContent->civil_status_coup === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Date de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birth_date_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Lieu de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birthplace_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Nationalité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                    <span>{{ ($dataTypeContent->nationality_coup === $nationality->reference) ? $nationality->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Profession
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->profession_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Service
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->service_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Entreprise
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->business_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Site Internet
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->website_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Courriel
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                    <span>{{ ($dataTypeContent->email_type_coup === $email_type->reference) ? $email_type->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                    <span>{{ ($dataTypeContent->phone_type_coup === $phone->reference) ? $phone->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->country_code_coup . " " . $dataTypeContent->phone_coup }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Moyen de contact préféré
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                    <span>{{ ($dataTypeContent->preferred_means_contact_coup === $contact->reference) ? $contact->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-7">
                                                    <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">
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
                            <div class="tab-pane active" id="m_user_profile_tab_3">
                                <form class="m-form m-form--fit m-form--label-align-right">
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
                                                Full Name
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->first_name_child . " " . $dataTypeContent->middle_name_child . " " . $dataTypeContent->last_name_child  }}</span>
                                            </div>
                                            <div class="col-lg-2 margin_bottom_10">
                                                <img style="max-width: 150px !important;" src="{{ Voyager::image( $dataTypeContent->photo_child ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Civilité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                    <span>{{ ($dataTypeContent->civility_child === $civility->reference) ? $civility->value : '' }}</span>
                                                @endforeach

                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Langue de correspondance
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                    <span class="m-form__help">{{ ($dataTypeContent->lng_corres_child === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Etat civil
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                    <span>{{ ($dataTypeContent->civil_status_child === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Date de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birth_date_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Lieu de naissance
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->birthplace_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Nationalité
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                    <span>{{ ($dataTypeContent->nationality_child === $nationality->reference) ? $nationality->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Profession
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->profession_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Service
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->service_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Entreprise
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->business_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Site Internet
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->website_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Courriel
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                    <span>{{ ($dataTypeContent->email_type_child === $email_type->reference) ? $email_type->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                    <span>{{ ($dataTypeContent->phone_type_child === $phone->reference) ? $phone->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Téléphone
                                            </label>
                                            <div class="col-7">
                                                <span>{{ $dataTypeContent->country_code_child . " " . $dataTypeContent->phone_child }}</span>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <label for="example-text-input" class="col-2 col-form-label">
                                                Moyen de contact préféré
                                            </label>
                                            <div class="col-7">
                                                @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                    <span>{{ ($dataTypeContent->preferred_means_contact_child === $contact->reference) ? $contact->value : '' }}</span>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__foot m-portlet__foot--fit">
                                        <div class="m-form__actions">
                                            <div class="row">
                                                <div class="col-2"></div>
                                                <div class="col-7">
                                                    <button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">
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
        </div>
    </div>
@stop
