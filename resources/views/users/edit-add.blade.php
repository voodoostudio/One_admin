@extends('voyager::master_metronic')

{{--{{ dd(TCG\Voyager\Models\Role::all()[1]->toArray()) }}--}}
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
    @if(isset($dataTypeContent->id))
        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title ">
                            Edit profile <b>({{ (isset($dataTypeContent->name)) ? $dataTypeContent->name : '' }} {{ (isset($dataTypeContent->last_name)) ? $dataTypeContent->last_name : '' }})</b>
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
                                  action="{{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}"
                                  method="POST" enctype="multipart/form-data" id="profile_edit_form">
                                <!-- PUT Method if we are editing -->
                            @if(isset($dataTypeContent->id))
                                {{ method_field("PUT") }}
                            @endif
                            <!-- CSRF TOKEN -->
                                {{ csrf_field() }}

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
                                                <div class="form-group col-lg-4 margin_bottom_10">
                                                    <label class="">First name</label>
                                                    <input class="form-control m-input"  type="text" name="name" placeholder="First name" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                </div>
                                                <div class="form-group col-lg-4 margin_bottom_10">
                                                    <label class="">Last name</label>
                                                    <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Last name" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                </div>
                                                <div class="form-group col-lg-4 margin_bottom_10">
                                                    <label class="">Email</label>
                                                    <input class="form-control m-input" id="email" type="text" placeholder="Email" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}" aria-invalid="false">
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="" for="role_id">Role</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Civilité">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            @if($role->id >= Auth::user()->id && $role->id != 5)
                                                                <option value="{{ $role->id }}">{{ $role->display_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 margin_bottom_10">
                                                    <label class="" for="lng_corres">Select language</label>
                                                    <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                            <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
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
                                                @if(isset($dataTypeContent->id))
                                                    <div class="form-group col-lg-6 margin_bottom_10">
                                                        <label class="">New password</label>
                                                        <input class="form-control m-input" id="password" type="password" placeholder="Change password" name="password">
                                                    </div>
                                                    <div class="form-group col-lg-6 margin_bottom_10">
                                                        <label class="">Confirm password</label>
                                                        <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirm password" name="password_confirm">
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
    @else
        <div class="m-grid__item m-grid__item--fluid m-wrapper" style="">
            <!-- BEGIN: Subheader -->
            <div class="m-subheader ">
                <div class="d-flex align-items-center">
                    <div class="mr-auto">
                        <h3 class="m-subheader__title m-subheader__title--separator">
                            Add User
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
                                    Users
                                </span>
                                </a>
                            </li>
                            <li class="m-nav__separator">
                                -
                            </li>
                            <li class="m-nav__item">
                                <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Create user
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
                <form id="edit_create_clients" action="{{ route('voyager.'.$dataType->slug.'.store') }}" class="form-edit-add m-form m-form--group-seperator-dashed" role="form" enctype="multipart/form-data" method="POST"> {{-- todo action --}}
                    {{ csrf_field() }}
                    <input type="hidden" name="type_users" value="Users">
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
                                                    Create User
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="form-group col-lg-4 col-md-6 margin_bottom_10">
                                                <label>Name</label>
                                                <input type="text" class="form-control m-input" placeholder="Name" value="" name="name">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 margin_bottom_10">
                                                <label>Second Name</label>
                                                <input type="text" class="form-control m-input" placeholder="Second Name" value="" name="last_name">
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 margin_bottom_10">
                                                <label>Email</label>
                                                <input type="text" class="form-control m-input" placeholder="Email" value="" name="email">
                                            </div>
                                            <div class="col-lg-4 col-md-6 margin_bottom_10">
                                                <label for="lng_corres">Select language</label>
                                                <select class="form-control m-select2 custom_select2 elem-categories" id="lng_corres" name="lng_corres" data-placeholder="Select Floor">
                                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $lng)
                                                        <option value="{{ $lng->reference }}">{{ $lng->value }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-4 col-md-6 margin_bottom_10">
                                                <label for="lng_corres">Role</label>
                                                <select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Select Floor">
                                                    {{--@if(Auth::user()->role_id != 1)--}}
                                                        {{--@foreach(TCG\Voyager\Models\Role::all() as $role)--}}
                                                            {{--@if($role->id != 5 && $role->id != 1)--}}
                                                                {{--<option value="{{ $role->id }}">{{ $role->display_name }}</option>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--@else--}}
                                                        {{--@foreach(TCG\Voyager\Models\Role::all() as $role)--}}
                                                            {{--@if($role->id != 5)--}}
                                                                {{--<option value="{{ $role->id }}">{{ $role->display_name }}</option>--}}
                                                            {{--@endif--}}
                                                        {{--@endforeach--}}
                                                    {{--@endif--}}

                                                    @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                        @if($role->id >= Auth::user()->id)
                                                            <option value="{{ $role->id }}" {{ ($dataTypeContent->role_id == $role->id) ? 'selected="selected"' : '' }}>{{ $role->display_name }}</option>
                                                        @endif
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6 margin_bottom_10">
                                                <label class="">Password</label>
                                                <input class="form-control m-input" id="password" type="password" placeholder="Password" name="password">
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
        showSelectedFileName();
        function showSelectedFileName() {
            $( '.input_file' ).each( function()
            {
                var $input	 = $( this ),
                    $label	 = $input.next( 'label' ),
                    labelVal = $label.html();

                $input.on( 'change', function( e )
                {
                    var fileName = '';

                    if( this.files && this.files.length > 1 )
                        fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                    else if( e.target.value )
                        fileName = e.target.value.split( '\\' ).pop();

                    if( fileName )
                        $label.find( 'span' ).html( fileName );
                    else
                        $label.html( labelVal );
                });
                $input.on( 'focus', function(){ $input.addClass( 'has-focus' ); });
                $input.on( 'blur', function(){ $input.removeClass( 'has-focus' ); });
            });
        }
        // ==========================================================================
        // Registration Form : jquery validation

        /*$('#profile_edit_form').validate({
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
         });*///end validate
    </script>

    <script>
        jQuery.validator.addMethod( 'passwordMatch', function(value, element) {

            var password = $("#password").val();
            var confirmPassword = $("#password_confirm").val();

            if(password != confirmPassword ) {
                return false;
            } else {
                return true;
            }

        }, "Your Passwords Must Match");

        jQuery(document).ready(function () {
            jQuery("#profile_edit_form").validate({
                rules: {
                    name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    password: {
                        minlength: 3
                    },
                    password_confirm: {
                        minlength: 3,
                        passwordMatch: true
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });

            jQuery("#edit_create_clients").validate({
                rules: {
                    name: {
                        required: true
                    },
                    last_name: {
                        required: true
                    },
                    email: {
                        email: true,
                        required: true
                    },
                    password: {
                        required: true,
                        minlength: 3
                    }
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@stop