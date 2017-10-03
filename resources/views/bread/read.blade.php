@extends('voyager::master_metronic')

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
    <div class="page-content read container-fluid" style="padding-top: 30px; padding-bottom: 60px;">
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

    <div class="m-grid__item m-grid__item--fluid m-wrapper" style="display: none">
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
                                        <div><img src="/assets/house_invest_spain/img/house.jpeg" alt=""></div>
                                        <div><img src="/assets/house_invest_spain/img/house2.jpeg" alt=""></div>
                                        <div><img src="/assets/house_invest_spain/img/house3.jpeg" alt=""></div>
                                    </div>
                                    <h3 class="m-widget19__title m--font-light">
                                        Title of the object
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
                                                Anna Krox
                                            </span>
                                            <br>
                                            <span class="m-widget19__time">
                                                Admin, who posted this object
                                            </span>
                                        </div>
                                        <div class="m-widget19__stats object_price">
                                            <span class="m-widget19__number m--font-brand">
                                               CHF 180.000
                                            </span>
                                            <span class="m-widget19__comment">
                                                Price comments
                                            </span>
                                        </div>
                                    </div>
                                    <div class="m-widget19__body">
                                        This is description text: Lorem Ipsum is simply dummy text of the printing and typesetting industry scrambled it to make text of the printing and typesetting industry scrambled a type specimen book text of the dummy text of the printing printing and typesetting industry scrambled dummy text of the printing.
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
                                                    Exclusivité
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
                                                    Sous-catégorie
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
                                                    Notation
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
                                                    Courtier
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
                                                    Mandat
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
                                                    Origine
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
                                                    Début du mandat
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
                                                    Fin du mandat
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
                                                    Disponibilité
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
                                                    Disponibilité à partir du
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
                                                    Disponibilité jusqu'au
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
                                                    Promotion
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
                                                    Transaction directe
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
                                                    Note sur la transaction
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
                                                    Note courtier
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
                                                    Remarques importantes
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
                                                    Notes pour le propriétaire
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
            <!--End::Main Portlet-->


            <!--Begin::Info Portlet-->
            <div class="row">
                <div class="col-xl-4">
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
                                                    Rue
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
                                                    N°
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
                                                    Case postale
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
                                                    Code postale
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
                                                    Ville
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
                                                    Pays
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
                                                    Localisation
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
                <div class="col-xl-4">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        General
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (checkbox)
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
                <div class="col-xl-4">
                    <!--begin:: Widgets/New Users-->
                    <div class="m-portlet m-portlet--full-height">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
                                    <h3 class="m-portlet__head-text">
                                        General
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (dropdown)
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
                                                    Parameter (checkbox)
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
