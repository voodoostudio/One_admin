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
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Objects
                        </span>
                    </a>
                </li>
                <li class="m-nav__separator">-</li>
                <li class="m-nav__item">
                    <a href="" class="m-nav__link">
                        <span class="m-nav__link-text">
                            Object ID
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
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
                                    @foreach(TCG\Voyager\Models\User::all() as $user)
                                        <img class="m-widget19__img" src="../../storage/{{ ($dataTypeContent->author_id == $user->id) ? $user->avatar : '' }}" alt="User avatar">
                                    @endforeach
                                </div>
                                <div class="m-widget19__info">
                                    <span class="m-widget19__username">
                                        @foreach(TCG\Voyager\Models\User::all() as $user)
                                            {{ ($dataTypeContent->author_id == $user->role_id) ? $user->name : ''  }}
                                        @endforeach
                                    </span>
                                </div>
                                <div class="m-widget19__stats object_price">
                                    <span class="m-widget19__number m--font-brand">
                                        @if($dataTypeContent->show_price != 0)
                                            {{ ($dataTypeContent->price != null) ? $dataTypeContent->price : 'None' }}
                                        @endif
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
                            @if($dataTypeContent->id != null)
                                <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Référence
                                            </span>
                                            <span class="m-widget4__sub">
                                                {{--{{ $dataTypeContent->reference }}--}}
                                                {{  'HIS-' . str_pad($dataTypeContent->id , 4, '0', STR_PAD_LEFT) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Exclusivité
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ ($dataTypeContent->exclusiveness == 0) ? 'None' : 'Yes' }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Catégorie
                                        </span>
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
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Sous-catégorie
                                        </span>
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
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Notation
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->notation }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Courtier
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\User::all() as $user)
                                                {{ ($dataTypeContent->author_id == $user->role_id) ? $user->name : ''  }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Statut
                                            </span>
                                        <span class="m-widget4__sub">
                                                @foreach(TCG\Voyager\Models\Status::all() as $status)
                                                @if(isset($dataTypeContent->status_id) && $dataTypeContent->status_id == $status->reference){{ $status->value }}@endif
                                            @endforeach
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Mandat
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Mandate::all() as $mandate)
                                                @if(isset($dataTypeContent->mandate_id) && $dataTypeContent->mandate_id == $mandate->reference){{ $mandate->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Origine <!-- todo -->
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Origin::all() as $origin)
                                                @if(isset($dataTypeContent->origin_id) && $dataTypeContent->origin_id == $origin->reference){{ $origin->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Début du mandat
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->mandate_start }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Fin du mandat
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->term_end }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>

                            @if($dataTypeContent->ann_type != 0)
                                <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                    <!--begin::Widget 14 Item-->
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Disponibilité
                                            </span>
                                            <span class="m-widget4__sub">
                                                {{ $dataTypeContent->availability }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Widget 14 Item-->
                                </div>
                            @endif
                            <div class="param_container col-sm-12 col-md-6 col-xl-12" style="display: {{ ($dataTypeContent->ann_type == 1) ? 'none' : '' }}">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Disponibilité à partir du
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->availab_from }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            @if($dataTypeContent->ann_type != 1)
                                <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                    <!--begin::Widget 14 Item-->
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Disponibilité jusqu'au
                                            </span>
                                            <span class="m-widget4__sub">
                                                {{ $dataTypeContent->availab_until }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--end::Widget 14 Item-->
                                </div>
                            @endif
                            <div class="param_container col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Promotion
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ ($dataTypeContent->promotion == 0) ? 'Non' : 'Oui' }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Transaction directe
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ ($dataTypeContent->direct_transaction == 0) ? 'Non' : 'Oui' }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Note sur la transaction
                                        </span>
                                        <span class="m-widget4__sub">
                                             {{ $dataTypeContent->note_transaction }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Note courtier
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->broker_notes }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Remarques importantes
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->important_notes }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Notes pour le propriétaire
                                        </span>
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
        <div class="col-xl-12">
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
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Adresse
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->address }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Rue
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->street }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                N°
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->number }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Case postale
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->po_box }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Code postale
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->zip_code }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title">
                                                Ville
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->town }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Pays
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->country }}
                                            {{--@foreach(TCG\Voyager\Models\Country::all() as $country)--}}
                                            {{--@if(isset($dataTypeContent->country) && $dataTypeContent->country == $country->reference){{ $country->value }}@endif--}}
                                            {{--@endforeach--}}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Localisation <!-- todo -->
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{--{{ $dataTypeContent->location }}--}}
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
        <div class="col-xl-4" style="display: none">
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
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Langue de l'annonce
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Languages::all() as $lng_of_add)
                                                @if(isset($dataTypeContent->lng_of_add) && $dataTypeContent->lng_of_add == $lng_of_add->reference){{ $lng_of_add->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Titre de l'annonce
                                        </span>
                                        <span class="m-widget4__sub">
                                            Value
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-12">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Description de l'annonce
                                        </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Devise
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Currency::all() as $сurrency)
                                                {{ ($dataTypeContent->сurrency == $сurrency->reference) ? $сurrency->value : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Prix
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->price }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Prix au m2
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->price_m2 }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Rendement brut
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->gross_yield }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Rendement net
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->net_return }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Montant propriétaire
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->owner_amount }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Honoraire client
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->client_fees }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Honoraire propriétaire
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->owner_fees }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Montant négociable
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->negotiable_amount }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Montant estimé
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->estimate_price }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Droits d'enregistremenet
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->recording_rights }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Régime
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Regime::all() as $regime)
                                                @if(isset($dataTypeContent->regime) && $dataTypeContent->regime == $regime->reference){{ $regime->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="heating_loads">
                                            Charges de chauffage
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->heating_loads }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ppe_charges">
                                            Charges PPE
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->ppe_charges }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="condominium_fees">
                                            Charges de copropriété
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->condominium_fees }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="property_tax">
                                            Taxe foncière
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->property_tax }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Procédure en cours auprès de la copro.
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ ($dataTypeContent->procedure_in_progress == 0) ? '&#10006;' : '	&#10004;' }}
                                            {{--<input type="checkbox" value="{{ ($dataTypeContent->procedure_in_progress != 0) ? '' : 'on' }}">--}}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Fonds de rénovation
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->renovation_fund }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Charges annuelles
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->annual_charges }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="taxes_1">
                                            Taxe d'habitation
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->taxes_1 }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="rental_security">
                                            Caution locative
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->rental_security }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="commercial_property">
                                            Fonds de commerce
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->commercial_property }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Revenus
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->earnings }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Impôts
                                        </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_rooms">
                                            Nombre de chambres
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_rooms }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_pieces">
                                            Nombre de pièces
                                        </span>
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
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_shower_rooms + $dataTypeContent->number_toilets }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_balconies">
                                            Nombre de balcons
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_balconies }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_shower_rooms">
                                            Nombre de salles de douche
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_shower_rooms }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_toilets">
                                            Nombre de WC
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_toilets }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_terraces">
                                            Nombre de terasses
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_terraces }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="number_floors_building">
                                            Nombre d'étage du bâtiment
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->number_floors_building }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="floor_property">
                                            Etage du bien
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\Floor::all() as $floor_property)
                                                @if(isset($dataTypeContent->floor_property) && $dataTypeContent->floor_property == $floor_property->reference){{ $floor_property->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="levels">
                                            Niveaux
                                        </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="surface_cellar">
                                            Surface de la cave
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->surface_cellar }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ceiling_height">
                                            Hauteur des plafonds
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->ceiling_height }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="roof_cover_area">
                                            Surface de l'abri de la toiture
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->roof_cover_area }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="surf_area_terr_solar">
                                            Surface de la terrasse / solarium
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->surf_area_terr_solar }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="area_veranda">
                                            Surface de la véranda
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->area_veranda }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="attic_space">
                                            Surface des combles
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->attic_space }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="surface_balcony">
                                            Surface du balcon
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->surface_balcony }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="basement_area">
                                            Surface du sous-sol
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->basement_area }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="surface_ground">
                                            Surface du terrain
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->surface_ground }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ground">
                                            Terrain
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->ground_length * $dataTypeContent->ground_width }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="serviced">
                                            Viabilisé
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ ($dataTypeContent->serviced == 0) ? '&#10006;' : '&#10004;' }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="type_land">
                                            Type de terrain
                                        </span>
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\TypeOfLand::all() as $type_land)
                                                @if(isset($dataTypeContent->type_land) && $dataTypeContent->type_land == $type_land->reference){{ $type_land->value }}@endif
                                            @endforeach
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="useful_surface">
                                            Surface utille
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->useful_surface }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ppe_area">
                                            Surface PPE
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->ppe_area }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="volume">
                                            Volume
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->volume }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="surface_eng_court">
                                            Surface de la cour anglaise
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->surface_eng_court }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="lower_ground_floor">
                                            Surface rez-de-chaussée inférieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->lower_ground_floor }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="row_area">
                                            Surface de l'emprise
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->row_area }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="garage_area">
                                            Surface du garage
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->garage_area }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="weighted_surface">
                                            Surface pondérée
                                        </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="box_interior_garage">
                                            Box/garage intérieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->box_interior_garage }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="box_gar_inter_doub">
                                            Box/garage double intérieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->box_gar_inter_doub }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="outdoor_garage">
                                            Box/garage extérieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->outdoor_garage }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="box_garage_outside_double">
                                            Box/garage double extérieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->box_garage_outside_double }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="covered_outdoor_parking_space">
                                            Place de parc extérieure couverte
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->covered_outdoor_parking_space }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="outside_parking_space_uncovered">
                                            Place de parc extérieur non-couverte
                                        </span>
                                        <span class="m-widget4__sub">
                                            {{ $dataTypeContent->outside_parking_space_uncovered }}
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="number_parking_spaces">
                                                Nombre de places de parc
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->number_parking_spaces }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="boat_shed">
                                                Hangar à bateau
                                            </span>
                                        <span class="m-widget4__sub">
                                                {{ $dataTypeContent->boat_shed }}
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="mooring">
                                                Place d'amarrage
                                            </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="type">
                                                Type
                                            </span>
                                        <span class="m-widget4__sub">
                                                @foreach(TCG\Voyager\Models\Kitchen::all() as $type)
                                                @if(isset($dataTypeContent->type) && $dataTypeContent->type == $type->reference){{ $type->value }}@endif
                                            @endforeach
                                            </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->freezer == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="freezer">
                                            Congélateur
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->freezer != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->cooker == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="cooker">
                                            Cusinière
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->cooker != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->oven == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="oven">
                                            Four
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->oven != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_lake == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="microwave_oven">
                                            Four à micro-ondes
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->microwave_oven != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->extractor_hood == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="extractor_hood">
                                            Hotte aspirante
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->extractor_hood != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->washmachine == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="washmachine">
                                            Lave-linge
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->washmachine != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->dishwasher == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="dishwasher">
                                            Lave-vaiselle
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->dishwasher != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->plates == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="plates">
                                            Plaques à gaz
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->plates != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->induction_plates == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="induction_plates">
                                            Plaques à induction
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->induction_plates != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->hotplates == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="hotplates">
                                            Plaques électriques
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->hotplates != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->ceramic_plates == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ceramic_plates">
                                            Plaques vitrocéram
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->ceramic_plates != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->fridge == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="fridge">
                                            Réfrigérateur
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->fridge != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->cuisine_tumble_drier == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="cuisine_tumble_drier">
                                            Sèche-linge
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->cuisine_tumble_drier != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <!--end::Widget 14 Item-->
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->coffee_maker == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="coffee_maker">
                                            Cafetière
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->coffee_maker != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
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
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="format">
                                                Format
                                            </span>
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
                                            <span class="m-widget4__title" name="chauffage_energy">
                                                Energie
                                            </span>
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
                                            <span class="m-widget4__title" name="type_heating">
                                                Type de chauffage
                                            </span>
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
                                            <span class="m-widget4__title" name="type_radiator">
                                                Type de radiateur
                                            </span>
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
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-6">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="distribution">
                                                Distribution
                                            </span>
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
                                        <span class="m-widget4__sub">
                                                @foreach(TCG\Voyager\Models\WasteDistribution::all() as $usees_distribution)
                                                @if($dataTypeContent->usees_distribution == $usees_distribution->reference){{ $usees_distribution->value }}@endif
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
                                <div class="m-widget4__item {{ ($dataTypeContent->shelter == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="shelter">
                                            Abri
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->shelter != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->access_disabled == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="access_disabled">
                                                Accès pour handicapé
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->access_disabled != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->water_softener == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="water_softener">
                                                Adoucisseur d'eau
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->water_softener != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->air_conditioning == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="air_conditioning">
                                                Air conditionné
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->air_conditioning != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->pets_welcome == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="pets_welcome">
                                            Animaux bienvenus
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->pets_welcome != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->fitted_wardrobes == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="fitted_wardrobes">
                                            Armoires encastrées
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->fitted_wardrobes != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->private_lift == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="private_lift">
                                                Ascenseur privé
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->private_lift != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->central_aspiration == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="central_aspiration">
                                                Aspiration centralisée
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->central_aspiration != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->workshop == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="workshop">
                                            Atelier
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->workshop != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->patch_panel == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="patch_panel">
                                            Baie de brassage
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->patch_panel != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->windows == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="windows">
                                            Baies vitrées
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->windows != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->bath == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="bath">
                                            Baignoire
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->bath != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->balneo_bath == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="balneo_bath">
                                            Baignoire balnéo
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->balneo_bath != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->private_laundry_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="private_laundry_room">
                                            Buanderie privée
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->private_laundry_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->cafeteria == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="cafeteria">
                                            Cafétéria
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->cafeteria != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->carnotzet == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="carnotzet">
                                            Carnotzet
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->carnotzet != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->cave == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="cave">
                                            Cave
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->cave != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->wine_cellar == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="wine_cellar">
                                            Cave à vin
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->wine_cellar != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->cellar == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="cellar">
                                            Cellier
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->cellar != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->fireplace == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="fireplace">
                                            Cheminée
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->fireplace != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->air_conditioner == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            Climatisation
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->air_conditioner != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->removable_partitions == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="removable_partitions">
                                            Cloisons amovibles
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->removable_partitions != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->addiction == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="addiction">
                                            Dépendance
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->addiction != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->automation == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="automation">
                                            Domotique
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->automation != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->double_glazing == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="double_glazing">
                                            Double vitrage
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->double_glazing != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->shower == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="shower">
                                            Douche
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->shower != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->dressing == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="dressing">
                                            Dressing
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->dressing != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->automatic_fire_extinguisher == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="automatic_fire_extinguisher">
                                            Extincteur automatique à eau
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->automatic_fire_extinguisher != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->false_ceiling == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="false_ceiling">
                                            Faux plafond
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->false_ceiling != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->optical_fiber == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="optical_fiber">
                                            Fibre optique
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->optical_fiber != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->attic == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="attic">
                                            Grenier
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->attic != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->generator == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="generator">
                                            Groupe électrogène
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->generator != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->hammam == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="hammam">
                                            Hammam
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->hammam != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->high_internet == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="high_internet">
                                            Internet Haut Débit
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->high_internet != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->jacuzzi == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="jacuzzi">
                                            Jacuzzi
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->jacuzzi != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->winter_garden == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="winter_garden">
                                            Jardin d'hiver
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->winter_garden != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->ski_locker == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="ski_locker">
                                            Local à ski
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->ski_locker != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->bicycle_storage == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="bicycle_storage">
                                            Local à velo
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->bicycle_storage != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->loggia == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="loggia">
                                            Loggia
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->loggia != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->net == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="net">
                                            Monstiquaire
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->net != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->hoist == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="hoist">
                                                Monte-charge
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->hoist != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->open_plan == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="open_plan">
                                            Open-space
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->open_plan != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->outdoor_pool == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="outdoor_pool">
                                            Piscine extérieure
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->outdoor_pool != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->indoor_pool == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="indoor_pool">
                                                Piscine intérieure
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->indoor_pool != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->ceramic_stove == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="ceramic_stove">
                                                Poêle en céramique
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->ceramic_stove != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->clear == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="swedish_stove">
                                                Poêle suédois
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->clear != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_lake == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="loading_dock">
                                                Quai de déchargement
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->loading_dock != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->connection_chimney == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="connection_chimney">
                                                Raccordement pour cheminée
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->connection_chimney != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->connection_swedish_stove == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="connection_swedish_stove">
                                                Raccordement pour poêle suédois
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->connection_swedish_stove != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->reception == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="reception">
                                                Réception
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->reception != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->metallic_curtain == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="metallic_curtain">
                                                Rideau métallique
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->metallic_curtain != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->armed_with_fire_tap == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="armed_with_fire_tap">
                                                Robinet d'incendie armé
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->armed_with_fire_tap != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->do_it_yourself_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="do_it_yourself_room">
                                                Salle de bricolage
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->do_it_yourself_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->theater == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="theater">
                                                Salle de cinéma
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->theater != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->game_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="game_room">
                                                Salle de jeux
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->game_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->fitness_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="fitness_room">
                                                Salle fitness
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->fitness_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->conference_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="conference_room">
                                                Salle de conférence
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->conference_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->satellite == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="satellite">
                                                Satellite
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->satellite != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->sauna == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="sauna">
                                                Sauna
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->sauna != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->subsoil == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="subsoil">
                                                Sous-sol
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->subsoil != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->blinds == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="blinds">
                                                Stores
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->blinds != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->electric_blinds == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="electric_blinds">
                                                Stores électriques
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->electric_blinds != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                            </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->thermostat_connected == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="thermostat_connected">
                                            Thermostat connecté
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->thermostat_connected != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->triple_glazing == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="triple_glazing">
                                            Triple vitrage
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->triple_glazing != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->veranda == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="veranda">
                                            Véranda
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->veranda != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->crawlspace == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" nam="crawlspace">
                                            Vide sanitaire
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->crawlspace != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->electric_shutters == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="electric_shutters">
                                            Volets roulants électriques
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->electric_shutters != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->tumble_drier == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="tumble_drier">
                                            Sèche-linge
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->tumble_drier != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->hair_dryer == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="hair_dryer">
                                            Sèche-cheveux
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->hair_dryer != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->satellite_tv == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="satellite_tv">
                                            TV Satellite
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->satellite_tv != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->phone == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="phone">
                                            Téléphone
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->phone != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->car_shelter == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="car_shelter">
                                            Abri de voiture
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->car_shelter != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->spray == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="spray">
                                            Arrosage
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->spray != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->barbecue == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="barbecue">
                                            Barbecue
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->barbecue != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->exterior_lighting == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="exterior_lighting">
                                            Eclairage extérieur
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->exterior_lighting != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->drilling == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="drilling">
                                            Forage
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->drilling != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->heliport == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="heliport">
                                            Héliport
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->heliport != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->well == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="well">
                                            Puits
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->well != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->source == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="source">
                                            Source
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->source != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->collective_lift == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="collective_lift">
                                            Ascenseur collectif
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->collective_lift != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->communal_laundry_room == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="communal_laundry_room">
                                            Buanderie collective
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->communal_laundry_room != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->network_cabling == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="network_cabling">
                                            Câblage réseau
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->network_cabling != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->collective_optical_fiber == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="collective_optical_fiber">
                                            Fibre optique collective
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->collective_optical_fiber != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->parable == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="parable">
                                            Parabole
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->parable != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->alarm == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="alarm">
                                            Alamre
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->alarm != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->magnetic_card == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="magnetic_card">
                                            Carte magnétique
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->magnetic_card != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->fenced == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="fenced">
                                            Clôturé
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->fenced != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->safe == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="safe">
                                            Coffre-fort
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->safe != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->digidode == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="digidode">
                                            DigiCode
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->digidode != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->guardian == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="guardian">
                                            Gardien
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->guardian != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->caretaker == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="caretaker">
                                            Gardien d'immeuble
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->caretaker != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->intercom == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="intercom">
                                            Interphone
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->intercom != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->electric_gate == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="electric_gate">
                                            Portail électrique
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->electric_gate != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->reinforced_door == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="reinforced_door">
                                            Porte blindée
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->reinforced_door != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->videophone == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="videophone">
                                            Vidéophone
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->videophone != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
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
                                <div class="m-widget4__item {{ ($dataTypeContent->clear == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="clear">
                                            Dégagée
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->clear != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->impregnable == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="impregnable">
                                            Imprenable
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->impregnable != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->panoramic == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="panoramics">
                                            Panoramique
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->panoramic != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->courtyard == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="courtyard">
                                                Sur cour
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->courtyard != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_countryside == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="on_countryside">
                                                Sur la campagne
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_countryside != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_forest == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="on_forest">
                                                Sur la forêt
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_forest != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_sea == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="on_sea">
                                                Sur la mer
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_sea != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_pool == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="on_pool">
                                                Sur la piscine
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_pool != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_river == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="on_river">
                                                Sur la rivière
                                            </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_river != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_street == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_street">
                                            Sur la rue
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_street != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_city == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_city">
                                            Sur la ville
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_city != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_garden == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_garden">
                                            Sur le jardin
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_garden != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_lake == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_lake">
                                            Sur le lac
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_lake != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_park == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_park">
                                            Sur le parc
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_park != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_haven == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_haven">
                                            Sur le port
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_haven != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_hills == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_hills">
                                            Sur les collines
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_hills != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_mountains == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_mountains">
                                            Sur les montagnes
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_mountains != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->on_ski_slopes == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="on_ski_slopes">
                                            Sur les piste de ski
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->on_ski_slopes != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->vis_a_vis == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                                <span class="m-widget4__title" name="vis_a_vis">
                                                    Vis-à-vis
                                                </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->vis_a_vis != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
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
                            @if($dataTypeContent->state_front != null)
                                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                    <!--begin::Widget 14 Item-->
                                    <div class="m-widget4__item">
                                        <div class="m-widget4__info">
                                            <span class="m-widget4__title" name="interior_condition">
                                                Etat intérieur
                                            </span>
                                            <span class="m-widget4__sub">
                                                @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                    @if(isset($dataTypeContent->state_front) && $dataTypeContent->state_front == $state_front->reference){{ $state_front->value }}@endif
                                                @endforeach
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-4">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="type_construction">
                                            Type de construction
                                        </span>
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
                                        <span class="m-widget4__sub">
                                            @foreach(TCG\Voyager\Models\State::all() as $state_front)
                                                @if($dataTypeContent->external_state == $state_front->reference){{ $state_front->value }}@endif
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
                                <div class="m-widget4__item {{ ($dataTypeContent->nord == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="nord">
                                            Nord
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->nord != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->south == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="south">
                                            Sud
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->south != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->est == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="est">
                                            Est
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->est != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-3">
                                <!--begin::Widget 14 Item-->
                                <div class="m-widget4__item {{ ($dataTypeContent->west == 0) ? 'not_specified' : '' }}">
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title" name="west">
                                            Ouest
                                        </span>
                                        <span class="m-widget4__sub">
                                            @if($dataTypeContent->west != 0)
                                                <i class="fa fa-check"></i>
                                            @endif
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
