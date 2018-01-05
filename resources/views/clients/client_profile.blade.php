@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@section('css')
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
                        Profil ({{ $dataTypeContent->name }} {{ $dataTypeContent->last_name }})
                    </h3>
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="row">
                <div class="col-xl-3">
                    <div class="m-portlet m-portlet--full-height ">
                        <div class="m-portlet__body">
                            <div class="m-card-profile">
                                <div class="m-card-profile__title m--hide">
                                    Votre Profil
                                </div>
                                <div class="m-card-profile__pic">
                                    <div class="m-card-profile__pic-wrapper">
                                        <img id="client_img" src="{{ Voyager::image( $dataTypeContent->avatar ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                        <img id="spouse_img" style="display: none;" src="{{ ($dataTypeContent->photo_coup) ? Voyager::image( $dataTypeContent->photo_coup ) : '/img/admin/default-coup.png' }}" alt="{{ $dataTypeContent->first_name_coup }} avatar"/>
                                        <img id="child_img" style="display: none;" src="{{ ($dataTypeContent->photo_child) ? Voyager::image( $dataTypeContent->photo_child ) : '/img/admin/default-coup.png' }}" alt="{{ $dataTypeContent->first_name_child }} avatar"/>
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span id="client_name" class="m-card-profile__name">{{ $dataTypeContent->name . " " . $dataTypeContent->middle_name . " " . $dataTypeContent->last_name  }}</span>
                                    <a id="client_email" href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email }}</a>

                                    <span id="spouse_name" style="display: none;" class="m-card-profile__name hide">{{ $dataTypeContent->first_name_coup . " " . $dataTypeContent->middle_name_coup . " " . $dataTypeContent->last_name_coup  }}</span>
                                    <a id="spouse_email" href="" style="display: none;" class="m-card-profile__email m-link">{{ $dataTypeContent->email_coup }}</a>

                                    <span id="child_name" style="display: none;" class="m-card-profile__name hide">{{ $dataTypeContent->first_name_child . " " . $dataTypeContent->middle_name_child . " " . $dataTypeContent->last_name_child }}</span>
                                    <a id="child_email" href="" style="display: none;" class="m-card-profile__email m-link">{{ $dataTypeContent->email_child }}</a>
                                    {{--<p>{{ Auth::user()->bio }}</p>--}}
                                </div>
                            </div>
                            <div class="m-portlet__body-separator"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9">
                    <div class="m-portlet m-portlet--full-height m-portlet--tabs profile_data_container">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-tools">
                                <ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
                                    <li class="nav-item m-tabs__item">
                                        <a id="client_tab" class="nav-link m-tabs__link active" data-toggle="tab" href="#m_user_profile_tab_1" role="tab">
                                            <i class="flaticon-share m--hide"></i>
                                            Client
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a id="spose_tab" class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_2" role="tab">
                                            Epoux/Epouse
                                        </a>
                                    </li>
                                    <li class="nav-item m-tabs__item">
                                        <a id="child_tab" class="nav-link m-tabs__link" data-toggle="tab" href="#m_user_profile_tab_3" role="tab">
                                            Enfant(s)
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active" id="m_user_profile_tab_1">
                                <form class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Civilité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <span>{{ ($dataTypeContent->civility === $civility->reference) ? $civility->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Langue de correspondance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <span>{{ ($dataTypeContent->lng_corres === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nom
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->name . " " . $dataTypeContent->middle_name . " " . $dataTypeContent->last_name  }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Etat civil
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <span>{{ ($dataTypeContent->civil_status === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nationalité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <span>{{ ($dataTypeContent->nationality === $nationality->reference) ? $nationality->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Date de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birth_date }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birthplace }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Profession
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->profession }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->service }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->business }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->website }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            {{--<div class="col-md-6">--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Type de courriel--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)--}}
                                            {{--<span>{{ ($dataTypeContent->email_type === $email_type->reference) ? $email_type->value : '' }}</span>--}}
                                            {{--@endforeach--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@if(!empty($dataTypeContent->client_emails))--}}
                                            {{--@foreach(json_decode($dataTypeContent->client_emails) as $email)--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Type de courriel--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--<span>--}}
                                            {{--@foreach(TCG\Voyager\Models\EmailType::all() as $email_type)--}}
                                            {{--{{ ($email_type->reference == $email->email_type) ? $email_type->value : '' }}--}}
                                            {{--@endforeach--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@endforeach--}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <span>{{ ($dataTypeContent->email_type === $email_type->reference) ? $email_type->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        {{ $dataTypeContent->email }}
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->client_emails))
                                                    @foreach(json_decode($dataTypeContent->client_emails) as $email)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                    {{ ($email_type->reference == $email->email_type) ? $email_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <p>{{ $email->email }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            {{--<div class="col-md-6">--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Type de téléphone--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--@foreach(TCG\Voyager\Models\Phone::all() as $phone)--}}
                                            {{--<span>{{ ($dataTypeContent->phone_type === $phone->reference) ? $phone->value : '' }}</span>--}}
                                            {{--@endforeach--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@if(!empty($dataTypeContent->client_phones))--}}
                                            {{--@foreach(json_decode($dataTypeContent->client_phones) as $phone)--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Type de téléphone--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--<span>--}}
                                            {{--@foreach(TCG\Voyager\Models\Phone::all() as $phone_type)--}}
                                            {{--{{ ($phone_type->reference == $phone->phone_type) ? $phone_type->value : '' }}--}}
                                            {{--@endforeach--}}
                                            {{--</span>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@endforeach--}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <span>{{ ($dataTypeContent->phone_type === $phone->reference) ? $phone->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ ($dataTypeContent->country_code) ?  "+(" .$dataTypeContent->country_code . ") " . $dataTypeContent->phone : $dataTypeContent->phone }}</span>
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->client_phones))
                                                    @foreach(json_decode($dataTypeContent->client_phones) as $phone)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                    {{ ($phone_type->reference == $phone->phone_type) ? $phone_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <span> {{ ($phone->country_code) ?  "+(" .$phone->country_code . ") " . $phone->phone : $phone->phone }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            {{--<div class="col-md-6">--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Téléphone--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--<span>{{ ($dataTypeContent->country_code) ?  "+(" .$dataTypeContent->country_code . ") " . $dataTypeContent->phone : $dataTypeContent->phone }}</span>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@if(!empty($dataTypeContent->client_phones))--}}
                                            {{--@foreach(json_decode($dataTypeContent->client_phones) as $phone)--}}
                                            {{--<div class="profile_data_block">--}}
                                            {{--<label class="profile_data_label">--}}
                                            {{--Téléphone--}}
                                            {{--</label>--}}
                                            {{--<div class="profile_data_value">--}}
                                            {{--<span> {{ ($phone->country_code) ?  "+(" .$phone->country_code . ") " . $phone->phone : $phone->phone }}</span>--}}
                                            {{--</div>--}}
                                            {{--</div>--}}
                                            {{--@endforeach--}}
                                            {{--@endif--}}
                                            {{--</div>--}}
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Moyen de contact préféré
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <span>{{ ($dataTypeContent->preferred_means_contact === $contact->reference) ? $contact->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            @foreach(json_decode($dataTypeContent->address) as $key => $value)
                                                <div class="col-md-6">
                                                    <div class="profile_data_block">
                                                        <label class="profile_data_label" style="display: table; width: 100%">
                                                            <span style="float: left;">Address</span>
                                                            <span class="address_name">{{ $value->address_name }}</span>
                                                        </label>
                                                        <div class="profile_data_value" style="width: 100%; margin: 10px 0 15px">
                                                            {{--{!! '<br>' !!}--}}
                                                            {{ $value->address }}
                                                            {{--{{ $value->street }}--}}
                                                            {{--{{ $value->number }}--}}
                                                            {{--{{ $value->po_box }}--}}
                                                            {{--{{ $value->zip_code }}--}}
                                                            {{--{{ $value->town }}--}}
                                                            {{--{{ $value->country }}--}}
                                                            {{--{{ $value->location }}--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="m_user_profile_tab_2">
                                <form class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Civilité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <span>{{ ($dataTypeContent->civility_coup === $civility->reference) ? $civility->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Langue de correspondance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <span>{{ ($dataTypeContent->lng_corres_coup === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nom
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->first_name_coup . " " . $dataTypeContent->middle_name_coup . " " . $dataTypeContent->last_name_coup  }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Etat civil
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <span>{{ ($dataTypeContent->civil_status_coup === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nationalité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <span>{{ ($dataTypeContent->nationality_coup === $nationality->reference) ? $nationality->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Date de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birth_date_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birthplace_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Profession
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->profession_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->service_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->business_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->website_coup }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <span>{{ ($dataTypeContent->email_type_coup === $email_type->reference) ? $email_type->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        {{ $dataTypeContent->email_coup }}
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->coup_emails))
                                                    @foreach(json_decode($dataTypeContent->coup_emails) as $email)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                    {{ ($email_type->reference == $email->email_type) ? $email_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <span>{{ $email->email }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <span>{{ ($dataTypeContent->phone_type_coup === $phone->reference) ? $phone->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ ($dataTypeContent->country_code_coup) ?  "+(" .$dataTypeContent->country_code_coup . ") " . $dataTypeContent->phone_coup : $dataTypeContent->phone_coup }}</span>
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->coup_phones))
                                                    @foreach(json_decode($dataTypeContent->coup_phones) as $phone)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                    {{ ($phone_type->reference == $phone->phone_type) ? $phone_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <span> {{ ($phone->country_code) ?  "+(" .$phone->country_code . ") " . $phone->phone : $phone->phone }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Moyen de contact préféré
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <span>{{ ($dataTypeContent->preferred_means_contact_coup === $contact->reference) ? $contact->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="m_user_profile_tab_3">
                                <form class="m-form m-form--label-align-right m-form--group-seperator-dashed">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Civilité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                                            <span>{{ ($dataTypeContent->civility_child === $civility->reference) ? $civility->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Langue de correspondance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <span>{{ ($dataTypeContent->lng_corres_child === $user_lng->reference) ? $user_lng->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nom
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->first_name_child . " " . $dataTypeContent->middle_name_child . " " . $dataTypeContent->last_name_coup  }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Etat civil
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                                            <span>{{ ($dataTypeContent->civil_status_child === $civil_stat->reference) ? $civil_stat->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Nationalité
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                                            <span>{{ ($dataTypeContent->nationality_child === $nationality->reference) ? $nationality->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Date de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birth_date_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->birthplace_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Profession
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->profession_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->service_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->business_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>{{ $dataTypeContent->website_child }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                            <span>{{ ($dataTypeContent->email_type_child === $email_type->reference) ? $email_type->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        {{ $dataTypeContent->email_child }}
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->children_emails))
                                                    @foreach(json_decode($dataTypeContent->children_emails) as $email)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                                                    {{ ($email_type->reference == $email->email_type) ? $email_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <span>{{ $email->email }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                                            <span>{{ ($dataTypeContent->phone_type_child === $phone->reference) ? $phone->value : '' }}</span>
                                                        @endforeach
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span> {{ ($dataTypeContent->country_code_child) ?  "+(" .$dataTypeContent->country_code_child . ") " . $dataTypeContent->phone_child : $dataTypeContent->phone_child }}</span>
                                                    </div>
                                                </div>
                                                @if(!empty($dataTypeContent->children_phones))
                                                    @foreach(json_decode($dataTypeContent->children_phones) as $phone)
                                                        <div class="profile_data_block">
                                                            <label class="profile_data_label">
                                                                @foreach(TCG\Voyager\Models\Phone::all() as $phone_type)
                                                                    {{ ($phone_type->reference == $phone->phone_type) ? $phone_type->value : '' }}
                                                                @endforeach
                                                            </label>
                                                            <div class="profile_data_value">
                                                                <span> {{ ($phone->country_code) ?  "+(" .$phone->country_code . ") " . $phone->phone : $phone->phone }}</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Moyen de contact préféré
                                                    </label>
                                                    <div class="profile_data_value">
                                                        @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                                            <span>{{ ($dataTypeContent->preferred_means_contact_child === $contact->reference) ? $contact->value : '' }}</span>
                                                        @endforeach
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
    </div>
@stop

@section('javascript')
    <script>

        $('#client_tab').click(function () {
            /* photos */
            $('#client_img').css('display','block');
            $('#spouse_img').css('display','none');
            $('#child_img').css('display','none');

            /* data */
            $('#client_name').css('display','block');
            $('#client_email').css('display','block');
            $('#spouse_name').css('display','none');
            $('#spouse_email').css('display','none');
            $('#child_name').css('display','none');
            $('#child_email').css('display','none');
        });

        $('#spose_tab').click(function () {
            /* photos */
            $('#client_img').css('display','none');
            $('#spouse_img').css('display','block');
            $('#child_img').css('display','none');

            /* data */
            $('#client_name').css('display','none');
            $('#client_email').css('display','none');
            $('#spouse_name').css('display','block');
            $('#spouse_email').css('display','block');
            $('#child_name').css('display','none');
            $('#child_email').css('display','none');
        });

        $('#child_tab').click(function () {
            /* photos */
            $('#client_img').css('display','none');
            $('#spouse_img').css('display','none');
            $('#child_img').css('display','block');

            /* data */
            $('#client_name').css('display','none');
            $('#client_email').css('display','none');
            $('#spouse_name').css('display','none');
            $('#spouse_email').css('display','none');
            $('#child_name').css('display','block');
            $('#child_email').css('display','block');
        });

    </script>
@stop