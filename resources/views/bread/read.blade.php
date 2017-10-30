@extends('voyager::master_metronic')

{{ dd($dataTypeContent->toArray()) }}


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
                                        <div><img src="{{ URL::to('storage') }}/{{ $dataTypeContent->image }}" alt=""></div>
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
                                                    Catégorie  <!-- todo -->
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
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
                <div class="col-xl-4">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                                <span class="m-widget4__title">
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
                <div class="col-xl-4">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                {{--<div class="col-xl-4">--}}
                    {{--<!--begin:: Widgets/New Users-->--}}
                    {{--<div class="m-portlet m-portlet--full-height">--}}
                        {{--<div class="m-portlet__head">--}}
                            {{--<div class="m-portlet__head-caption">--}}
                                {{--<div class="m-portlet__head-title">--}}
                                    {{--<h3 class="m-portlet__head-text">--}}
                                        {{--Part--}}
                                    {{--</h3>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="m-portlet__body">--}}
                            {{--<!--begin::Widget 14-->--}}
                            {{--<div class="m-widget4">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">--}}
                                        {{--<!--begin::Widget 14 Item-->--}}
                                        {{--<div class="m-widget4__item">--}}
                                            {{--<div class="m-widget4__info">--}}
                                                {{--<span class="m-widget4__title">--}}
                                                    {{--Parter--}}
                                                {{--</span>--}}
                                                {{--<br>--}}
                                                {{--<span class="m-widget4__sub">--}}
                                                    {{--value--}}
                                                {{--</span>--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<!--end::Widget 14-->--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!--end:: Widgets/New Users-->--}}
                {{--</div>--}}
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Dégagée
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->clear == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Imprenable
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->impregnable == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Panoramique
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->panoramic == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur cour
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->courtyard == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la campagne
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_countryside == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la forêt
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_forest == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la mer
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_sea == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la piscine
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_pool == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la rivière
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_river == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la rue
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_street == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur la ville
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_city == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur le jardin
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_garden == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur le lac
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_lake == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur le parc
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_park == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur le port
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_haven == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur les collines
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_hills == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur les montagnes
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_mountains == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Sur les piste de ski
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ ($dataTypeContent->on_ski_slopes == 0) ? 'no' : 'yes' }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
                                                    Année de construction
                                                </span>
                                                <br>
                                                <span class="m-widget4__sub">
                                                    {{ $dataTypeContent->year_construction }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                        <!--begin::Widget 14 Item-->
                                        <div class="m-widget4__item">
                                            <div class="m-widget4__info">
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
                                                <span class="m-widget4__title">
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
