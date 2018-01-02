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
                        Profile ({{ $dataTypeContent->name }} {{ $dataTypeContent->last_name }})
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
                                            Profile
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
                                            <h3>User</h3>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Name</label>
                                        <div class="col-7">
                                            <span>{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Surname</label>
                                        <div class="col-7">
                                            <span>{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Email</label>
                                        <div class="col-7">
                                            <span>{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Language</label>
                                        <div class="col-7">
                                            <span>
                                                @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_language)
                                                    <span> {{ (isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_language->reference) ? $user_language->value : ''  }}</span>
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">Role</label>
                                        <div class="col-7">
                                            <span>
                                                @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                    <span> {{ (isset($dataTypeContent->role_id) && $dataTypeContent->role_id == $role->id) ? $role->display_name : ''  }}</span>
                                                @endforeach
                                            </span>
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