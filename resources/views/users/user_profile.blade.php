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
                            {{--<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
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
                            </ul>--}}
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