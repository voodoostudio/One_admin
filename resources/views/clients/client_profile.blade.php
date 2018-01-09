@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}
{{--{{ dd(json_decode($dataTypeContent->second_child)) }}--}}

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
                                        <img id="client_photo" src="{{ Voyager::image( $dataTypeContent->avatar ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                        <img id="coup_photo" style="display: none;" src="{{ ($dataTypeContent->photo_coup) ? Voyager::image( $dataTypeContent->photo_coup ) : '/img/admin/default-coup.png' }}" alt="{{ $dataTypeContent->first_name_coup }} avatar"/>
                                        <img id="child_photo" style="display: none;" src="{{ ($dataTypeContent->photo_child) ? Voyager::image( $dataTypeContent->photo_child ) : '/img/admin/default-coup.png' }}" alt="{{ $dataTypeContent->first_name_child }} avatar"/>
                                        {{--@if($dataTypeContent->second_child_photo != null)--}}
                                            {{--<img id="child_photo_s" style="display: none;" src="{{ Voyager::image( $dataTypeContent->second_child_photo ) }}" alt="{{ json_decode($dataTypeContent->second_child)->first_name }} avatar"/>--}}
                                        {{--@else--}}
                                            {{--<img id="child_photo_s" style="display: none;" src="{{ Voyager::image( '/img/admin/default-coup.png' ) }}" alt="Avatar"/>--}}
                                        {{--@endif--}}
                                        {{--@if($dataTypeContent->third_child_photo != null)--}}
                                            {{--<img id="child_photo_t" style="display: none;" src="{{ ( Voyager::image( $dataTypeContent->third_child_photo ) }}" alt="{{ json_decode($dataTypeContent->third_child)->first_name }} avatar"/>--}}
                                        {{--@else--}}
                                            {{--<img id="child_photo_t" style="display: none;" src="{{ Voyager::image( '/img/admin/default-coup.png' ) }}" alt="Avatar"/>--}}
                                        {{--@endif--}}
                                        {{--@if($dataTypeContent->fourth_child_photo != null)--}}
                                            {{--<img id="child_photo_f" style="display: none;" src="{{ Voyager::image( $dataTypeContent->fourth_child_photo ) }}" alt="{{ json_decode($dataTypeContent->fourth_child)->first_name }} avatar"/>--}}
                                        {{--@else--}}
                                            {{--<img id="child_photo_f" style="display: none;" src="{{ Voyager::image('/img/admin/default-coup.png') }}" alt="Avatar"/>--}}
                                        {{--@endif--}}
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span id="client_name" class="m-card-profile__name">{{ $dataTypeContent->name . " " . $dataTypeContent->middle_name . " " . $dataTypeContent->last_name  }}</span>
                                    <a id="client_email" href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email }}</a>

                                    <span id="coup_name" style="display: none;" class="m-card-profile__name hide">{{ $dataTypeContent->first_name_coup . " " . $dataTypeContent->middle_name_coup . " " . $dataTypeContent->last_name_coup  }}</span>
                                    <a id="coup_email" href="" style="display: none;" class="m-card-profile__email m-link">{{ $dataTypeContent->email_coup }}</a>

                                    <span id="child_name" style="display: none;" class="m-card-profile__name hide">{{ $dataTypeContent->first_name_child . " " . $dataTypeContent->middle_name_child . " " . $dataTypeContent->last_name_child }}</span>
                                    <a id="child_email" href="" style="display: none;" class="m-card-profile__email m-link">{{ $dataTypeContent->email_child }}</a>

                                    <!----------->
                                    <span id="child_name_s" style="display: none;" class="m-card-profile__name hide">{{ json_decode($dataTypeContent->second_child)->first_name . " " . json_decode($dataTypeContent->second_child)->middle_name . " " . json_decode($dataTypeContent->second_child)->last_name }}</span>
                                    @for($i = 0; $i < 1;$i++)
                                        <a id="child_email_s" href="" style="display: none;" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->second_child_emails)[$i]->email }}</a>
                                    @endfor
                                    <span id="child_name_t" style="display: none;" class="m-card-profile__name hide">{{ json_decode($dataTypeContent->third_child)->first_name . " " . json_decode($dataTypeContent->third_child)->middle_name . " " . json_decode($dataTypeContent->third_child)->last_name }}</span>
                                    @for($i = 0; $i < 1;$i++)
                                        <a id="child_email_t" href="" style="display: none;" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->third_child_emails)[$i]->email }}</a>
                                    @endfor
                                    <span id="child_name_f" style="display: none;" class="m-card-profile__name hide">{{ json_decode($dataTypeContent->fourth_child)->first_name . " " . json_decode($dataTypeContent->fourth_child)->middle_name . " " . json_decode($dataTypeContent->fourth_child)->last_name }}</span>
                                    @for($i = 0; $i < 1;$i++)
                                        <a id="child_email_f" href="" style="display: none;" class="m-card-profile__email m-link">{{ json_decode($dataTypeContent->fourth_child_emails)[$i]->email }}</a>
                                    @endfor
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

                                    @if(!empty(json_decode($dataTypeContent->second_child)->first_name))
                                        <li class="nav-item m-tabs__item">
                                            <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_0" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Enfant(s)
                                            </a>
                                        </li>
                                    @endif

                                    @if(!empty(json_decode($dataTypeContent->third_child)->first_name))
                                        <li class="nav-item m-tabs__item">
                                            <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_1" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Enfant(s)
                                            </a>
                                        </li>
                                    @endif

                                    @if(!empty(json_decode($dataTypeContent->fourth_child)->first_name))
                                        <li class="nav-item m-tabs__item">
                                            <a id="client_child" class="nav-link m-tabs__link" data-toggle="tab" href="#profile_info_child_2" role="tab"  aria-expanded="true">
                                                <i class="flaticon-share m--hide"></i>
                                                Enfant(s)
                                            </a>
                                        </li>
                                    @endif

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
                                                            <span>
                                                                @if(isset($dataTypeContent->nationality) && $dataTypeContent->nationality == $nationality->reference)
                                                                    {{ $nationality->value }}
                                                                @endif
                                                            </span>
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

                            <div class="tab-pane" id="{{ (json_decode($dataTypeContent->second_child) !== null) ? 'profile_info_child_0' : '' }}">
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->second_child)->civility) && json_decode($dataTypeContent->second_child)->civility == $civility->reference) ? $civility->value : '' }}</span>
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->second_child)->lng_corres) && json_decode($dataTypeContent->second_child)->lng_corres && json_decode($dataTypeContent->second_child)->lng_corres == $user_lng->reference) ? $user_lng->value : '' }}</span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->first_name))
                                                                {{ json_decode($dataTypeContent->second_child)->first_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->second_child)->middle_name))
                                                                {{ json_decode($dataTypeContent->second_child)->middle_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->second_child)->last_name))
                                                                {{ json_decode($dataTypeContent->second_child)->last_name }}
                                                            @endif
                                                        </span>
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
                                                            <span>@if(isset(json_decode($dataTypeContent->second_child)->civil_status) && json_decode($dataTypeContent->second_child)->civil_status == $civil_stat->reference){{ $civil_stat->value }}@endif</span>
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
                                                            <span>
                                                                @if(isset(json_decode($dataTypeContent->second_child)->nationality) && json_decode($dataTypeContent->second_child)->nationality == $nationality->reference)
                                                                    {{ $nationality->value }}
                                                                @endif
                                                            </span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->birth_date))
                                                                {{ json_decode($dataTypeContent->second_child)->birth_date }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->birthplace))
                                                                {{ json_decode($dataTypeContent->second_child)->birthplace }}
                                                            @endif
                                                        </span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->profession))
                                                                {{ json_decode($dataTypeContent->second_child)->profession }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->service))
                                                                {{ json_decode($dataTypeContent->second_child)->service }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->business))
                                                                {{ json_decode($dataTypeContent->second_child)->business }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->second_child)->website))
                                                                {{ json_decode($dataTypeContent->second_child)->website }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                @if(!empty(json_decode($dataTypeContent->second_child_emails)))
                                                    @foreach(json_decode($dataTypeContent->second_child_emails) as $email)
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
                                                @if(!empty(json_decode($dataTypeContent->second_child_phones)))
                                                    @foreach(json_decode($dataTypeContent->second_child_phones) as $phone)
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->second_child)->preferred_means_contact) && json_decode($dataTypeContent->second_child)->preferred_means_contact == $contact->reference) ? $contact->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="{{ (json_decode($dataTypeContent->third_child) !== null) ? 'profile_info_child_1' : '' }}">
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->third_child)->civility) && json_decode($dataTypeContent->third_child)->civility == $civility->reference) ? $civility->value : '' }}</span>
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->third_child)->lng_corres) && json_decode($dataTypeContent->third_child)->lng_corres && json_decode($dataTypeContent->second_child)->lng_corres == $user_lng->reference) ? $user_lng->value : '' }}</span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->first_name))
                                                                {{ json_decode($dataTypeContent->third_child)->first_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->third_child)->middle_name))
                                                                {{ json_decode($dataTypeContent->third_child)->middle_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->third_child)->last_name))
                                                                {{ json_decode($dataTypeContent->third_child)->last_name }}
                                                            @endif
                                                        </span>
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
                                                            <span>@if(isset(json_decode($dataTypeContent->third_child)->civil_status) && json_decode($dataTypeContent->third_child)->civil_status == $civil_stat->reference){{ $civil_stat->value }}@endif</span>
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
                                                            @if(isset(json_decode($dataTypeContent->third_child)->nationality) && json_decode($dataTypeContent->third_child)->nationality == $nationality->reference)
                                                                {{ $nationality->value }}
                                                            @endif
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->birth_date))
                                                                {{ json_decode($dataTypeContent->third_child)->birth_date }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->birthplace))
                                                                {{ json_decode($dataTypeContent->third_child)->birthplace }}
                                                            @endif
                                                        </span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->profession))
                                                                {{ json_decode($dataTypeContent->third_child)->profession }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->service))
                                                                {{ json_decode($dataTypeContent->third_child)->service }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->business))
                                                                {{ json_decode($dataTypeContent->third_child)->business }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->third_child)->website))
                                                                {{ json_decode($dataTypeContent->third_child)->website }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                @if(!empty(json_decode($dataTypeContent->third_child_emails)))
                                                    @foreach(json_decode($dataTypeContent->third_child_emails) as $email)
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
                                                @if(!empty(json_decode($dataTypeContent->third_child_phones)))
                                                    @foreach(json_decode($dataTypeContent->third_child_phones) as $phone)
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->third_child)->preferred_means_contact) && json_decode($dataTypeContent->third_child)->preferred_means_contact == $contact->reference) ? $contact->value : '' }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="{{ (json_decode($dataTypeContent->fourth_child) !== null) ? 'profile_info_child_2' : '' }}">
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->fourth_child)->civility) && json_decode($dataTypeContent->fourth_child)->civility == $civility->reference) ? $civility->value : '' }}</span>
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->fourth_child)->lng_corres) && json_decode($dataTypeContent->fourth_child)->lng_corres && json_decode($dataTypeContent->fourth_child)->lng_corres == $user_lng->reference) ? $user_lng->value : '' }}</span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->first_name))
                                                                {{ json_decode($dataTypeContent->fourth_child)->first_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->middle_name))
                                                                {{ json_decode($dataTypeContent->fourth_child)->middle_name }}
                                                            @endif
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->last_name))
                                                                {{ json_decode($dataTypeContent->fourth_child)->last_name }}
                                                            @endif
                                                        </span>
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
                                                            <span>@if(isset(json_decode($dataTypeContent->fourth_child)->civil_status) && json_decode($dataTypeContent->fourth_child)->civil_status == $civil_stat->reference){{ $civil_stat->value }}@endif</span>
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
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->nationality) && json_decode($dataTypeContent->fourth_child)->nationality == $nationality->reference)
                                                                {{ $nationality->value }}
                                                            @endif
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->birth_date))
                                                                {{ json_decode($dataTypeContent->fourth_child)->birth_date }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Lieu de naissance
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->birthplace))
                                                                {{ json_decode($dataTypeContent->fourth_child)->birthplace }}
                                                            @endif
                                                        </span>
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
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->profession))
                                                                {{ json_decode($dataTypeContent->fourth_child)->profession }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Service
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->service))
                                                                {{ json_decode($dataTypeContent->fourth_child)->service }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Entreprise
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->business))
                                                                {{ json_decode($dataTypeContent->fourth_child)->business }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="profile_data_block">
                                                    <label class="profile_data_label">
                                                        Site Internet
                                                    </label>
                                                    <div class="profile_data_value">
                                                        <span>
                                                            @if(isset(json_decode($dataTypeContent->fourth_child)->website))
                                                                {{ json_decode($dataTypeContent->fourth_child)->website }}
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-md-6">
                                                @if(!empty(json_decode($dataTypeContent->fourth_child_emails)))
                                                    @foreach(json_decode($dataTypeContent->fourth_child_emails) as $email)
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
                                                @if(!empty($dataTypeContent->fourth_child_phones))
                                                    @foreach(json_decode($dataTypeContent->fourth_child_phones) as $phone)
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
                                                            <span>{{ (isset(json_decode($dataTypeContent->fourth_child)->preferred_means_contact) && json_decode($dataTypeContent->fourth_child)->preferred_means_contact == $contact->reference) ? $contact->value : '' }}</span>
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
        /*-- show bio on sidebar --*/
        $('#client_tab').click(function () {
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
        });
        $('#spose_tab').click(function () {
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
        });
        $('#child_tab').click(function () {
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
        });
    </script>
@stop