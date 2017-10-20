{{--@extends('voyager::master_metronic')--}}

@extends('voyager::master')

@section('page_title', __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular)

@section('css')
    {{--<link href="{{ asset('assets/plugins/css/select2.min.css') }}" rel="stylesheet" type="text/css" />--}}
    <style>
        .panel .mce-panel {
            border-left-color: #fff;
            border-right-color: #fff;
        }

        .panel .mce-toolbar,
        .panel .mce-statusbar {
            padding-left: 20px;
        }

        .panel .mce-edit-area,
        .panel .mce-edit-area iframe,
        .panel .mce-edit-area iframe html {
            padding: 0 10px;
            min-height: 350px;
        }

        .mce-content-body {
            color: #555;
            font-size: 14px;
        }

        .panel.is-fullscreen .mce-statusbar {
            position: absolute;
            bottom: 0;
            width: 100%;
            z-index: 200000;
        }

        .panel.is-fullscreen .mce-tinymce {
            height:100%;
        }

        .panel.is-fullscreen .mce-edit-area,
        .panel.is-fullscreen .mce-edit-area iframe,
        .panel.is-fullscreen .mce-edit-area iframe html {
            height: 100%;
            position: absolute;
            width: 99%;
            overflow-y: scroll;
            overflow-x: hidden;
            min-height: 100%;
        }
    </style>
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i>
        {{ __('voyager.generic.'.(isset($dataTypeContent->id) ? 'edit' : 'add')).' '.$dataType->display_name_singular }}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content container-fluid" style="margin-bottom: 100px; padding-top: 50px;">
        <form class="form-edit-add" role="form" action="@if(isset($dataTypeContent->id)){{ route('voyager.posts.update', $dataTypeContent->id) }}@else{{ route('voyager.posts.store') }}@endif" method="POST" enctype="multipart/form-data">
            <!-- PUT Method if we are editing -->
            @if(isset($dataTypeContent->id))
                {{ method_field("PUT") }}
            @endif
            {{ csrf_field() }}

            <div class="row">
                <div class="col-md-8">
                    <!-- ### TITLE ### -->
                    <div class="panel">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="voyager-character"></i> {{ __('voyager.post.title') }}
                                <span class="panel-desc"> {{ __('voyager.post.title_sub') }}</span>
                            </h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @include('voyager::multilingual.input-hidden', [
                                '_field_name'  => 'title',
                                '_field_trans' => get_field_translations($dataTypeContent, 'title')
                            ])
                            <input required type="text" class="form-control" id="title" name="title" placeholder="{{ __('voyager.generic.title') }}" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif">
                        </div>
                    </div>

                    <!-- ### CONTENT ### -->
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-book"></i> {{ __('voyager.post.content') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-resize-full" data-toggle="panel-fullscreen" aria-hidden="true"></a>
                            </div>
                        </div>
                        @include('voyager::multilingual.input-hidden', [
                            '_field_name'  => 'body',
                            '_field_trans' => get_field_translations($dataTypeContent, 'body', 'rich_text_box', true)
                        ])
                        <textarea class="form-control richTextBox" id="richtextbody" name="body" style="border:0px;">@if(isset($dataTypeContent->body)){{ $dataTypeContent->body }}@endif</textarea>
                    </div><!-- .panel -->

                    <!-- ### EXCERPT ### -->
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">{!! __('voyager.post.excerpt') !!}</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--@include('voyager::multilingual.input-hidden', [--}}
                                {{--'_field_name'  => 'excerpt',--}}
                                {{--'_field_trans' => get_field_translations($dataTypeContent, 'excerpt')--}}
                            {{--])--}}
                            {{--<textarea class="form-control" name="excerpt">@if (isset($dataTypeContent->excerpt)){{ $dataTypeContent->excerpt }}@endif</textarea>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">General</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @php
                                $dataTypeRows = $dataType->{(isset($dataTypeContent->id) ? 'editRows' : 'addRows' )};
                                $exclude = ['title', 'body', 'excerpt', 'slug', 'status', 'category_id', 'author_id', 'external_state', 'state_front',  'type_construction', 'interior_condition',  'style', 'sonority',  'divers_format', 'usees_distribution',  'eau_chaude_energy', 'distribution',  'type_radiator', 'type_heating', 'chauffage_energy', 'format', 'type', 'type_land', 'country', 'location', 'lng_of_add', 'regime', 'floor_property', 'status_id', 'mandate_id', 'origin_id', 'сurrency', 'featured', 'image', 'meta_description', 'meta_keywords', 'seo_title'];
                            @endphp

                            @foreach($dataTypeRows as $row)
                                @if(!in_array($row->field, $exclude))
                                    @php
                                        $options = json_decode($row->details);
                                        $display_options = isset($options->display) ? $options->display : NULL;
                                    @endphp
                                    @if ($options && isset($options->formfields_custom))
                                        @include('voyager::formfields.custom.' . $options->formfields_custom)
                                    @else
                                        <div class="form-group @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@else{{ '' }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
                                            {{ $row->slugify }}
                                            <label for="name">{{ $row->display_name }}</label>
                                            @include('voyager::multilingual.input-hidden-bread-edit-add')
                                            @if($row->type == 'relationship')
                                                {{--@include('voyager::formfields.relationship')--}}
                                            @else
                                                {!! app('voyager')->formField($row, $dataType, $dataTypeContent) !!}
                                            @endif

                                            @foreach (app('voyager')->afterFormFields($row, $dataType, $dataTypeContent) as $after)
                                                {!! $after->handle($row, $dataType, $dataTypeContent) !!}
                                            @endforeach
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>

                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">General</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="category">Category</label>--}}
                                {{--<input  class="form-control" type="text" name="category" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="sub_category">Sub Category</label>--}}
                                {{--<input  class="form-control" type="text" name="sub_category" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="notation">Notation</label>--}}
                                {{--<input  class="form-control" type="text" name="notation" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="broker">Broker</label>--}}
                                {{--<input  class="form-control" type="text" name="broker" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="promorion">Promotion</label>--}}
                                {{--<input  class="form-control" type="radio" name="promorion" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="direct">Direct transaction</label>--}}
                                {{--<input  class="form-control" type="radio" name="direct" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Address</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="address">Address</label>--}}
                                {{--<input  class="form-control" type="text" name="address" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="pos_address">Position the address</label>--}}
                                {{--<input  class="form-control" type="button" name="pos_address" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="str">Street</label>--}}
                                {{--<input  class="form-control" type="text" name="str" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb">Number</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="po-box">PO box</label>--}}
                                {{--<input  class="form-control" type="text" name="po-box" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="zip">ZIP code</label>--}}
                                {{--<input  class="form-control" type="text" name="zip" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="town">Town</label>--}}
                                {{--<input  class="form-control" type="text" name="town" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="country">Country</label>--}}
                                {{--<select class="form-control" name="country" id="country">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="locat">Location</label>--}}
                                {{--<select class="form-control" name="locat" id="locat">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lng">Longitude</label>--}}
                                {{--<input  class="form-control" type="text" name="lng" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lat">Latitude</label>--}}
                                {{--<input  class="form-control" type="text" name="lat" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Redaction</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="language_add">Language of the add</label>--}}
                                {{--<select class="form-control" name="language_add" id="language_add">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="add_title">Ad Title</label>--}}
                                {{--<input  class="form-control" type="text" name="add_title" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="desc">Description add</label>--}}
                                {{--<textarea name="desc" class="form-control"></textarea>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Prix</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="currency">Currency</label>--}}
                                {{--<select class="form-control" name="currency" id="currency">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="show_price">Show price</label>--}}
                                {{--<input class="form-control" type="radio" name="show_price" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="price">Price</label>--}}
                                {{--<input  class="form-control" type="text" name="price" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="price-m">Price per m2</label>--}}
                                {{--<input  class="form-control" type="text" name="price-m" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="gross_y">Gross yield</label>--}}
                                {{--<input  class="form-control" type="text" name="gross_y" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="net_r">Net return</label>--}}
                                {{--<input  class="form-control" type="text" name="net_r" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="owner_a">Owner amount</label>--}}
                                {{--<input  class="form-control" type="text" name="owner_a" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="client_f">Client fees</label>--}}
                                {{--<input  class="form-control" type="text" name="client_f" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="owner_f">Owner fees</label>--}}
                                {{--<input  class="form-control" type="text" name="owner_f" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="negotiable_a">Negotiable amount</label>--}}
                                {{--<input  class="form-control" type="text" name="negotiable_a" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="estimate_price">Estimate price</label>--}}
                                {{--<input  class="form-control" type="text" name="estimate_price" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="record_r">Recording rights</label>--}}
                                {{--<input  class="form-control" type="text" name="record_r" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="regime">Regime</label>--}}
                                {{--<select class="form-control" name="regime" id="regime">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="heating_l">Heating loads</label>--}}
                                {{--<input  class="form-control" type="text" name="heating_l" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ppe_ch">PPE charges</label>--}}
                                {{--<input  class="form-control" type="text" name="ppe_ch" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="condominium_f">Condominium fees</label>--}}
                                {{--<input  class="form-control" type="text" name="condominium_f" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="property_t">Property tax</label>--}}
                                {{--<input  class="form-control" type="text" name="property_t" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="procedur_in_p">Procedure in progress with the copro.</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="procedur_in_p" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="renovation_f">Renovation Fund</label>--}}
                                {{--<input  class="form-control" type="text" name="renovation_f" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="anual_ch">Annual charges</label>--}}
                                {{--<input  class="form-control" type="text" name="anual_ch" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="hosing_tax">Housing tax</label>--}}
                                {{--<input  class="form-control" type="text" name="hosing_tax" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="rsd">Rental security deposit</label>--}}
                                {{--<input  class="form-control" type="text" name="rsd" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="commercial_p">Commercial property</label>--}}
                                {{--<input  class="form-control" type="text" name="commercial_p" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="earnings">Earnings</label>--}}
                                {{--<input  class="form-control" type="text" name="earnings" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="taxes">Taxes</label>--}}
                                {{--<input  class="form-control" type="text" name="taxes" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Agencement</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_r">Number of rooms</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_r" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_p">Number of pieces</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_p" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_b">Number of balconies</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_b" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_sh_r">Number of shower rooms</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_sh_r" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_toilets">number of toilets</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_toilets" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_terraces">Number of terraces</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_terraces" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="nmb_of_flooring_build">Number of floors in building</label>--}}
                                {{--<input  class="form-control" type="text" name="nmb_of_flooring_build" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="floor_prop">Floor of the property</label>--}}
                                {{--<select class="form-control" name="floor_prop" id="floor_prop">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="levels">Levels</label>--}}
                                {{--<input  class="form-control" type="text" name="levels" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Surface</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="surface_cellar">Surface of the cellar</label>--}}
                                {{--<input  class="form-control" type="text" name="surface_cellar" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ceiling_height">Ceiling Height</label>--}}
                                {{--<input  class="form-control" type="text" name="ceiling_height" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="roof_cover">Roof cover area</label>--}}
                                {{--<input  class="form-control" type="text" name="roof_cover" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="surface_area">Surface area of the terrace / solarium</label>--}}
                                {{--<input  class="form-control" type="text" name="surface_area" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="area_veranda">Area of the veranda</label>--}}
                                {{--<input  class="form-control" type="text" name="area_veranda" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="attic_space">Attic space</label>--}}
                                {{--<input  class="form-control" type="text" name="attic_space" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="surface_balc">Surface of the balcony</label>--}}
                                {{--<input  class="form-control" type="text" name="surface_balc" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="basement">Basement Area</label>--}}
                                {{--<input  class="form-control" type="text" name="basement" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="surface_ground">Surface of the ground</label>--}}
                                {{--<input  class="form-control" type="text" name="surface_ground" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ground">Ground</label>--}}
                                {{--<input  class="form-control" type="text" name="" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="serviced">Serviced</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="serviced" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="type_of_land">Type of land</label>--}}
                                {{--<select class="form-control" name="type_of_land" id="type_of_land">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="useful_surface">Useful surface</label>--}}
                                {{--<input  class="form-control" type="text" name="useful_surface" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ppe_area">PPE area</label>--}}
                                {{--<input  class="form-control" type="text" name="ppe_area" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="volume">Volume</label>--}}
                                {{--<input  class="form-control" type="text" name="volume" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="surface_english">Surface of the English court</label>--}}
                                {{--<input  class="form-control" type="text" name="surface_english" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="lower_ground">Lower ground floor</label>--}}
                                {{--<input  class="form-control" type="text" name="lower_ground" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="row_area">Row area</label>--}}
                                {{--<input  class="form-control" type="text" name="row_area" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="garage_area">Garage area</label>--}}
                                {{--<input  class="form-control" type="text" name="garage_area" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="weighted_surface">Weighted Surface</label>--}}
                                {{--<input  class="form-control" type="text" name="weighted_surface" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Stationnement</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="box_interior_garage">Box / interior garage</label>--}}
                                {{--<input  class="form-control" type="text" name="box_interior_garage" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="box_garage_interior">Box / garage interior double</label>--}}
                                {{--<input  class="form-control" type="text" name="box_garage_interior" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="outdoor_garage_garage">Outdoor garage / garage</label>--}}
                                {{--<input  class="form-control" type="text" name="outdoor_garage_garage" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="box_garage_outside">Box / garage outside double</label>--}}
                                {{--<input  class="form-control" type="text" name="box_garage_outside" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="covered_outdoor_parking">Covered outdoor parking space</label>--}}
                                {{--<input  class="form-control" type="text" name="covered_outdoor_parking" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="outside_parking_space">Outside parking space uncovered</label>--}}
                                {{--<input  class="form-control" type="text" name="outside_parking_space" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="number_of_parking">Number of parking spaces</label>--}}
                                {{--<input  class="form-control" type="text" name="number_of_parking" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="boat_shed">Boat shed</label>--}}
                                {{--<input  class="form-control" type="text" name="boat_shed" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="mooring">Mooring</label>--}}
                                {{--<input  class="form-control" type="text" name="mooring" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Cuisine</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="type">Type</label>--}}
                                {{--<select class="form-control" name="type" id="type">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="freezer">Freezer</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="freezer" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cooker">Cooker</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="cooker" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="oven">Oven</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="oven" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="microwave_oven">Microwave oven</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="microwave_oven" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="extractor_hood">Extractor hood</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="extractor_hood" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="washing_machine">Washing machine</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="dishwasher">Dishwasher</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="dishwasher" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="plates">Plates</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="plates" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="induction_plates">Induction Plates</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="induction_plates" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="hotplates">Hotplates</label>--}}
                                {{--<select class="form-control" name="hotplates" id="hotplates">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ceramic_plates">Ceramic plates</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="ceramic_plates" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="fridge">Fridge</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="fridge" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="tumble_drier">Tumble drier</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="tumble_drier" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="coffee_maker">Coffee maker</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="coffee_maker" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Chauffage</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="format">Format</label>--}}
                                {{--<select class="form-control" name="format" id="format">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="energy">Energy</label>--}}
                                {{--<select class="form-control" name="energy" id="energy">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="type_of_heating">Type of heating</label>--}}
                                {{--<select class="form-control" name="type_of_heating" id="type_of_heating">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="type_of_radiator">Type of radiator</label>--}}
                                {{--<select class="form-control" name="type_of_radiator" id="type_of_radiator">--}}
                                {{--</select>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Eau chaude</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="distribution">Distribution</label>--}}
                                {{--<select class="form-control" name="distribution" id="distribution">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="energy_eau">Energy</label>--}}
                                {{--<select class="form-control" name="energy_eau" id="energy_eau">--}}
                                {{--</select>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Eau usées</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="distribution_eau">Distribution</label>--}}
                                {{--<select class="form-control" name="distribution_eau" id="distribution_eau">--}}
                                {{--</select>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Divers--}}
                            {{--</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="d_format">Format</label>--}}
                                {{--<select class="form-control" name="d_format" id="d_format">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="d_sonority">Sonority</label>--}}
                                {{--<select class="form-control" name="d_sonority" id="d_sonority">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="d_style">Style</label>--}}
                                {{--<select class="form-control" name="d_style" id="d_style">--}}
                                {{--</select>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Conveniences</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="shelter">Shelter</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="shelter" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="access_for_disabled">Access for disabled</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="access_for_disabled" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="water_softener">Water softener</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="water_softener" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="air_conditioning">Air conditioning</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="air_conditioning" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="pets_welcome">Pets welcome</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="pets_welcome" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="fitted_wardrobe">Fitted Wardrobes</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="fitted_wardrobe" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="private_lift">Private lift</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="private_lift" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="central_aspiration">Central aspiration</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="central_aspiration" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="workshop">Workshop</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="workshop" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="patch_panel">Patch panel</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="patch_panel" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="windows">Windows</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="windows" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="bath">Bath</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="bath" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="balneo_bath">Balneo bath</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="balneo_bath" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="private_laundry_room">Private laundry room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="private_laundry_room" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cafeteria">Cafeteria</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="cafeteria" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="carnotzet">Carnotzet</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="carnotzet" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cave">Cave</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="cave" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="wine_cellar">Wine cellar</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="wine_cellar" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="cellar">Cellar</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="cellar" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="fireplace">Fireplace</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="fireplace" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="air_conditioner">Air conditioner</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="air_conditioner" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="removable_partitions">Removable partitions</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="removable_partitions" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="addiction">Addiction</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="addiction" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="automation">Automation</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="automation" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="double_glazing">Double glazing</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="double_glazing" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="shower">Shower</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="shower" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="dressing">Dressing</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="dressing" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="automatic_fire">Automatic fire extinguisher</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="automatic_fire" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="false_ceiling">False ceiling</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="false_ceiling" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="optical_fiber">Optical fiber</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="optical_fiber" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="attic">Attic</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="attic" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="generator">Generator</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="generator" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="hammam">Hammam</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="hammam" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="high_speed_internet">High-speed Internet</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="high_speed_internet" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="jacuzzi">Jacuzzi</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="jacuzzi" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="winter_garden">Winter Garden</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="winter_garden" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ski_locker">Ski locker</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="ski_locker" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="bicycle_storage">Bicycle storage</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="bicycle_storage" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="loggia">Loggia</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="loggia" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="net">Net</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="net" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="hoist">Hoist</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="hoist" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="open_plan">Open plan</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="open_plan" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="outdoor_pool">Outdoor pool</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="outdoor_pool" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="indoor_pool">Indoor pool</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="indoor_pool" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="ceramic_stove">Ceramic stove</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="ceramic_stove" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="swedish_stove">Swedish stove</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="swedish_stove" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="loading_dock">Loading dock</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="loading_dock" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="connection_for_chimney">Connection for chimney</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="connection_for_chimney" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="connection_for_swedish">Connection for Swedish stove</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="connection_for_swedish" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="reception">Reception</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="reception" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="metallic_curtain">Metallic curtain</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="metallic_curtain" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="armed_with_fire">Armed with fire tap</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="armed_with_fire" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="do_it_yourself_room">Do-it-yourself room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="do_it_yourself_room" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="theater">Theater</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="theater" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="game_room">Game room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="game_room" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="fitness_room">Fitness room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="fitness_room" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="conference_room">Conference room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="conference_room" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="satellite">Satellite</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="satellite" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="sauna">Sauna</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="sauna" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="subsoil">Subsoil</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="subsoil" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="blinds">Blinds</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="blinds" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="electric_blinds">Electric blinds</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="electric_blinds" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="thermostat_connected">Thermostat connected</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="thermostat_connected" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="triple_glazing">Triple glazing</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="triple_glazing" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="veranda">Veranda</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="veranda" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="crawlspace">Crawlspace</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="crawlspace" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="electric_shutter">Electric shutters</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="electric_shutter" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="tumble_drier">Tumble drier</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="tumble_drier" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="hair_dryer">Hair dryer</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="hair_dryer" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="satellite_tv">Satellite TV</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="satellite_tv" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="phone">Phone</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="phone" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Equipement extérieur--}}
                            {{--</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="car_shelter">Car shelter</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="car_shelter" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="spray">Spray</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="spray" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="barbecue">Barbecue</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="barbecue" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exterior_lighting">Exterior lighting</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="exterior_lighting" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="drilling">Drilling</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="drilling" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="heliport">Heliport</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="heliport" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="well">Well</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="well" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="source">Source</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="source" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Immeuble</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="collective_lift">Collective lift</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="communal_laundry_room">Communal laundry room</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="network_cabling">Network cabling</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="collective_optical_fiber">Collective optical fiber</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="collective_optical_fiber" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="parable">Parable</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="parable" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Sécurité</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="alarm">Alarm</label>--}}
                                {{--<input  class="form-control" type="text" name="alarm" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="magnetic_card">Magnetic card</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="magnetic_card" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="fenced">Fenced</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="fenced" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="safe">Safe</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="safe" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="digicode">DigiCode</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="digicode" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="guardian">Guardian</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="guardian" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="caretaker">Caretaker</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="caretaker" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="intercom">Intercom</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="intercom" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="electric_gate">Electric gate</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="electric_gate" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="reinforced_door">Reinforced door</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="reinforced_door" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="videophone">Videophone</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="videophone" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Vue</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="clear">Clear</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="clear" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="impregnable">Impregnable</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="impregnable" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="panoramic">Panoramic</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="panoramic" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="courtyard">Courtyard</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="courtyard" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_countryside">On the countryside</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_countryside" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_forest">On the forest</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_forest" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_sea">On the sea</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_sea" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_pool">On the pool</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_pool" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_river">On the river</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_river" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_street">On the street</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_street" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_city">On the city</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_city" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_garden">On the garden</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_garden" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_lake">On the lake</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_lake" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_park">On the park</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_park" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_haven">On the haven</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_haven" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_hills">On the hills</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_hills" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_mountains">On the mountains</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_mountains" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="on_the_ski_slopes">On the ski slopes</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="on_the_ski_slopes" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="vis_a_vis">Vis-a-vis</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="vis_a_vis" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Etat--}}
                            {{--</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="interior_condition">Interior Condition</label>--}}
                                {{--<select class="form-control" name="interior_condition" id="interior_condition">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="type_of_construction">Type of construction</label>--}}
                                {{--<select class="form-control" name="type_of_construction" id="type_of_construction">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="state_of_the_front">State of the front</label>--}}
                                {{--<select class="form-control" name="state_of_the_front" id="state_of_the_front">--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="external_state">External state</label>--}}
                                {{--<select class="form-control" name="external_state" id="external_state">--}}
                                    {{--<option value="1">1</option>--}}
                                    {{--<option value="2">2</option>--}}
                                {{--</select>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="year_of_construction">Year of construction</label>--}}
                                {{--<input  class="form-control" type="date" name="year_of_construction" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="year_of_renovation">Year of renovation</label>--}}
                                {{--<input  class="form-control" type="date" name="year_of_renovation" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="panel">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title">Exposition</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a href="#" class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}

                            {{--<div class="form-group">--}}
                                {{--<label for="nord">Nord</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="nord" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="south">South</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="south" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="est">Est</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="est" placeholder="" value>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="west">West</label>--}}
                                {{--<input class="toggleswitch" type="checkbox" name="west" placeholder="" value>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}

                </div>
                <div class="col-md-4">
                    <!-- ### DETAILS ### -->
                    <div class="panel panel panel-bordered panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-clipboard"></i> {{ __('voyager.post.details') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.slug') }}</label>
                                @include('voyager::multilingual.input-hidden', [
                                    '_field_name'  => 'slug',
                                    '_field_trans' => get_field_translations($dataTypeContent, 'slug')
                                ])
                                <input type="text" class="form-control" id="slug" name="slug"
                                       placeholder="slug"
                                       {{!! isFieldSlugAutoGenerator($dataType, $dataTypeContent, "slug") !!}}
                                       value="@if(isset($dataTypeContent->slug)){{ $dataTypeContent->slug }}@endif">
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.status') }}</label>
                                <select class="form-control" name="status">
                                    <option value="PUBLISHED" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PUBLISHED'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_published') }}</option>
                                    <option value="DRAFT" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'DRAFT'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_draft') }}</option>
                                    <option value="PENDING" @if(isset($dataTypeContent->status) && $dataTypeContent->status == 'PENDING'){{ 'selected="selected"' }}@endif>{{ __('voyager.post.status_pending') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">{{ __('voyager.post.category') }}</label>
                                <select class="form-control" name="category_id">
                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                        @if($category->parent_id == null)
                                            <option style = "font-size: 20px" value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}(Category)(ID: {{ $category->id }})</option>
                                        @else
                                            <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif> - {{ $category->name }}(Category ID: {{ $category->parent_id }})</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            {{--<div class="form-group">--}}
                                {{--<label for="name">{{ __('voyager.generic.featured') }}</label>--}}
                                {{--<input type="checkbox" name="featured" @if(isset($dataTypeContent->featured) && $dataTypeContent->featured){{ 'checked="checked"' }}@endif>--}}
                            {{--</div>--}}
                        </div>
                    </div>

                    <!-- ### IMAGE ### -->
                    <div class="panel panel-bordered panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="icon wb-image"></i> {{ __('voyager.post.image') }}</h3>
                            <div class="panel-actions">
                                <a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            @if(isset($dataTypeContent->image))
                                <img src="{{ filter_var($dataTypeContent->image, FILTER_VALIDATE_URL) ? $dataTypeContent->image : Voyager::image( $dataTypeContent->image ) }}" style="width:100%" />
                            @endif
                            <input type="file" name="image">
                        </div>
                    </div>

                    <!-- ### SEO CONTENT ### -->
                    {{--<div class="panel panel-bordered panel-info">--}}
                        {{--<div class="panel-heading">--}}
                            {{--<h3 class="panel-title"><i class="icon wb-search"></i> {{ __('voyager.post.seo_content') }}</h3>--}}
                            {{--<div class="panel-actions">--}}
                                {{--<a class="panel-action voyager-angle-down" data-toggle="panel-collapse" aria-hidden="true"></a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="panel-body">--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name">{{ __('voyager.post.meta_description') }}</label>--}}
                                {{--@include('voyager::multilingual.input-hidden', [--}}
                                    {{--'_field_name'  => 'meta_description',--}}
                                    {{--'_field_trans' => get_field_translations($dataTypeContent, 'meta_description')--}}
                                {{--])--}}
                                {{--<textarea class="form-control" name="meta_description">@if(isset($dataTypeContent->meta_description)){{ $dataTypeContent->meta_description }}@endif</textarea>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name">{{ __('voyager.post.meta_keywords') }}</label>--}}
                                {{--@include('voyager::multilingual.input-hidden', [--}}
                                    {{--'_field_name'  => 'meta_keywords',--}}
                                    {{--'_field_trans' => get_field_translations($dataTypeContent, 'meta_keywords')--}}
                                {{--])--}}
                                {{--<textarea class="form-control" name="meta_keywords">@if(isset($dataTypeContent->meta_keywords)){{ $dataTypeContent->meta_keywords }}@endif</textarea>--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="name">{{ __('voyager.post.seo_title') }}</label>--}}
                                {{--@include('voyager::multilingual.input-hidden', [--}}
                                    {{--'_field_name'  => 'seo_title',--}}
                                    {{--'_field_trans' => get_field_translations($dataTypeContent, 'seo_title')--}}
                                {{--])--}}
                                {{--<input type="text" class="form-control" name="seo_title" placeholder="SEO Title" value="@if(isset($dataTypeContent->seo_title)){{ $dataTypeContent->seo_title }}@endif">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="panel panel-bordered panel-info">
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status_id">
                                    @foreach(TCG\Voyager\Models\Status::all() as $status)
                                        <option value="{{ $status->reference }}" @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ 'selected="selected"' }}@endif>{{ $status->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Mandate</label>
                                <select class="form-control" name="mandate_id">
                                    @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                        <option value="{{ $mandate->reference }}" @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ 'selected="selected"' }}@endif>{{ $mandate->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Origin</label>
                                <select class="form-control" name="origin_id">
                                    @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                        <option value="{{ $origin->reference }}" @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ 'selected="selected"' }}@endif>{{ $origin->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Country</label>
                                <select class="form-control" name="country">
                                    @foreach(TCG\Voyager\Models\Country::all() as $country)
                                        <option value="{{ $country->reference }}" @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ 'selected="selected"' }}@endif>{{ $country->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Location</label>
                                <select class="form-control" name="location">
                                    @foreach(TCG\Voyager\Models\Location::all() as $location)
                                        <option value="{{ $location->reference }}" @if(isset($dataTypeContent->location) && $dataTypeContent->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Languages</label>
                                <select class="form-control" name="lng_of_add">
                                    @foreach(TCG\Voyager\Models\Languages::all() as $lng_of_add)
                                        <option value="{{ $lng_of_add->reference }}" @if(isset($dataTypeContent->lng_of_add) && $dataTypeContent->lng_of_add == $lng_of_add->reference){{ 'selected="selected"' }}@endif>{{ $lng_of_add->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Currency</label>
                                <select class="form-control" name="сurrency">
                                    @foreach(TCG\Voyager\Models\Currency::all() as $сurrency)
                                        <option value="{{ $сurrency->reference }}" @if(isset($dataTypeContent->сurrency) && $dataTypeContent->сurrency == $сurrency->reference){{ 'selected="selected"' }}@endif>{{ $сurrency->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Regime</label>
                                <select class="form-control" name="regime">
                                    @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                        <option value="{{ $regime->reference }}" @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ 'selected="selected"' }}@endif>{{ $regime->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Floor Property</label>
                                <select class="form-control" name="floor_property">
                                    @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)
                                        <option value="{{ $floor_property->reference }}" @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ 'selected="selected"' }}@endif>{{ $floor_property->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Type of Land</label>
                                <select class="form-control" name="type_land">
                                    @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                        <option value="{{ $type_land->reference }}" @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ 'selected="selected"' }}@endif>{{ $type_land->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Kitchen</label>
                                <select class="form-control" name="type">
                                    @foreach(TCG\Voyager\Models\Kitchen::all() as $type)
                                        <option value="{{ $type->reference }}" @if(isset($dataTypeContent->type) && $dataTypeContent->type == $type->reference){{ 'selected="selected"' }}@endif>{{ $type->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Heating</label>
                                <select class="form-control" name="format">
                                    @foreach(TCG\Voyager\Models\Heating::all() as $format)
                                        <option value="{{ $format->reference }}" @if(isset($dataTypeContent->format) && $dataTypeContent->format == $format->reference){{ 'selected="selected"' }}@endif>{{ $format->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Chauffage energy</label>
                                <select class="form-control" name="chauffage_energy">
                                    @foreach(TCG\Voyager\Models\Energy::all() as $chauffage_energy)
                                        <option value="{{ $chauffage_energy->reference }}" @if(isset($dataTypeContent->chauffage_energy) && $dataTypeContent->chauffage_energy == $chauffage_energy->reference){{ 'selected="selected"' }}@endif>{{ $chauffage_energy->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Heating type</label>
                                <select class="form-control" name="type_heating">
                                    @foreach(TCG\Voyager\Models\HeatingType::all() as $type_heating)
                                        <option value="{{ $type_heating->reference }}" @if(isset($dataTypeContent->type_heating) && $dataTypeContent->type_heating == $type_heating->reference){{ 'selected="selected"' }}@endif>{{ $type_heating->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Radiator</label>
                                <select class="form-control" name="type_radiator">
                                    @foreach(TCG\Voyager\Models\Radiator::all() as $type_radiator)
                                        <option value="{{ $type_radiator->reference }}" @if(isset($dataTypeContent->type_radiator) && $dataTypeContent->type_radiator == $type_radiator->reference){{ 'selected="selected"' }}@endif>{{ $type_radiator->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Distribution</label>
                                <select class="form-control" name="distribution">
                                    @foreach(TCG\Voyager\Models\WaterDistribution::all() as $distribution)
                                        <option value="{{ $distribution->reference }}" @if(isset($dataTypeContent->distribution) && $dataTypeContent->distribution == $distribution->reference){{ 'selected="selected"' }}@endif>{{ $distribution->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Water energy</label>
                                <select class="form-control" name="eau_chaude_energy">
                                    @foreach(TCG\Voyager\Models\WaterEnergy::all() as $eau_chaude_energy)
                                        <option value="{{ $eau_chaude_energy->reference }}" @if(isset($dataTypeContent->eau_chaude_energy) && $dataTypeContent->eau_chaude_energy == $eau_chaude_energy->reference){{ 'selected="selected"' }}@endif>{{ $eau_chaude_energy->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Waste distribution</label>
                                <select class="form-control" name="usees_distribution">
                                    @foreach(TCG\Voyager\Models\WasteDistribution::all() as $usees_distribution)
                                        <option value="{{ $usees_distribution->reference }}" @if(isset($dataTypeContent->usees_distribution) && $dataTypeContent->usees_distribution == $usees_distribution->reference){{ 'selected="selected"' }}@endif>{{ $usees_distribution->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Minergie</label>
                                <select class="form-control" name="divers_format">
                                    @foreach(TCG\Voyager\Models\Minergie::all() as $divers_format)
                                        <option value="{{ $divers_format->reference }}" @if(isset($dataTypeContent->divers_format) && $dataTypeContent->divers_format == $divers_format->reference){{ 'selected="selected"' }}@endif>{{ $divers_format->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Sonority</label>
                                <select class="form-control" name="sonority">
                                    @foreach(TCG\Voyager\Models\Sonority::all() as $sonority)
                                        <option value="{{ $sonority->reference }}" @if(isset($dataTypeContent->sonority) && $dataTypeContent->sonority == $sonority->reference){{ 'selected="selected"' }}@endif>{{ $sonority->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Style</label>
                                <select class="form-control" name="style">
                                    @foreach(TCG\Voyager\Models\Style::all() as $style)
                                        <option value="{{ $style->reference }}" @if(isset($dataTypeContent->style) && $dataTypeContent->style == $style->reference){{ 'selected="selected"' }}@endif>{{ $style->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Interior condition</label>
                                <select class="form-control" name="interior_condition">
                                    @foreach(TCG\Voyager\Models\State::all() as $interior_condition)
                                        <option value="{{ $interior_condition->reference }}" @if(isset($dataTypeContent->interior_condition) && $dataTypeContent->interior_condition == $interior_condition->reference){{ 'selected="selected"' }}@endif>{{ $interior_condition->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">Construction</label>
                                <select class="form-control" name="type_construction">
                                    @foreach(TCG\Voyager\Models\Construction::all() as $type_construction)
                                        <option value="{{ $type_construction->reference }}" @if(isset($dataTypeContent->type_construction) && $dataTypeContent->type_construction == $type_construction->reference){{ 'selected="selected"' }}@endif>{{ $type_construction->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">State front</label>
                                <select class="form-control" name="state_front">
                                    @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                        <option value="{{ $state_front->reference }}" @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ 'selected="selected"' }}@endif>{{ $state_front->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="name">External state</label>
                                <select class="form-control" name="external_state">
                                    @foreach(TCG\Voyager\Models\State::all() as $external_state)
                                        <option value="{{ $external_state->reference }}" @if(isset($dataTypeContent->external_state) && $dataTypeContent->external_state == $external_state->reference){{ 'selected="selected"' }}@endif>{{ $external_state->value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary pull-right">
                @if(isset($dataTypeContent->id)){{ __('voyager.post.update') }}@else <i class="icon wb-plus-circle"></i> {{ __('voyager.post.new') }} @endif
            </button>
        </form>

        <iframe id="form_target" name="form_target" style="display:none"></iframe>
        <form id="my_form" action="{{ route('voyager.upload') }}" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
            {{ csrf_field() }}
            <input name="image" id="upload_file" type="file" onchange="$('#my_form').submit();this.value='';">
            <input type="hidden" name="type_slug" id="type_slug" value="{{ $dataType->slug }}">
        </form>
    </div>

    {{--This is mettronic "add object" form: BEGIN--}}
    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="display: none;">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Add/Edit new object
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
                                    Objects
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Object ID
                                </span>
                            </a>
                        </li>
                    </ul>
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
                <div class="col-lg-12">
                    <!--begin::Portlet-->
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide"><i class="la la-gear"></i></span>
                                    <h3 class="m-portlet__head-text">Rédaction</h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label for="m_select2_9">Language of the ad</label>
                                        <select class="form-control m-select2" id="m_select2_9" name="location" data-placeholder="Select Language of the ad">
                                            <option value=""></option>
                                            <option value="FR">FR</option>
                                            <option value="EN">EN</option>
                                            <option value="RU">RU</option>
                                            <option value="DE">DE</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-9 margin_bottom_10">
                                        <label class="">Ad Title</label>
                                        <input type="email" class="form-control m-input" placeholder="Ad Title">
                                        <span class="m-form__help">Please enter your Ad Title</span>
                                    </div>
                                    <div class="col-lg-12 margin_bottom_10">
                                        <label for="exampleTextarea">Example textarea</label>
                                        <textarea class="form-control m-input" id="exampleTextarea" rows="3"></textarea>
                                    </div>
                                    <div class="col-lg-12 margin_bottom_10">
                                        <label>File Type Validation</label>
                                        <div class="m-dropzone dropzone m-dropzone--success" action="inc/api/dropzone/upload.php" id="m-dropzone-three">
                                            <div class="m-dropzone__msg dz-message needsclick">
                                                <h3 class="m-dropzone__msg-title">
                                                    Drop files here or click to upload.
                                                </h3>
                                                <span class="m-dropzone__msg-desc">
                                                    Only image, pdf and psd files are allowed for upload
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
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
                                        Général
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Reference</label>
                                        <input type="email" class="form-control m-input" placeholder="Référence">
                                        <span class="m-form__help">
                                            Please enter Référence
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_1">Category</label>
                                        <select class="form-control m-select2" id="m_select2_1" name="category" data-placeholder="Select a Category">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_2">Sub-category</label>
                                        <select class="form-control m-select2" id="m_select2_2" name="sub_category" data-placeholder="Select a sub-category">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">Notation</label>
                                        <input type="number" class="form-control m-input" placeholder="Notation">
                                        <span class="m-form__help">Please enter your notation</span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_3">Broker</label>
                                        <select class="form-control m-select2" id="m_select2_3" name="broker" data-placeholder="Select a Courtier">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_4">Status</label>
                                        <select class="form-control m-select2" id="m_select2_4" name="status" data-placeholder="Select a Statut">
                                            <option value=""></option>
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_5">Mandate</label>
                                        <select class="form-control m-select2" id="m_select2_5" name="mandate" data-placeholder="Select a Mandat">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_6">Origin</label>
                                        <select class="form-control m-select2" id="m_select2_6" name="origin" data-placeholder="Select a Origine">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="m-checkbox">
                                            <input type="checkbox">Exclusivité
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Début du mandat</label>
                                        <div class='input-group date' id='m_datepicker_2'>
                                            <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                            <span class="input-group-addon">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Fin du mandat</label>
                                        <div class='input-group date' id='m_datepicker_2'>
                                            <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                            <span class="input-group-addon">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Disponibilité</label>
                                        <div class='input-group date' id='m_datepicker_2'>
                                            <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                            <span class="input-group-addon">
                                                <i class="la la-calendar-check-o"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Disponibilité à partir du / jusqu'au</label>
                                        <div class="input-daterange input-group" id="m_datepicker_5">
                                            <input type="text" class="form-control m-input" name="start" />
                                            <span class="input-group-addon">
                                                <i class="la la-ellipsis-h"></i>
                                            </span>
                                            <input type="text" class="form-control" name="end" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Promotion :
                                        </label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="promotion_radio" checked value="2">
                                                Oui
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="promotion_radio" value="2">
                                                Non
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Transaction directe :
                                        </label>
                                        <div class="m-radio-inline">
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="direct_transaction_radio" checked value="2">
                                                Oui
                                                <span></span>
                                            </label>
                                            <label class="m-radio m-radio--solid">
                                                <input type="radio" name="direct_transaction_radio" value="2">
                                                Non
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Note sur la transaction</label>
                                        <input type="email" class="form-control m-input" placeholder="Note sur la transaction">
                                        <span class="m-form__help">
                                            Please enter Note sur la transaction
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Note courtier</label>
                                        <input type="email" class="form-control m-input" placeholder="Note courtier">
                                        <span class="m-form__help">
                                            Please enter Note courtier
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Remarques importantes</label>
                                        <input type="email" class="form-control m-input" placeholder="Remarques importantes">
                                        <span class="m-form__help">
                                            Please enter Remarques importantes
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Notes pour le propriétaire</label>
                                        <input type="email" class="form-control m-input" placeholder="Notes pour le propriétaire">
                                        <span class="m-form__help">
                                            Please enter Notes pour le propriétaire
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
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
                                        Adresse
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            Adress
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your address">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your address
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            Street
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Street name">
                                        <span class="m-form__help">
                                            Please enter your street
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Number
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Number">
                                        <span class="m-form__help">
                                            Please enter your number
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            PO box
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-inbox"></i>
                                                </span>
                                            </span>
                                            <input type="number" class="form-control m-input" placeholder="">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your PO box
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            ZIP Code
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="ZIP Code">
                                        <span class="m-form__help">
                                            Please enter your ZIP Code
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Town
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Town">
                                        <span class="m-form__help">
                                            Please enter your town
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_7">Country</label>
                                        <select class="form-control m-select2" id="m_select2_7" name="country" data-placeholder="Select a Country">
                                            <option value=""></option>
                                            <option value="FR">Swiss</option>
                                            <option value="MU">France</option>
                                            <option value="US">Belgium</option>
                                            <option value="US">Germany</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_8">Location</label>
                                        <select class="form-control m-select2" id="m_select2_8" name="location" data-placeholder="Select Location">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
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
                                    <h3 class="m-portlet__head-text">Prix</h3>
                                </div>
                            </div>
                        </div>
                        <!--begin::Form-->
                        <form class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-3 margin_bottom_10">
                                        <label for="m_select2_10">Currency</label>
                                        <select class="form-control m-select2" id="m_select2_10" name="location" data-placeholder="Select Language of the ad">
                                            <option value=""></option>
                                            <option value="FR">EUR</option>
                                            <option value="EN">CHF</option>
                                            <option value="RU">USD</option>
                                            <option value="DE">MDL</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            Adress
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <input type="text" class="form-control m-input" placeholder="Enter your address">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-map-marker"></i>
                                                </span>
                                            </span>
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your address
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            Street
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Street name">
                                        <span class="m-form__help">
                                            Please enter your street
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Number
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Number">
                                        <span class="m-form__help">
                                            Please enter your number
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>
                                            PO box
                                        </label>
                                        <div class="m-input-icon m-input-icon--right">
                                            <span class="m-input-icon__icon m-input-icon__icon--right">
                                                <span>
                                                    <i class="la la-inbox"></i>
                                                </span>
                                            </span>
                                            <input type="number" class="form-control m-input" placeholder="">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your PO box
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            ZIP Code
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="ZIP Code">
                                        <span class="m-form__help">
                                            Please enter your ZIP Code
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Town
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Town">
                                        <span class="m-form__help">
                                            Please enter your town
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_7">Country</label>
                                        <select class="form-control m-select2" id="m_select2_7" name="country" data-placeholder="Select a Country">
                                            <option value=""></option>
                                            <option value="FR">Swiss</option>
                                            <option value="MU">France</option>
                                            <option value="US">Belgium</option>
                                            <option value="US">Germany</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="m_select2_8">Location</label>
                                        <select class="form-control m-select2" id="m_select2_8" name="location" data-placeholder="Select Location">
                                            <option value=""></option>
                                            <option value="FR">House</option>
                                            <option value="MU">Apartment</option>
                                            <option value="US">Building</option>
                                            <option value="US">Land</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <button type="reset" class="btn btn-primary">Save</button>
                                            <button type="reset" class="btn btn-secondary">Cancel</button>
                                        </div>
                                        <div class="col-lg-6 m--align-right">
                                            <button type="reset" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Portlet-->
                </div>
            </div>
        </div>
    </div>
    {{--This is mettronic "add object" form: END--}}
@stop

@section('javascript')
    <!--begin::Page Resources -->
    <script src="{{ asset('assets/metronic_5/theme/dist/html/default/assets/demo/default/custom/components/forms/widgets/dropzone.js') }}" type="text/javascript"></script>
    <!--end::Page Resources -->
    {{--<script src="{{ asset('assets/plugins/js/select2.min.js') }}" type="text/javascript"></script>--}}
    {{--<script>--}}
    {{--$('document').ready(function () {--}}
    {{--$('#slug').slugify();--}}

    {{--@if ($isModelTranslatable)--}}
    {{--$('.side-body').multilingual({"editing": true});--}}
    {{--@endif--}}
    {{--});--}}

    {{--$('select').select2();--}}
    {{--</script>--}}
@stop
