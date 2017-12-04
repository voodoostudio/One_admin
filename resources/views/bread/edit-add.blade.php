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
                                <label for="name">Enter you first name</label>
                                <input id="name" type="text" name="name" placeholder="First Name">
                            </div>
                            <div>
                                <label for="name">Enter you middle name</label>
                                <input id="name" type="text" name="middle_name" placeholder="Middle Name">
                            </div>
                            <div>
                                <label for="name">Enter you middle name</label>
                                <input id="name" type="text" name="last_name" placeholder="Last Name">
                            </div>
                            <div>
                                <label for="select_civil">Select</label>
                                <select name="civility" id="select_civil">
                                    <option value="1">Monsieur</option>
                                    <option value="2">Madame</option>
                                    <option value="3">Mademoiselle</option>
                                </select>
                            </div>
                            <div>
                                <label for="lng_corres">Select language</label>
                                <select name="lng_corres" id="lng_corres">
                                    <option value="1">Monsieur</option>
                                    <option value="1">Madame</option>
                                    <option value="1">Mademoiselle</option>
                                </select>
                            </div>
                            <div>
                                <label for="civil_status">Select civil status</label>
                                <select name="civil_status" id="civil_status">
                                    <option value="1">Monsieur</option>
                                    <option value="1">Madame</option>
                                    <option value="1">Mademoiselle</option>
                                </select>
                            </div>
                            <div>
                                <label for="civil_status">Enter you birth date</label>
                                <input id="civil_status" type="text" placeholder="Birth date" name="birth_date">
                            </div>
                            <div>
                                <label for="place_birth">Enter you place birth</label>
                                <input id="place_birth" type="text" placeholder="Place birth" name="place_birth">
                            </div>
                            <div>
                                <label for="nationality">Enter nationality</label>
                                <input id="nationality" type="text" placeholder="Nationality" name="nationality">
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
                                    <option value="1">Home</option>
                                    <option value="1">Work</option>
                                    <option value="1">Mademoiselle</option>
                                </select>
                            </div>
                            <div>
                                <label for="phone_type">Select phone type</label>
                                <select name="phone_type" id="phone_type">
                                    <option value="1">Home</option>
                                    <option value="1">Work</option>
                                    <option value="1">Mademoiselle</option>
                                </select>
                            </div>
                            <div>
                                <label for="country_code">Select country code</label>
                                <select name="country_code" id="country_code">
                                    <option value="1">+373</option>
                                    <option value="1">+7</option>
                                    <option value="1">Mademoiselle</option>
                                </select>
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
                                    <option value="1">Email</option>
                                    <option value="1">Phone</option>
                                    <option value="1">Mademoiselle</option>
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

                            <input type="file" name="" multiple="multiple">

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
