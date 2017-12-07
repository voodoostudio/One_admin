@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid" style="margin: 20px 20px 100px;">
        <div class="row">
            <div class="col-md-5">
                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add"
                            action="@if(isset($dataTypeContent->id)){{ route('voyager.'.$dataType->slug.'.update', $dataTypeContent->id) }}@else{{ route('voyager.'.$dataType->slug.'.store') }}@endif"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        @if(isset($dataTypeContent->id))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            {{--@if (count($errors) > 0)--}}
                                {{--<div class="alert alert-danger">--}}
                                    {{--<ul>--}}
                                        {{--@foreach ($errors->all() as $error)--}}
                                            {{--<li>{{ $error }}</li>--}}
                                        {{--@endforeach--}}
                                    {{--</ul>--}}
                                {{--</div>--}}
                            {{--@endif--}}

                            {{--<!-- Adding / Editing -->--}}
                            {{--@php--}}
                                {{--$dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};--}}
                            {{--@endphp--}}

                            {{--@foreach($dataTypeRows as $row)--}}
                                {{--<!-- GET THE DISPLAY OPTIONS -->--}}
                                {{--@php--}}
                                    {{--$options = json_decode($row->details);--}}
                                    {{--$display_options = isset($options->display) ? $options->display : NULL;--}}
                                {{--@endphp--}}
                                {{--@if ($options && isset($options->formfields_custom))--}}
                                    {{--@include('voyager::formfields.custom.' . $options->formfields_custom)--}}
                                {{--@else--}}
                                    {{--<div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@else{{ '' }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>--}}
                                        {{--{{ $row->slugify }}--}}
                                        {{--<label for="name">{{ $row->display_name }}</label>--}}
                                        {{--@include('voyager::multilingual.input-hidden-bread-edit-add')--}}
                                        {{--@if($row->type == 'relationship')--}}
                                            {{--@include('voyager::formfields.relationship')--}}
                                        {{--@else--}}
                                            {{--{!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}--}}
                                        {{--@endif--}}

                                        {{--@foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)--}}
                                            {{--{!! $after->handle($row, $dataType, $dataTypeContent) !!}--}}
                                        {{--@endforeach--}}
                                    {{--</div>--}}
                                {{--@endif--}}
                            {{--@endforeach--}}
                            <div>
                                <label for="select_civil">Select</label>
                                <select name="civility" id="select_civil">
                                    @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                        <option value="{{ $civility->reference }}">{{ $civility->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="lng_corres">Select language</label>
                                <select name="lng_corres" id="lng_corres">
                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                        <option value="{{ $user_lng->reference }}">{{ $user_lng->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="name">Enter you first name</label>
                                <input id="name" type="text" name="name" placeholder="First Name">
                            </div>
                            <div>
                                <label for="name">Enter you middle name</label>
                                <input id="name" type="text" name="middle_name" placeholder="Middle Name">
                            </div>
                            <div>
                                <label for="name">Enter you last name</label>
                                <input id="name" type="text" name="last_name" placeholder="Last Name">
                            </div>
                            <div>
                                <label for="civil_status">Select civil status</label>
                                <select name="civil_status" id="civil_status">
                                    @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                        <option value="{{ $civil_stat->reference }}">{{ $civil_stat->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="civil_status">Enter you birth date</label>
                                <input id="civil_status" type="text" placeholder="Birth date" name="birth_date">
                            </div>
                            <div>
                                <label for="birthplace">Enter you place birth</label>
                                <input id="birthplace" type="text" placeholder="Place birth" name="birthplace">
                            </div>
                            <div>
                                <label for="nationality">Enter nationality</label>
                                <select id="nationality" name="nationality">
                                    @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                        <option value="{{ $nationality->reference }}">{{ $nationality->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="profession">Enter profession</label>
                                <input id="profession" type="text" placeholder="Profession" name="profession">
                            </div>
                            <div>
                                <label for="service">Enter service</label>
                                <input id="service" type="text" placeholder="Service" name="service">
                            </div>
                            <div>
                                <label for="business">Enter business</label>
                                <input id="business" type="text" placeholder="Business" name="business">
                            </div>
                            <div>
                                <label for="website">Enter website</label>
                                <input id="website" type="text" placeholder="Website" name="website">
                            </div>
                            <div>
                                <label for="email_type">Select email type</label>
                                <select name="email_type" id="email_type">
                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                        <option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="phone_type">Select phone type</label>
                                <select name="phone_type" id="phone_type">
                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                        <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="country_code">Select country code</label>
                                <input id="country_code" type="text" placeholder="Website" name="country_code">
                            </div>
                            <div>
                                <label for="website">Enter phone</label>
                                <input id="phone" type="text" placeholder="Phone" name="phone">
                            </div>
                            <div>
                                <label for="email">Enter email</label>
                                <input id="email" type="text" placeholder="Email" name="email">
                            </div>
                            <div>
                                <label for="password">Enter password</label>
                                <input id="password" type="password" placeholder="Password" name="password">
                            </div>
                            <div>
                                <label for="preferred_means_contact">Preferred means of contact</label>
                                <select name="preferred_means_contact" id="preferred_means_contact">
                                    @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                        <option value="{{ $contact->reference }}">{{ $contact->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="role_id">ROLE ID</label>
                                <select name="role_id" id="role_id">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">3</option>
                                    <option value="5">3</option>
                                </select>
                            </div>

                            {{--<input type="file" name="" multiple="multiple"> todo photos --}}

                            <hr>
                            <h4>Husband/Wife</h4>
                            <hr>
                            <!-- Epoux/Epouse -->

                            {{--<input type="file" name="" multiple="multiple"> todo photos --}}

                            <div>
                                <label for="civility_coup">Civilité</label>
                                <select name="civility_coup" id="civility_coup">
                                    @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                        <option value="{{ $civility->reference }}">{{ $civility->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="lng_corres_coup">Langue de correspondance</label>
                                <select name="lng_corres_coup" id="lng_corres_coup">
                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                        <option value="{{ $user_lng->reference }}">{{ $user_lng->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="first_name_coup">Prénom</label>
                                <input id="first_name_coup" type="text" placeholder="first name" name="first_name_coup">
                            </div>

                            <div>
                                <label for="middle_name_coup">Second prénom</label>
                                <input id="middle_name_coup" type="text" placeholder="second name" name="middle_name_coup">
                            </div>

                            <div>
                                <label for="last_name_coup">Nom de famille</label>
                                <input id="last_name_coup" type="text" placeholder="last name" name="last_name_coup">
                            </div>

                            <div>
                                <label for="civil_status_coup">Etat civil</label>
                                <select name="civil_status_coup" id="civil_status_coup">
                                    @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                        <option value="{{ $civil_stat->reference }}">{{ $civil_stat->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="birth_date_coup">Date de naissance</label>
                                <input id="birth_date_coup" type="text" placeholder="birth date" name="birth_date_coup">
                            </div>

                            <div>
                                <label for="birthplace_coup">Lieu de naissance</label>
                                <input id="birthplace_coup" type="text" placeholder="birthplace_coup" name="birthplace_coup">
                            </div>

                            <div>
                                <label for="nationality_coup">Nationalité</label>
                                <select name="nationality_coup" id="nationality_coup">
                                    @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                        <option value="{{ $nationality->reference }}">{{ $nationality->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="profession_coup">Profession</label>
                                <input id="profession_coup" type="text" placeholder="profession" name="profession_coup">
                            </div>

                            <div>
                                <label for="service_coup">Service</label>
                                <input id="service_coup" type="text" placeholder="profession" name="service_coup">
                            </div>

                            <div>
                                <label for="business_coup">Entreprise</label>
                                <input id="business_coup" type="text" placeholder="business" name="business_coup">
                            </div>

                            <div>
                                <label for="website_coup">Site Internet</label>
                                <input id="website_coup" type="text" placeholder="website" name="website_coup">
                            </div>

                            <div>
                                <label for="email_type_coup">Courriel</label>
                                <select name="email_type_coup" id="email_type_coup">
                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                        <option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="email_coup">Courriel</label>
                                <input id="email_coup" type="text" placeholder="email" name="email_coup">
                            </div>

                            <div>
                                <label for="phone_type_coup">Téléphone</label>
                                <select name="phone_type_coup" id="phone_type_coup">
                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                        <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="country_code_coup">Téléphone (+) "country code"</label>
                                <select name="country_code_coup" id="country_code_coup">
                                    <option value="1">work</option>
                                    <option value="2">home</option>
                                </select>
                            </div>

                            <div>
                                <label for="phone_coup">Téléphone</label>
                                <input id="phone_coup" type="text" placeholder="phone" name="phone_coup">
                            </div>

                            <div>
                                <label for="preferred_means_contact_coup">Preferred means of contact</label>
                                <select name="preferred_means_contact_coup" id="preferred_means_contact_coup">
                                    @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                        <option value="{{ $contact->reference }}">{{ $contact->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Children -->

                            <hr>
                            <h4>Children</h4>
                            <hr>
                            {{--<input type="file" name="" multiple="multiple"> todo photos --}}

                            <div>
                                <label for="civility_child">Civilité</label>
                                <select name="civility_child" id="civility_child">
                                    @foreach(TCG\Voyager\Models\Civility::all() as $civility)
                                        <option value="{{ $civility->reference }}">{{ $civility->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="lng_corres_child">Langue de correspondance</label>
                                <select name="lng_corres_child" id="lng_corres_child">
                                    @foreach(TCG\Voyager\Models\UserLanguage::all() as $user_lng)
                                        <option value="{{ $user_lng->reference }}">{{ $user_lng->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="first_name_child">Prénom</label>
                                <input id="first_name_child" type="text" placeholder="first name" name="first_name_child">
                            </div>

                            <div>
                                <label for="middle_name_child">Second prénom</label>
                                <input id="middle_name_child" type="text" placeholder="second name" name="middle_name_child">
                            </div>

                            <div>
                                <label for="last_name_child">Nom de famille</label>
                                <input id="last_name_child" type="text" placeholder="last name" name="last_name_child">
                            </div>

                            <div>
                                <label for="civil_status_child">Etat civil</label>
                                <select name="civil_status_child" id="civil_status_child">
                                    @foreach(TCG\Voyager\Models\CivilStatus::all() as $civil_stat)
                                        <option value="{{ $civil_stat->reference }}">{{ $civil_stat->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="birth_date_child">Date de naissance</label>
                                <input id="birth_date_child" type="text" placeholder="birth date" name="birth_date_child">
                            </div>

                            <div>
                                <label for="birthplace_child">Lieu de naissance</label>
                                <input id="birthplace_child" type="text" placeholder="birthplace_coup" name="birthplace_child">
                            </div>

                            <div>
                                <label for="nationality_child">Nationalité</label>
                                <select name="nationality_child" id="nationality_child">
                                    @foreach(TCG\Voyager\Models\Nationality::all() as $nationality)
                                        <option value="{{ $nationality->reference }}">{{ $nationality->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="profession_child">Profession</label>
                                <input id="profession_child" type="text" placeholder="profession" name="profession_child">
                            </div>

                            <div>
                                <label for="service_child">Service</label>
                                <input id="service_child" type="text" placeholder="profession" name="service_child">
                            </div>

                            <div>
                                <label for="business_child">Entreprise</label>
                                <input id="business_child" type="text" placeholder="business" name="business_child">
                            </div>

                            <div>
                                <label for="website_child">Site Internet</label>
                                <input id="website_child" type="text" placeholder="website" name="website_child">
                            </div>

                            <div>
                                <label for="email_type_child">Courriel</label>
                                <select name="email_type_child" id="email_type_child">
                                    @foreach(TCG\Voyager\Models\EmailType::all() as $email_type)
                                        <option value="{{ $email_type->reference }}">{{ $email_type->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="email_child">Courriel</label>
                                <input id="email_child" type="text" placeholder="email" name="email_child">
                            </div>

                            <div>
                                <label for="phone_type_child">Téléphone</label>
                                <select name="phone_type_child" id="phone_type_child">
                                    @foreach(TCG\Voyager\Models\Phone::all() as $phone)
                                        <option value="{{ $phone->reference }}">{{ $phone->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="country_code_child">Téléphone (+) "country code"</label>
                                <select name="country_code_child" id="country_code_child">
                                    <option value="1">work</option>
                                    <option value="2">home</option>
                                </select>
                            </div>

                            <div>
                                <label for="phone_child">Téléphone</label>
                                <input id="phone_child" type="text" placeholder="phone" name="phone_child">
                            </div>

                            <div>
                                <label for="preferred_means_contact_child">Preferred means of contact</label>
                                <select name="preferred_means_contact_child" id="preferred_means_contact_child">
                                    @foreach(TCG\Voyager\Models\Contact::all() as $contact)
                                        <option value="{{ $contact->reference }}">{{ $contact->value }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <button type="submit" class="btn btn-primary save">{{ __('voyager.generic.save') }}</button>
                        </div>
                    </form>

                    <iframe id="form_target" name="form_target" style="display:none"></iframe>
                    <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post"
                            enctype="multipart/form-data" style="width:0;height:0;overflow:hidden">
                        <input name="image" id="upload_file" type="file"
                                 onchange="$('#my_form').submit();this.value='';">
                        <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
                        {{ csrf_field() }}
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager.generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager.generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager.generic.delete') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager.generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {}
        var $image

        $('document').ready(function () {
            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });

            @if ($isModelTranslatable)
                $('.side-body').multilingual({"editing": true});
            @endif

            $('.side-body input[data-slug-origin]').each(function(i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                $image = $(this).siblings('img');

                params = {
                    slug:   '{{ $dataTypeContent->getTable() }}',
                    image:  $image.data('image'),
                    id:     $image.data('id'),
                    field:  $image.parent().data('field-name'),
                    _token: '{{ csrf_token() }}'
                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function(){
                $.post('{{ route('voyager.media.remove') }}', params, function (response) {
                    if ( response
                        && response.data
                        && response.data.status
                        && response.data.status == 200 ) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function() { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
