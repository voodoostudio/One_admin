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
                            Editer le profil <b>({{ (isset($dataTypeContent->name)) ? $dataTypeContent->name : '' }} {{ (isset($dataTypeContent->last_name)) ? $dataTypeContent->last_name : '' }})</b>
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
                                        Votre profil
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
                                                Mettre à jour le profil
                                            </a>
                                        </li>
                                        <li class="nav-item m-tabs__item">
                                            <a class="nav-link m-tabs__link" data-toggle="tab" href="#profile_settings" role="tab">
                                                Paramètres
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
                                                <div class="form-group col-lg-4">
                                                    <label class="">Nom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input"  type="text" name="name" placeholder="Nom" value="{{ ($dataTypeContent->name) ? $dataTypeContent->name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label class="">Prenom</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="last_name" type="text" name="last_name" placeholder="Prenom" value="{{ ($dataTypeContent->last_name) ? $dataTypeContent->last_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label class="">Courriel</label>
                                                    <div class="input-group">
                                                        <input class="form-control m-input" id="email" type="text" placeholder="Courriel" name="email" value="{{ ($dataTypeContent->email) ? $dataTypeContent->email : '' }}" aria-invalid="false">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="" for="role_id">Rôle</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Rôle">
                                                            @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                                @if($role->id >= Auth::user()->id && $role->id != 5)
                                                                    <option value="{{ $role->id }}" {{ (isset($dataTypeContent->role_id) && $dataTypeContent->role_id == $role->id) ? 'selected="selected"' : ''}} >{{ $role->display_name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label class="" for="lng_corres">Sélectionner la langue</label>
                                                    <div class="input-group">
                                                        <select class="form-control m-select2 custom_select2 elem-categories" name="lng_corres" id="lng_corres"  data-placeholder="Select language">
                                                            @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                                                <option value="{{ $user_lng->reference }}" @if(isset($dataTypeContent->lng_corres) && $dataTypeContent->lng_corres == $user_lng->reference){{ 'selected="selected"' }} @endif>{{ $user_lng->value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group m-form__group row">
                                                <div class="col-lg-4">
                                                    <label class="">Image</label>
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
                                                    <div class="form-group col-lg-6">
                                                        <label class="">Nouveau mot de passe</label>
                                                        <div class="input-group">
                                                            <input class="form-control m-input" id="password" type="password" placeholder="Changer le mot de passe" name="password">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-lg-6">
                                                        <label class="">Confirmer le mot de passe</label>
                                                        <div class="input-group">
                                                            <input class="form-control m-input" id="password_confirm" type="password" placeholder="Confirmer le mot de passe" name="password_confirm">
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="col-lg-6">
                                                        <label class="">Entrer le mot de passe</label>
                                                        <div class="input-group">
                                                            <input class="form-control m-input" id="password" type="password" placeholder="Entrer le mot de passe" name="password">
                                                        </div>
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
                                                {{--<button type="reset" class="btn btn-danger m-btn m-btn--air m-btn--custom">--}}
                                                {{--Cancel--}}
                                                {{--</button>--}}
                                                <a class="btn btn-danger m-btn m-btn--air m-btn--custom" href="{{ URL::to('admin/users') }}">Annuler</a>
                                                &nbsp;&nbsp;
                                                <button type="submit" class="btn btn-success m-btn m-btn--air m-btn--custom">
                                                    Sauver les modifications
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
                                                    Créer un utilisateur
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-portlet__body">
                                        <div class="m-form__group row">
                                            <div class="form-group col-lg-4 col-md-6">
                                                <label>Nom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control m-input" placeholder="Nom" value="" name="name">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6">
                                                <label>Prenom</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control m-input" placeholder="Prenom" value="" name="last_name">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6">
                                                <label>Courriel</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control m-input" placeholder="Courriel" value="" name="email">
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <label for="lng_corres">Sélectionner la langue</label>
                                                <div class="input-group">
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="lng_corres" name="lng_corres" data-placeholder="Select Floor">
                                                        @foreach(TCG\Voyager\Models\UserLanguage::all() as $lng)
                                                            <option value="{{ $lng->reference }}">{{ $lng->value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6">
                                                <label for="lng_corres">Rôle</label>
                                                <div class="input-group">
                                                    <select class="form-control m-select2 custom_select2 elem-categories" id="role_id" name="role_id" data-placeholder="Select Floor">
                                                        @foreach(TCG\Voyager\Models\Role::all() as $role)
                                                            @if($role->id >= Auth::user()->id && $role->id != 5)
                                                                <option value="{{ $role->id }}" {{ ($dataTypeContent->role_id == $role->id) ? 'selected="selected"' : '' }}>{{ $role->display_name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-4 col-md-6">
                                                <label class="">Mot de passe</label>
                                                <div class="input-group">
                                                    <input class="form-control m-input" id="password" type="password" placeholder="Password" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-4">
                                                <label class="">Image</label>
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

            jQuery.validator.addMethod("noSpace", function(value, element) {
                return $.trim(value) != "";
            }, "No space please and don't leave it empty");

            jQuery("#profile_edit_form").validate({
                rules: {
                    name: {
                        required: true,
                        noSpace: true
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
                        required: true,
                        noSpace: true
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

            /*
             * Translated default messages for the jQuery validation plugin.
             * Locale: FR (French; français)
             */
            $.extend( $.validator.messages, {
                required: "Ce champ est obligatoire.",
                remote: "Veuillez corriger ce champ.",
                email: "Veuillez fournir une adresse électronique valide.",
                url: "Veuillez fournir une adresse URL valide.",
                date: "Veuillez fournir une date valide.",
                dateISO: "Veuillez fournir une date valide (ISO).",
                number: "Veuillez fournir un numéro valide.",
                digits: "Veuillez fournir seulement des chiffres.",
                creditcard: "Veuillez fournir un numéro de carte de crédit valide.",
                equalTo: "Veuillez fournir encore la même valeur.",
                notEqualTo: "Veuillez fournir une valeur différente, les valeurs ne doivent pas être identiques.",
                extension: "Veuillez fournir une valeur avec une extension valide.",
                maxlength: $.validator.format( "Veuillez fournir au plus {0} caractères." ),
                minlength: $.validator.format( "Veuillez fournir au moins {0} caractères." ),
                rangelength: $.validator.format( "Veuillez fournir une valeur qui contient entre {0} et {1} caractères." ),
                range: $.validator.format( "Veuillez fournir une valeur entre {0} et {1}." ),
                max: $.validator.format( "Veuillez fournir une valeur inférieure ou égale à {0}." ),
                min: $.validator.format( "Veuillez fournir une valeur supérieure ou égale à {0}." ),
                step: $.validator.format( "Veuillez fournir une valeur multiple de {0}." ),
                maxWords: $.validator.format( "Veuillez fournir au plus {0} mots." ),
                minWords: $.validator.format( "Veuillez fournir au moins {0} mots." ),
                rangeWords: $.validator.format( "Veuillez fournir entre {0} et {1} mots." ),
                letterswithbasicpunc: "Veuillez fournir seulement des lettres et des signes de ponctuation.",
                alphanumeric: "Veuillez fournir seulement des lettres, nombres, espaces et soulignages.",
                lettersonly: "Veuillez fournir seulement des lettres.",
                nowhitespace: "Veuillez ne pas inscrire d'espaces blancs.",
                ziprange: "Veuillez fournir un code postal entre 902xx-xxxx et 905-xx-xxxx.",
                integer: "Veuillez fournir un nombre non décimal qui est positif ou négatif.",
                vinUS: "Veuillez fournir un numéro d'identification du véhicule (VIN).",
                dateITA: "Veuillez fournir une date valide.",
                time: "Veuillez fournir une heure valide entre 00:00 et 23:59.",
                phoneUS: "Veuillez fournir un numéro de téléphone valide.",
                phoneUK: "Veuillez fournir un numéro de téléphone valide.",
                mobileUK: "Veuillez fournir un numéro de téléphone mobile valide.",
                strippedminlength: $.validator.format( "Veuillez fournir au moins {0} caractères." ),
                email2: "Veuillez fournir une adresse électronique valide.",
                url2: "Veuillez fournir une adresse URL valide.",
                creditcardtypes: "Veuillez fournir un numéro de carte de crédit valide.",
                ipv4: "Veuillez fournir une adresse IP v4 valide.",
                ipv6: "Veuillez fournir une adresse IP v6 valide.",
                require_from_group: $.validator.format( "Veuillez fournir au moins {0} de ces champs." ),
                nifES: "Veuillez fournir un numéro NIF valide.",
                nieES: "Veuillez fournir un numéro NIE valide.",
                cifES: "Veuillez fournir un numéro CIF valide.",
                postalCodeCA: "Veuillez fournir un code postal valide."
            } );
        });
    </script>
@stop