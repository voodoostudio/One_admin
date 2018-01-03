@extends('voyager::master_metronic')

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
                                        <img src="{{ Voyager::image( $dataTypeContent->avatar ) }}" alt="{{ $dataTypeContent->name }} avatar"/>
                                    </div>
                                </div>
                                <div class="m-card-profile__details">
                                    <span class="m-card-profile__name">{{ $dataTypeContent->name }}</span>
                                    <a href="" class="m-card-profile__email m-link">{{ $dataTypeContent->email }}</a>
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
                                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#profile_info" role="tab"  aria-expanded="true">
                                            <i class="flaticon-share m--hide"></i>
                                            Profil
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            <input type="hidden" name="type_users" value="Users">
                            <div class="tab-pane active" id="profile_info" role="tabpanel" aria-expanded="true">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-12 ml-auto">
                                            <h3>Utilisateur</h3>
                                        </div>
                                    </div>
                                    <div class="m-form__group row">
                                        <div class="col-md-6">
                                            <div class="profile_data_block">
                                                <label class="profile_data_label">
                                                    Nom
                                                </label>
                                                <div class="profile_data_value">
                                                    <span>{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile_data_block">
                                                <label class="profile_data_label">
                                                    Prenom
                                                </label>
                                                <div class="profile_data_value">
                                                    <span>{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-form__group row">
                                        <div class="col-md-6">
                                            <div class="profile_data_block">
                                                <label class="profile_data_label">
                                                    Courriel
                                                </label>
                                                <div class="profile_data_value">
                                                    <span>{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="profile_data_block">
                                                <label class="profile_data_label">
                                                    Langue
                                                </label>
                                                <div class="profile_data_value">
                                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_language)
                                                        <span> {{ (isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_language->reference) ? $user_language->value : ''  }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-form__group row">
                                        <div class="col-md-6">
                                            <div class="profile_data_block">
                                                <label class="profile_data_label">
                                                    Rôle
                                                </label>
                                                <div class="profile_data_value">
                                                    @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                        <span> {{ (isset($dataTypeContent->role_id) && $dataTypeContent->role_id == $role->id) ? $role->display_name : ''  }}</span>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
@section('javascript')

@stop