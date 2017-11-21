@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@section('css')
    <link href="{{ asset('assets/plugins/css/slick.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/css/slick-theme.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('page_title','View '.$dataType->display_name_singular)

@section('page_header')
    <h1 class="page-title">
        <i class="{{ $dataType->icon }}"></i> {{ __('voyager.generic.viewing') }} {{ ucfirst($dataType->display_name_singular) }} &nbsp;

        @can('edit', $dataTypeContent)
            <a href="{{ route('voyager.'.$dataType->slug.'.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
                <span class="glyphicon glyphicon-pencil"></span>&nbsp;
                {{ __('voyager.generic.edit') }}
            </a>
        @endcan
        <a href="{{ route('voyager.'.$dataType->slug.'.index') }}" class="btn btn-warning">
            <span class="glyphicon glyphicon-list"></span>&nbsp;
            {{ __('voyager.generic.return_to_list') }}
        </a>
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content read container-fluid" style="padding-top: 30px; padding-bottom: 60px; display:none;">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered" style="padding-bottom:5px;">
                    <!-- form start -->
                    @foreach($dataType->readRows as $row)
                        @php $rowDetails = json_decode($row->details);
                         if($rowDetails === null){
                                $rowDetails=new stdClass();
                                $rowDetails->options=new stdClass();
                         }
                        @endphp

                        <div class="panel-heading" style="border-bottom:0;">
                            <h3 class="panel-title">{{ $row->display_name }}</h3>
                        </div>

                        <div class="panel-body" style="padding-top:0;">
                            @if($row->type == "image")
                                <img class="img-responsive"
                                     src="{{ filter_var($dataTypeContent->{$row->field}, FILTER_VALIDATE_URL) ? $dataTypeContent->{$row->field} : Voyager::image($dataTypeContent->{$row->field}) }}">
                            @elseif($row->type == 'relationship')
                                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $rowDetails])
                            @elseif($row->type == 'select_dropdown' && property_exists($rowDetails, 'options') &&
                                    !empty($rowDetails->options->{$dataTypeContent->{$row->field}})
                            )

                                <?php echo $rowDetails->options->{$dataTypeContent->{$row->field}};?>
                            @elseif($row->type == 'select_dropdown' && $dataTypeContent->{$row->field . '_page_slug'})
                                <a href="{{ $dataTypeContent->{$row->field . '_page_slug'} }}">{{ $dataTypeContent->{$row->field}  }}</a>
                            @elseif($row->type == 'select_multiple')
                                @if(property_exists($rowDetails, 'relationship'))

                                    @foreach($dataTypeContent->{$row->field} as $item)
                                        @if($item->{$row->field . '_page_slug'})
                                            <a href="{{ $item->{$row->field . '_page_slug'} }}">{{ $item->{$row->field}  }}</a>@if(!$loop->last), @endif
                                        @else
                                            {{ $item->{$row->field}  }}
                                        @endif
                                    @endforeach

                                @elseif(property_exists($rowDetails, 'options'))
                                    @foreach($dataTypeContent->{$row->field} as $item)
                                        {{ $rowDetails->options->{$item} . (!$loop->last ? ', ' : '') }}
                                    @endforeach
                                @endif
                            @elseif($row->type == 'date')
                                {{ $rowDetails && property_exists($rowDetails, 'format') ? \Carbon\Carbon::parse($dataTypeContent->{$row->field})->formatLocalized($rowDetails->format) : $dataTypeContent->{$row->field} }}
                            @elseif($row->type == 'checkbox')
                                @if($rowDetails && property_exists($rowDetails, 'on') && property_exists($rowDetails, 'off'))
                                    @if($dataTypeContent->{$row->field})
                                        <span class="label label-info">{{ $rowDetails->on }}</span>
                                    @else
                                        <span class="label label-primary">{{ $rowDetails->off }}</span>
                                    @endif
                                @else
                                    {{ $dataTypeContent->{$row->field} }}
                                @endif
                            @elseif($row->type == 'color')
                                <span class="badge badge-lg" style="background-color: {{ $dataTypeContent->{$row->field} }}">{{ $dataTypeContent->{$row->field} }}</span>
                            @elseif($row->type == 'coordinates')
                                @include('voyager::partials.coordinates')
                            @elseif($row->type == 'rich_text_box')
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{!! $dataTypeContent->{$row->field} !!}</p>
                            @elseif($row->type == 'file')
                                @if(json_decode($dataTypeContent->{$row->field}))
                                    @foreach(json_decode($dataTypeContent->{$row->field}) as $file)
                                        <a href="/storage/{{ $file->download_link or '' }}">
                                            {{ $file->original_name or '' }}
                                        </a>
                                        <br/>
                                    @endforeach
                                @else
                                    <a href="/storage/{{ $dataTypeContent->{$row->field} }}">
                                        Download
                                    </a>
                                @endif
                            @else
                                @include('voyager::multilingual.input-hidden-bread-read')
                                <p>{{ $dataTypeContent->{$row->field} }}</p>
                            @endif
                        </div><!-- panel-body -->
                        @if(!$loop->last)
                            <hr style="margin:0;">
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="display: block;">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        Object view page
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
            <!--Begin::Main Portlet-->
            <div class="row">
                <div class="col-xl-8">
                    <!--begin:: Widgets/Blog-->
                    <div class="m-portlet m-portlet--full-height gallery_container">
                        <div class="m-portlet__body">
                            <div class="m-widget19">
                                <div class="m-widget19__pic m-portlet-fit--sides" style1="height: 280px">
                                    <div class="object_gallery">
                                        @if(!empty(json_decode($dataTypeContent->image)))
                                            @foreach(json_decode($dataTypeContent->image) as $image)
                                                <div><img src="{{ URL::to('storage') }}/{{ $image }}" alt=""></div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <h3 class="m-widget19__title m--font-light">
                                        {{ $dataTypeContent->title_fr }}
                                    </h3>
                                    <div class="m-widget19__shadow"></div>
                                </div>
                                <div class="m-widget19__content">
                                    <div class="m-widget19__header">
                                        <div class="m-widget19__user-img">
                                            <img class="m-widget19__img" src="/assets/metronic_5/theme/dist/html/default/assets/app/media/img//users/user1.jpg" alt="">
                                        </div>
                                        <div class="m-widget19__info">
                                            <span class="m-widget19__username">
                                                Anna Krox <!-- todo -->
                                            </span>
                                            <br>
                                            <span class="m-widget19__time">
                                                Admin, who posted this object
                                            </span>
                                        </div>
                                        <div class="m-widget19__stats object_price">
                                            <span class="m-widget19__number m--font-brand">
                                                @if($dataTypeContent->show_price != 0)
                                                    {{ ($dataTypeContent->price != null) ? $dataTypeContent->price : 'None' }}
                                                @endif
                                            </span>
                                            <span class="m-widget19__comment">
                                                Price comments
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget19__body">
                                        {{ $dataTypeContent->desc_add_fr }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/Blog-->
                </div>
                <div class="col-xl-4">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Général
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Référence
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->reference }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Exclusivité
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->exclusiveness == 0) ? 'None' : 'Yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Catégorie
                                                </span>
                                                <br>
                                                <span cat_id="{{ $dataTypeContent->category_id }}" class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                        @if($category->parent_id == null)
                                                            @if(isset($dataTypeContent->category_id) && $dataTypeContent->category_id == $category->id){{ $category->name }}@endif
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sous-catégorie <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Category::all() as $category)
                                                        @if($category->parent_id != null)
                                                            @if(isset($dataTypeContent->sub_category) && $dataTypeContent->sub_category == $category->id){{ $category->name }}@endif
                                                        @endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Notation
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->notation }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Courtier <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    Value
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Statut
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Status::all() as $status)
                                                        @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ $status->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Mandat
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                                        @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ $mandate->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Origine <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                                        @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ $origin->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Début du mandat
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->mandate_start }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Fin du mandat
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->term_end }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Disponibilité
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->availability }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Disponibilité à partir du
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->availab_from }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Disponibilité jusqu'au
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->availab_until }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Promotion
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->promotion == 0) ? 'Non' : 'Oui' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Transaction directe
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->direct_transaction == 0) ? 'Non' : 'Oui' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Note sur la transaction
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                     {{ $dataTypeContent->note_transaction }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Note courtier
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->broker_notes }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Remarques importantes
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->important_notes }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Notes pour le propriétaire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->owner_notes }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Main Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Adresse
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Adresse
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->address }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Rue
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->street }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    N°
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Case postale
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->po_box }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Code postale
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->zip_code }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Ville
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->town }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Pays
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Country::all() as $country)
                                                        @if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ $country->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Localisation <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Location::all() as $location)
                                                        @if(isset($dataTypeContent->location) && $dataTypeContent->location == $location->reference){{ $location->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Rédaction
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Langue de l'annonce
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Languages::all() as $lng_of_add)
                                                        @if(isset($dataTypeContent->lng_of_add) && $dataTypeContent->lng_of_add == $lng_of_add->reference){{ $lng_of_add->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Titre de l'annonce
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    Value
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Description de l'annonce
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    Value
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Prix
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Devise <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->сurrency }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Prix
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->price }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Prix au m2
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->price_m2 }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Rendement brut
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->gross_yield }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Rendement net
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->net_return }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Montant propriétaire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->owner_amount }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Honoraire client
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->client_fees }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Honoraire propriétaire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->owner_fees }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Montant négociable
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->negotiable_amount }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Montant estimé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->estimate_price }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Droits d'enregistremenet
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->recording_rights }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Régime
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                                        @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ $regime->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="heating_loads">
                                                    Charges de chauffage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->heating_loads }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ppe_charges">
                                                    Charges PPE
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->ppe_charges }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="condominium_fees">
                                                    Charges de copropriété
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->condominium_fees }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="property_tax">
                                                    Taxe foncière
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->property_tax }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Procédure en cours auprès de la copro.
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->procedure_in_progress == 0) ? 'no' : 'yes' }}  <!-- todo maybe checked -->
                                                        {{--<input type="checkbox" value="{{ ($dataTypeContent->procedure_in_progress != 0) ? '' : 'on' }}">--}}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Fonds de rénovation
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->renovation_fund }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Charges annuelles
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->annual_charges }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="taxes_1">
                                                    Taxe d'habitation
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->taxes_1 }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="rental_security">
                                                    Caution locative
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->rental_security }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="commercial_property">
                                                    Fonds de commerce
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->commercial_property }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Revenus
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->earnings }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Impôts
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->taxes }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Agencement
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_rooms">
                                                    Nombre de chambres
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_rooms }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_pieces">
                                                    Nombre de pièces
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_pieces }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Nombre de salles d'eau
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_shower_rooms + $dataTypeContent->number_toilets }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_balconies">
                                                    Nombre de balcons
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_balconies }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_shower_rooms">
                                                    Nombre de salles de douche
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_shower_rooms }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_toilets">
                                                    Nombre de WC
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_toilets }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_terraces">
                                                    Nombre de terasses
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_terraces }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_floors_building">
                                                    Nombre d'étage du bâtiment
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_floors_building }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="floor_property">
                                                    Etage du bien
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)
                                                        @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ $floor_property->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="levels">
                                                    Niveaux
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->levels }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Surface
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="surface_cellar">
                                                    Surface de la cave
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->surface_cellar }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ceiling_height">
                                                    Hauteur des plafonds
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->ceiling_height }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="roof_cover_area">
                                                    Surface de l'abri de la toiture
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->roof_cover_area }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="surf_area_terr_solar">
                                                    Surface de la terrasse / solarium
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->surf_area_terr_solar }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="area_veranda">
                                                    Surface de la véranda
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->area_veranda }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="attic_space">
                                                    Surface des combles
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->attic_space }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="surface_balcony">
                                                    Surface du balcon
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->surface_balcony }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="basement_area">
                                                    Surface du sous-sol
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->basement_area }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="surface_ground">
                                                    Surface du terrain
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->surface_ground }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ground">
                                                    Terrain
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    Longeur {{ $dataTypeContent->ground_length }} + Largeur {{ $dataTypeContent->ground_width }} <!-- todo + or  * -->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="serviced">
                                                    Viabilisé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->serviced == 0) ? 'no' : 'yes' }} <!-- todo mayby checked -->
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="type_land">
                                                    Type de terrain
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                                        @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ $type_land->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="useful_surface">
                                                    Surface utille
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->useful_surface }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ppe_area">
                                                    Surface PPE
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->ppe_area }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="volume">
                                                    Volume
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->volume }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="surface_eng_court">
                                                    Surface de la cour anglaise
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->surface_eng_court }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="lower_ground_floor">
                                                    Surface rez-de-chaussée inférieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->lower_ground_floor }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="row_area">
                                                    Surface de l'emprise
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->row_area }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="garage_area">
                                                    Surface du garage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->garage_area }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="weighted_surface">
                                                    Surface pondérée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->weighted_surface }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Stationnement
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="box_interior_garage">
                                                    Box/garage intérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->box_interior_garage }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="box_gar_inter_doub">
                                                    Box/garage double intérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->box_gar_inter_doub }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="outdoor_garage">
                                                    Box/garage extérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->outdoor_garage }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="box_garage_outside_double">
                                                    Box/garage double extérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->box_garage_outside_double }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="covered_outdoor_parking_space">
                                                    Place de parc extérieure couverte
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->covered_outdoor_parking_space }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="outside_parking_space_uncovered">
                                                    Place de parc extérieur non-couverte
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->outside_parking_space_uncovered }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="number_parking_spaces">
                                                    Nombre de places de parc
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->number_parking_spaces }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="boat_shed">
                                                    Hangar à bateau
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->boat_shed }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="mooring">
                                                    Place d'amarrage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->mooring }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-12">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Cuisine
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="type">
                                                    Type
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Kitchen::all() as $type)
                                                        @if(isset($dataTypeContent->type) && $dataTypeContent->type == $type->reference){{ $type->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="freezer">
                                                    Congélateur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->freezer == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="cooker">
                                                    Cusinière
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->cooker == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="oven">
                                                    Four
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->oven == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="microwave_oven">
                                                    Four à micro-ondes
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->microwave_oven == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="extractor_hood">
                                                    Hotte aspirante
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->extractor_hood == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="washmachine">
                                                    Lave-linge
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->washmachine == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="dishwasher">
                                                    Lave-vaiselle
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->dishwasher == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="plates">
                                                    Plaques à gaz
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->plates == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="induction_plates">
                                                    Plaques à induction
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->induction_plates == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="hotplates">
                                                    Plaques électriques
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->hotplates }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ceramic_plates">
                                                    Plaques vitrocéram
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->ceramic_plates == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="fridge">
                                                    Réfrigérateur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->fridge == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="cuisine_tumble_drier">
                                                    Sèche-linge
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->cuisine_tumble_drier == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="coffee_maker">
                                                    Cafetière
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->coffee_maker == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Chauffage
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="format">
                                                    Format
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Heating::all() as $format)
                                                        @if(isset($dataTypeContent->format) && $dataTypeContent->format == $format->reference){{ $format->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="chauffage_energy">
                                                    Energie
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Energy::all() as $chauffage_energy)
                                                        @if(isset($dataTypeContent->chauffage_energy) && $dataTypeContent->chauffage_energy == $chauffage_energy->reference){{ $chauffage_energy->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="type_heating">
                                                    Type de chauffage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\HeatingType::all() as $type_heating)
                                                        @if(isset($dataTypeContent->type_heating) && $dataTypeContent->type_heating == $type_heating->reference){{ $type_heating->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="type_radiator">
                                                    Type de radiateur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Radiator::all() as $type_radiator)
                                                        @if(isset($dataTypeContent->type_radiator) && $dataTypeContent->type_radiator == $type_radiator->reference){{ $type_radiator->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Eau chaude
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6 dis-elem">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="distribution">
                                                    Distribution
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\WaterDistribution::all() as $distribution)
                                                        @if(isset($dataTypeContent->distribution) && $dataTypeContent->distribution == $distribution->reference){{ $distribution->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="eau_chaude_energy">
                                                    Energie
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\WaterEnergy::all() as $eau_chaude_energy)
                                                        @if(isset($dataTypeContent->eau_chaude_energy) && $dataTypeContent->eau_chaude_energy == $eau_chaude_energy->reference){{ $eau_chaude_energy->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Eau usées
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" span="usees_distribution">
                                                    Distribution
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\WasteDistribution::all() as $usees_distribution)
                                                        @if(isset($dataTypeContent->usees_distribution) && $dataTypeContent->usees_distribution == $usees_distribution->reference){{ $usees_distribution->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                                <!--end::Widget 14-->
                            </div>
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
                <div class="col-xl-6">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Divers
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="divers_format">
                                                    Minergie
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Minergie::all() as $divers_format)
                                                        @if(isset($dataTypeContent->divers_format) && $dataTypeContent->divers_format == $divers_format->reference){{ $divers_format->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="sonority">
                                                    Sonorité
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Sonority::all() as $sonority)
                                                        @if(isset($dataTypeContent->sonority) && $dataTypeContent->sonority == $sonority->reference){{ $sonority->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="style">
                                                    Style
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Style::all() as $style)
                                                        @if(isset($dataTypeContent->style) && $dataTypeContent->style == $style->reference){{ $style->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                        <!--end::Widget 14 Item-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                    <!--end:: Widgets/New Users-->
                </div>
            </div>
            <!--End::Info Portlet-->

            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Commodités
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="shelter">
                                                    Abri
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->shelter == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="access_disabled">
                                                    Accès pour handicapé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->access_disabled == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="water_softener">
                                                    Adoucisseur d'eau
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->water_softener == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="air_conditioning">
                                                    Air conditionné
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->air_conditioning == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="pets_welcome">
                                                    Animaux bienvenus
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->pets_welcome == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="fitted_wardrobes">
                                                    Armoires encastrées
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->fitted_wardrobes == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="private_lift">
                                                    Ascenseur privé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->private_lift == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="central_aspiration">
                                                    Aspiration centralisée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->central_aspiration == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="workshop">
                                                    Atelier
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->workshop == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="patch_panel">
                                                    Baie de brassage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->patch_panel == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="windows">
                                                    Baies vitrées
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->windows == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="bath">
                                                    Baignoire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->bath == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="balneo_bath">
                                                    Baignoire balnéo
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->balneo_bath == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="private_laundry_room">
                                                    Buanderie privée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->private_laundry_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="cafeteria">
                                                    Cafétéria
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->cafeteria == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="carnotzet">
                                                    Carnotzet
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->carnotzet == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="cave">
                                                    Cave
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->cave == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="wine_cellar">
                                                    Cave à vin
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->wine_cellar == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="cellar">
                                                    Cellier
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->cellar == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="fireplace">
                                                    Cheminée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->fireplace == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Climatisation
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->air_conditioner == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="removable_partitions">
                                                    Cloisons amovibles
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->removable_partitions == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="addiction">
                                                    Dépendance
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->addiction == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="automation">
                                                    Domotique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->automation == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="double_glazing">
                                                    Double vitrage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->double_glazing == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="shower">
                                                    Douche
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->shower == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="dressing">
                                                    Dressing
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->dressing == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="automatic_fire_extinguisher">
                                                    Extincteur automatique à eau
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->automatic_fire_extinguisher == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="false_ceiling">
                                                    Faux plafond
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->false_ceiling == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="optical_fiber">
                                                    Fibre optique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->optical_fiber == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="attic">
                                                    Grenier
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->attic == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="generator">
                                                    Groupe électrogène
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->generator == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="hammam">
                                                    Hammam
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->hammam == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="high_internet">
                                                    Internet Haut Débit
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->high_internet == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="jacuzzi">
                                                    Jacuzzi
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->jacuzzi == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="winter_garden">
                                                    Jardin d'hiver
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->winter_garden == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ski_locker">
                                                    Local à ski
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->ski_locker == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="bicycle_storage">
                                                    Local à velo
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->bicycle_storage == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="loggia">
                                                    Loggia
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->loggia == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="net">
                                                    Monstiquaire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->net == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="hoist">
                                                    Monte-charge
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->hoist == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="open_plan">
                                                    Open-space
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->open_plan == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="outdoor_pool">
                                                    Piscine extérieure
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->outdoor_pool == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="indoor_pool">
                                                    Piscine intérieure
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->indoor_pool == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="ceramic_stove">
                                                    Poêle en céramique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->ceramic_stove == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="swedish_stove">
                                                    Poêle suédois
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->swedish_stove == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="loading_dock">
                                                    Quai de déchargement
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->loading_dock == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="connection_chimney">
                                                    Raccordement pour cheminée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->connection_chimney == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="connection_swedish_stove">
                                                    Raccordement pour poêle suédois
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->connection_swedish_stove == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="reception">
                                                    Réception
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->reception == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="metallic_curtain">
                                                    Rideau métallique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->metallic_curtain == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="armed_with_fire_tap">
                                                    Robinet d'incendie armé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->armed_with_fire_tap == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="do_it_yourself_room">
                                                    Salle de bricolage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->do_it_yourself_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="theater">
                                                    Salle de cinéma
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->theater == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="game_room">
                                                    Salle de jeux
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->game_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="fitness_room">
                                                    Salle fitness
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->fitness_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="conference_room">
                                                    Salle de conférence
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->conference_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="satellite">
                                                    Satellite
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->satellite == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="sauna">
                                                    Sauna
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->sauna == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="subsoil">
                                                    Sous-sol
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->subsoil == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="blinds">
                                                    Stores
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->blinds == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="electric_blinds">
                                                    Stores électriques
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->electric_blinds == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="thermostat_connected">
                                                    Thermostat connecté
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->thermostat_connected == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="triple_glazing">
                                                    Triple vitrage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->triple_glazing == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="veranda">
                                                    Véranda
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->veranda == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" nam="crawlspace">
                                                    Vide sanitaire
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->crawlspace == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="electric_shutters">
                                                    Volets roulants électriques
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->electric_shutters == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="tumble_drier">
                                                    Sèche-linge
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->tumble_drier == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="hair_dryer">
                                                    Sèche-cheveux
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->hair_dryer == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="satellite_tv">
                                                    TV Satellite
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->satellite_tv == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="phone">
                                                    Téléphone
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->phone == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="car_shelter">
                                                    Abri de voiture
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->car_shelter == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="spray">
                                                    Arrosage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->spray == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="barbecue">
                                                    Barbecue
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->barbecue == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="exterior_lighting">
                                                    Eclairage extérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->exterior_lighting == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="drilling">
                                                    Forage
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->drilling == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="heliport">
                                                    Héliport
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->heliport == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="well">
                                                    Puits
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->well == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="source">
                                                    Source
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->source == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="collective_lift">
                                                    Ascenseur collectif
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->collective_lift == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="communal_laundry_room">
                                                    Buanderie collective
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->communal_laundry_room == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="network_cabling">
                                                    Câblage réseau
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->network_cabling == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="collective_optical_fiber">
                                                    Fibre optique collective
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->collective_optical_fiber == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="parable">
                                                    Parabole
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->parable == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="alarm">
                                                    Alamre
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->alarm == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="magnetic_card">
                                                    Carte magnétique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->magnetic_card == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="fenced">
                                                    Clôturé
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->fenced == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="safe">
                                                    Coffre-fort
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->safe == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="digidode">
                                                    DigiCode
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->digidode == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="guardian">
                                                    Gardien
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->guardian == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="caretaker">
                                                    Gardien d'immeuble
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->caretaker == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="intercom">
                                                    Interphone
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->intercom == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="electric_gate">
                                                    Portail électrique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->electric_gate == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="reinforced_door">
                                                    Porte blindée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->reinforced_door == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="videophone">
                                                    Vidéophone
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->videophone == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Vue
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="clear">
                                                    Dégagée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->clear == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="impregnable">
                                                    Imprenable
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->impregnable == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="panoramics">
                                                    Panoramique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->panoramic == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="courtyard">
                                                    Sur cour
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->courtyard == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_countryside">
                                                    Sur la campagne
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_countryside == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_forest">
                                                    Sur la forêt
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_forest == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_sea">
                                                    Sur la mer
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_sea == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_pool">
                                                    Sur la piscine
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_pool == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_river">
                                                    Sur la rivière
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_river == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_street">
                                                    Sur la rue
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_street == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_city">
                                                    Sur la ville
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_city == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_garden">
                                                    Sur le jardin
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_garden == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_lake">
                                                    Sur le lac
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_lake == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_park">
                                                    Sur le parc
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_park == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_haven">
                                                    Sur le port
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_haven == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_hills">
                                                    Sur les collines
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_hills == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_mountains">
                                                    Sur les montagnes
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_mountains == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="on_ski_slopes">
                                                    Sur les piste de ski
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_ski_slopes == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="vis_a_vis">
                                                    Vis-à-vis
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->vis_a_vis == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end::Widget 14-->
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-6">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Etat
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="interior_condition">
                                                    Etat intérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                        @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ $state_front->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="type_construction">
                                                    Type de construction
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\Construction::all() as $type_construction)
                                                        @if(isset($dataTypeContent->type_construction) && $dataTypeContent->type_construction == $type_construction->reference){{ $type_construction->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="state_front">
                                                    Etat de la façade
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                        @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ $state_front->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="external_state">
                                                    Etat extérieur
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                        @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ $state_front->value }}@endif
                                                    @endforeach
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="year_construction">
                                                    Année de construction
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->year_construction }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="year_renovation">
                                                    Année de rénovation
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->year_renovation }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        Exposition
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="m-portlet__body">
                            <!--begin::Widget 14-->
                            <div class="m-widget4">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="nord">
                                                    Nord
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->nord == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="south">
                                                    Sud
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->south == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="est">
                                                    Est
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->est == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="west">
                                                    Ouest
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->west == 0) ? 'no' : 'yes' }}
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
    </div>
@stop

@section('javascript')
    <script src="{{ asset('assets/plugins/js/slick.min.js') }}" type="text/javascript"></script>
    <script>
        $('.object_gallery').slick({
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            slidesToShow: 1,
            adaptiveHeight: true,
            prevArrow: '<button type="button" class="slick-prev"><i class="la la-angle-left"></i></button>',
            nextArrow: '<button type="button" class="slick-next"><i class="la la-angle-right"></i></button>'
        });

        /*
        ** Hide Elements
         */
        var category = $('span[cat_id]').attr('cat_id');
        console.log(category);

        var fields = [
            { id: 1, field: $('span[name="heating_loads"]') },
            { id: 2, field: $('span[name="ppe_charges"]') },
            { id: 3, field: $('span[name="condominium_fees"]') },
            { id: 4, field: $('span[name="property_tax"]') },
            { id: 5, field: $('span[name="taxes_1"]') },
            { id: 6, field: $('span[name="rental_security"]') },
            { id: 7, field: $('span[name="commercial_property"]') },
            { id: 8, field: $('span[name="number_rooms"]') },
            { id: 9, field: $('span[name="number_pieces"]') },
            { id: 10, field: $('span[name="number_balconies"]') },
            { id: 11, field: $('span[name="number_shower_rooms"]') },
            { id: 12, field: $('span[name="number_toilets"]') },
            { id: 13, field: $('span[name="number_terraces"]') },
            { id: 14, field: $('span[name="number_floors_building"]') },
            { id: 15, field: $('span[name="floor_property"]') },
            { id: 16, field: $('span[name="levels"]') },
            { id: 17, field: $('span[name="surface_cellar"]') },
            { id: 18, field: $('span[name="surface_cellar_child"]') },// вместе
            { id: 19, field: $('span[name="ceiling_height"]') },
            { id: 20, field: $('span[name="roof_cover_area"]') },
            { id: 21, field: $('span[name="roof_cover_area_child"]') },
            { id: 22, field: $('span[name="surf_area_terr_solar"]') },
            { id: 23, field: $('span[name="surf_area_terr_solar_child"]') },
            { id: 24, field: $('span[name="area_veranda"]') },
            { id: 25, field: $('span[name="area_veranda_child"]') },
            { id: 26, field: $('span[name="attic_space"]') },
            { id: 27, field: $('span[name="attic_space_child"]') },
            { id: 28, field: $('span[name="surface_balcony"]') },
            { id: 29, field: $('span[name="surface_balcony_child"]') },
            { id: 30, field: $('span[name="basement_area"]') },
            { id: 31, field: $('span[name="basement_area_child"]') },
            { id: 32, field: $('span[name="surface_ground"]') },
            { id: 33, field: $('span[name="ground_length"]') },
            { id: 34, field: $('span[name="ground_width"]') },
            { id: 35, field: $('span[name="serviced"]') },
            { id: 36, field: $('span[name="type_land"]') },
            { id: 37, field: $('span[name="useful_surface"]') },
            { id: 38, field: $('span[name="ppe_area"]') },
            { id: 39, field: $('span[name="volume"]') },
            { id: 40, field: $('span[name="surface_eng_court"]') },
            { id: 41, field: $('span[name="surface_eng_court_child"]') },
            { id: 42, field: $('span[name="lower_ground_floor"]') },
            { id: 43, field: $('span[name="lower_ground_floor_child"]') },
            { id: 44, field: $('span[name="row_area"]') },
            { id: 45, field: $('span[name="garage_area"]') },
            { id: 46, field: $('span[name="weighted_surface"]') },
            { id: 47, field: $('span[name="box_interior_garage"]') },
            { id: 48, field: $('span[name="box_gar_inter_doub"]') },
            { id: 49, field: $('span[name="outdoor_garage"]') },
            { id: 50, field: $('span[name="box_garage_outside_double"]') },
            { id: 51, field: $('span[name="covered_outdoor_parking_space"]') },
            { id: 52, field: $('span[name="outside_parking_space_uncovered"]') },
            { id: 53, field: $('span[name="number_parking_spaces"]') },
            { id: 54, field: $('span[name="boat_shed"]') },
            { id: 55, field: $('span[name="mooring"]') },
            { id: 56, field: $('span[name="type"]') },
            { id: 57, field: $('span[name="freezer"]') },
            { id: 58, field: $('span[name="cooker"]') },
            { id: 59, field: $('span[name="oven"]') },
            { id: 60, field: $('span[name="microwave_oven"]') },
            { id: 61, field: $('span[name="extractor_hood"]') },
            { id: 62, field: $('span[name="washmachine"]') },
            { id: 63, field: $('span[name="dishwasher"]') },
            { id: 64, field: $('span[name="plates"]') },
            { id: 65, field: $('span[name="induction_plates"]') },
            { id: 66, field: $('span[name="hotplates"]') },
            { id: 67, field: $('span[name="ceramic_plates"]') },
            { id: 68, field: $('span[name="fridge"]') },
            { id: 69, field: $('span[name="cuisine_tumble_drier"]') },
            { id: 70, field: $('span[name="coffee_maker"]') },
            { id: 71, field: $('span[name="format"]') },
            { id: 72, field: $('span[name="chauffage_energy"]') },
            { id: 73, field: $('span[name="type_heating"]') },
            { id: 74, field: $('span[name="type_radiator"]') },
            { id: 75, field: $('span[name="distribution"]') },
            { id: 76, field: $('span[name="eau_chaude_energy"]') },
            { id: 77, field: $('span[name="usees_distribution"]') },
            { id: 78, field: $('span[name="divers_format"]') },
            { id: 79, field: $('span[name="sonority"]') },
            { id: 80, field: $('span[name="style"]') },
            { id: 81, field: $('span[name="shelter"]') },
            { id: 82, field: $('span[name="access_disabled"]') },
            { id: 83, field: $('span[name="water_softener"]') },
            { id: 84, field: $('span[name="air_conditioning"]') },
            { id: 85, field: $('span[name="pets_welcome"]') },
            { id: 86, field: $('span[name="fitted_wardrobes"]') },
            { id: 87, field: $('span[name="private_lift"]') },
            { id: 88, field: $('span[name="central_aspiration"]') },
            { id: 89, field: $('span[name="workshop"]') },
            { id: 90, field: $('span[name="patch_panel"]') },
            { id: 91, field: $('span[name="windows"]') },
            { id: 92, field: $('span[name="bath"]') },
            { id: 93, field: $('span[name="balneo_bath"]') },
            { id: 94, field: $('span[name="private_laundry_room"]') },
            { id: 95, field: $('span[name="cafeteria"]') },
            { id: 96, field: $('span[name="carnotzet"]') },
            { id: 97, field: $('span[name="cave"]') },
            { id: 98, field: $('span[name="wine_cellar"]') },
            { id: 99, field: $('span[name="cellar"]') },
            { id: 100, field: $('span[name="fireplace"]') },
            { id: 101, field: $('span[name="removable_partitions"]') },
            { id: 102, field: $('span[name="addiction"]') },
            { id: 103, field: $('span[name="automation"]') },
            { id: 104, field: $('span[name="double_glazing"]') },
            { id: 105, field: $('span[name="shower"]') },
            { id: 106, field: $('span[name="dressing"]') },
            { id: 107, field: $('span[name="automatic_fire_extinguisher"]') },
            { id: 108, field: $('span[name="false_ceiling"]') },
            { id: 109, field: $('span[name="optical_fiber"]') },
            { id: 110, field: $('span[name="attic"]') },
            { id: 111, field: $('span[name="generator"]') },
            { id: 112, field: $('span[name="hammam"]') },
            { id: 113, field: $('span[name="high_internet"]') },
            { id: 114, field: $('span[name="jacuzzi"]') },
            { id: 115, field: $('span[name="winter_garden"]') },
            { id: 116, field: $('span[name="ski_locker"]') },
            { id: 117, field: $('span[name="bicycle_storage"]') },
            { id: 118, field: $('span[name="loggia"]') },
            { id: 119, field: $('span[name="net"]') },
            { id: 120, field: $('span[name="hoist"]') },
            { id: 121, field: $('span[name="open_plan"]') },
            { id: 122, field: $('span[name="outdoor_pool"]') },
            { id: 123, field: $('span[name="indoor_pool"]') },
            { id: 124, field: $('span[name="ceramic_stove"]') },
            { id: 125, field: $('span[name="swedish_stove"]') },
            { id: 126, field: $('span[name="loading_dock"]') },
            { id: 127, field: $('span[name="connection_chimney"]') },
        ]
        var categories = [
            { id: 1, name: 'Maison', fields: [4,7,14,15,35,38,101,120,121,126,129,159,160,161,162,163,196] },
            { id: 2, name: 'Appartement', fields: [4,7,15,35,101,120,121,126,129,155,195] },
            { id: 3, name: 'Terrain constructible', fields: [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199] },
            { id: 4, name: 'Terrain non-constructible', fields: [1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199] },
            { id: 5, name: 'Surface commerciale', fields: [4,15,16,116,35,102,106,195,197] },
            { id: 6, name: 'Immeuble', fields: [4,6,8,9,10,11,12,13,16,17,18,22,23,24,25,26,27,28,29,35,46,87,89,96,98,99,102,106,115,118,119,121,124,125,127,128,132,134,135,136,138,197] },
            { id: 7, name: 'Stationnement', fields: [1,2,3,4,5,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,33,34,35,36,37,38,39,40,41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62,63,64,65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,91,92,93,94,95,96,97,98,99,100,101,102,103,104,105,106,107,108,109,110,111,112,113,114,115,116,117,118,119,120,121,122,123,124,125,126,127,128,129,130,131,132,133,134,135,136,137,138,139,140,141,142,143,144,145,146,147,148,149,150,151,152,153,154,155,156,157,158,159,160,161,162,163,164,165,166,167,168,169,170,171,172,173,174,175,176,177,178,179,180,181,182,183,184,185,186,187,188,189,190,191,192,193,194,195,196,197,198,199,200,201,202,203] },
            { id: 8, name: 'Autre', fields: [4,20,21,35,102,197] }
        ];

        function hideElements(category_id) {

            // Стилизуем только необходимые
            $.each(categories, function () {
                var category = this;

                if (category.id === parseInt(category_id)) {
                    for (var i = 0; i < category.fields.length; i++) {
                        $.each(fields, function () {
                            if (this.id === category.fields[i]) {
                                this.field.parent().parent().parent().css('display','none');
                            }
                        })
                    }
                }
            })

        }

        hideElements(category);

    </script>
    @if ($isModelTranslatable)
        <script>
            $(document).ready(function () {
                $('.side-body').multilingual();
            });
        </script>
        <script src="{{ voyager_asset('js/multilingual.js') }}"></script>
    @endif
@stop
