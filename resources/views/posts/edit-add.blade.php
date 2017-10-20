@extends('voyager::master_metronic')

{{--@extends('voyager::master')--}}

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
    <div class="page-content container-fluid" style="display: none;margin-bottom: 100px; padding-top: 50px;">
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
                                        <div class="form-group col-md-6 @if($row->type == 'hidden') hidden @endif @if(isset($display_options->width)){{ 'col-md-' . $display_options->width }}@else{{ '' }}@endif" @if(isset($display_options->id)){{ "id=$display_options->id" }}@endif>
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
    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="">
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
                                        <label>Language of the ad</label>
                                        <select class="form-control m-select2 his_select2" name="location" data-placeholder="Select Language of the ad">
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
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Reference</label>
                                            <input type="email" class="form-control m-input" placeholder="Référence" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="reference">
                                            <span class="m-form__help">
                                            Please enter Référence
                                        </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label for="category_id">Category</label>
                                        <select class="form-control m-select2" id="category_id" name="category_id" data-placeholder="Select a Category">
                                            @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                @if($category->parent_id == null)
                                                    <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif>{{ $category->name }}</option>
                                                @else
                                                    <option value="{{ $category->id }}" @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ 'selected="selected"' }}@endif> - {{ $category->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    {{--<div class="col-lg-4">--}}
                                        {{--<div class="form-group">--}}
                                            {{--<label for="m_select2_1">Category</label>--}}
                                            {{--<select class="form-control m-select2" id="m_select2_1" name="category" data-placeholder="Select a Category">--}}
                                                {{--<option value=""></option>--}}
                                                {{--<option value="FR">House</option>--}}
                                                {{--<option value="MU">Apartment</option>--}}
                                                {{--<option value="US">Building</option>--}}
                                                {{--<option value="US">Land</option>--}}
                                                {{--<option value="US">Building</option>--}}
                                                {{--<option value="US">Land</option>--}}
                                            {{--</select>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label for="m_select2_2">Sub-category</label>
                                            <select class="form-control m-select2 his_select2" name="sub_category" data-placeholder="Select a sub-category">
                                                <option value=""></option>
                                                <option value="FR">House</option>
                                                <option value="MU">Apartment</option>
                                                <option value="US">Building</option>
                                                <option value="US">Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="">Notation</label>
                                            <input type="number" class="form-control m-input" placeholder="Notation" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="notation">
                                            <span class="m-form__help">Please enter your notation</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Broker</label>
                                            <select class="form-control m-select2 his_select2" name="broker" data-placeholder="Select a Courtier">
                                                <option value=""></option>
                                                <option value="FR">House</option>
                                                <option value="MU">Apartment</option>
                                                <option value="US">Building</option>
                                                <option value="US">Land</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control m-select2 his_select2" name="status_id" data-placeholder="Select a Statut">
                                                @foreach(TCG\Voyager\Models\Status::all() as $status)
                                                    <option value="{{ $status->reference }}" @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ 'selected="selected"' }}@endif>{{ $status->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Mandate</label>
                                            <select class="form-control m-select2 his_select2" name="mandate_id" data-placeholder="Select a Mandat">
                                                @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                                    <option value="{{ $mandate->reference }}" @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ 'selected="selected"' }}@endif>{{ $mandate->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Origin</label>
                                            <select class="form-control m-select2 his_select2" name="origin_id" data-placeholder="Select a Origine">
                                                @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                                    <option value="{{ $origin->reference }}" @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ 'selected="selected"' }}@endif>{{ $origin->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="m-checkbox">
                                                <input type="checkbox" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="exclusiveness">Exclusivité
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Début du mandat</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Fin du mandat</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                                <span class="input-group-addon"><i class="la la-calendar-check-o"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Disponibilité</label>
                                            <div class='input-group date' id='m_datepicker_2'>
                                                <input type='text' class="form-control m-input" readonly  placeholder="Select date"/>
                                                <span class="input-group-addon">
                                                    <i class="la la-calendar-check-o"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Disponibilité à partir du / jusqu'au</label>
                                            <div class="input-daterange input-group" id="m_datepicker_5">
                                                <input type="text" class="form-control m-input" name="start" name="availab_from" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" />
                                                <span class="input-group-addon">
                                                    <i class="la la-ellipsis-h"></i>
                                                </span>
                                                <input type="text" class="form-control" name="end" name="availab_until" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
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
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="">Transaction directe :</label>
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
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Note sur la transaction</label>
                                            <input type="email" class="form-control m-input" placeholder="Note sur la transaction" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="note_transaction">
                                            <span class="m-form__help">Please enter Note sur la transaction</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Note courtier</label>
                                            <input type="email" class="form-control m-input" placeholder="Note courtier" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="broker_notes">
                                            <span class="m-form__help">Please enter Note courtier</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Remarques importantes</label>
                                            <input type="email" class="form-control m-input" placeholder="Remarques importantes" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="important_notes">
                                            <span class="m-form__help">Please enter Remarques importantes</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Notes pour le propriétaire</label>
                                            <input type="email" class="form-control m-input" placeholder="Notes pour le propriétaire" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="owner_notes">
                                            <span class="m-form__help">Please enter Notes pour le propriétaire</span>
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
                                            <input type="text" class="form-control m-input" placeholder="Enter your address" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="address">
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
                                        <input type="email" class="form-control m-input" placeholder="Street name" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="street">
                                        <span class="m-form__help">
                                            Please enter your street
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Number
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Number" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="number">
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
                                            <input type="number" class="form-control m-input" placeholder="" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="po_box">
                                        </div>
                                        <span class="m-form__help">
                                            Please enter your PO box
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            ZIP Code
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="ZIP Code" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="zip_code">
                                        <span class="m-form__help">
                                            Please enter your ZIP Code
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label class="">
                                            Town
                                        </label>
                                        <input type="email" class="form-control m-input" placeholder="Town" value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="town">
                                        <span class="m-form__help">
                                            Please enter your town
                                        </span>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Country</label>
                                        <select class="form-control m-select2 his_select2" name="country" data-placeholder="Select a Country">
                                            @foreach(TCG\Voyager\Models\Country::all() as $country)
                                                <option value="{{ $country->reference }}" @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ 'selected="selected"' }}@endif>{{ $country->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 margin_bottom_10">
                                        <label>Location</label>
                                        <select class="form-control m-select2 his_select2" name="location" data-placeholder="Select Location">
                                            @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                <option value="{{ $location->reference }}" @if(isset($dataTypeContent->location) && $dataTypeContent->location == $location->reference){{ 'selected="selected"' }}@endif>{{ $location->value }}</option>
                                            @endforeach
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
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Currency</label>
                                            <select class="form-control m-select2 his_select2" name="сurrency" data-placeholder="Select currency">
                                                @foreach(TCG\Voyager\Models\Currency::all() as $сurrency)
                                                    <option value="{{ $сurrency->reference }}" @if(isset($dataTypeContent->сurrency) && $dataTypeContent->сurrency == $сurrency->reference){{ 'selected="selected"' }}@endif>{{ $сurrency->value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2 margin_bottom_10">
                                        <div class="form-group">
                                            <label class="">Show price :</label>
                                            <div class="m-radio-inline">
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price_radio" checked value="2">
                                                    Yes
                                                    <span></span>
                                                </label>
                                                <label class="m-radio m-radio--solid">
                                                    <input type="radio" name="show_price_radio" value="2">
                                                    No
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="price">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Price per m<sup>2</sup></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="price_m2">
                                                <span class="input-group-addon">EUR/m<sup>2</sup></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Gross yield</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="gross_yield">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Net return</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="net_return">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Owner amount</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="..." value="@if(isset($dataTypeContent->title)){{ $dataTypeContent->title }}@endif" name="owner_amount">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Owner amount</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Client fees</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Client fees</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Owner fees</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Owner fees</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Negotiable amount</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Estimate price</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label>Recording rights</label>
                                            <div class="input-group">
                                                <input type="number" class="form-control m-input" placeholder="...">
                                                <span class="input-group-addon">EUR</span>
                                            </div>
                                        </div>
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
