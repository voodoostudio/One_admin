@extends('voyager::master_metronic')

@section('page_title', __('voyager.generic.viewing').' '.$dataType->display_name_plural)

@section('content')
    @php
        foreach (explode(',', Illuminate\Support\Facades\DB::table('posts')->value('vip_users')) as $users) {
            $user_id[$users] = $users;
        }
    @endphp
    @php
        $arrayJsonData = [];
        if(Illuminate\Support\Facades\Auth::user()->role_id != 5) {
            foreach ($dataTypeContent as $data) {
                if($dataType->display_name_plural == 'Posts') {
                    $reference =  'HIS-' . str_pad($data->id, 4, '0', STR_PAD_LEFT);
                    $arrayJsonData[] = [
                        'id'            => $data->id,
                        'reference'     => $reference,
                        'image'         => json_decode($data->image)[0],
                        'ann_type'      => ($data->ann_type == 0) ? 'Location' : 'Vente',
                        'category_id'   => Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $data->category_id)->value('name'),
                        'title_fr'      => $data->title_fr,
                        'zip_code'      => $data->zip_code,
                        'town'          => $data->town,
                        'price'         => $data->price,
                        'vip_users'     => $data->vip_users
                    ];
                } else {
                    foreach ($dataType->browseRows as $row) {
                        $data[$row->display_name] = $data->{$row->field};
                    }
                    $arrayJsonData[] = $data;
                }
            }
        } else {
            foreach (Illuminate\Support\Facades\DB::table('posts')->where('vip_users', 'rlike', '(^|,)' . array_search(Illuminate\Support\Facades\Auth::user()->id, $user_id) . '(,|$)')->get() as $data) {
                if($dataType->display_name_plural == 'Posts') {
                    $reference =  'HIS-' . str_pad($data->id, 4, '0', STR_PAD_LEFT);
                    $arrayJsonData[] = [
                        'id'            => $data->id,
                        'reference'     => $reference,
                        'image'         => json_decode($data->image)[0],
                        'ann_type'      => ($data->ann_type == 0) ? 'Location' : 'Vente',
                        'category_id'   => Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $data->category_id)->value('name'),
                        'title_fr'      => $data->title_fr,
                        'zip_code'      => $data->zip_code,
                        'town'          => $data->town,
                        'price'         => $data->price
                    ];
                }
            }
        }
    @endphp
    <div class="m-grid__item m-grid__item--fluid m-wrapper">
        <!-- BEGIN: Subheader -->
        <div class="m-subheader ">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">
                        {{--{{ $dataType->display_name_plural }}--}}
                        {{ $dataType->display_name_singular }}
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
                                    Datatables
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Base
                                </span>
                            </a>
                        </li>
                        <li class="m-nav__separator">
                            -
                        </li>
                        <li class="m-nav__item">
                            <a href="" class="m-nav__link">
                                <span class="m-nav__link-text">
                                    Local Data
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div style="display: none">
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
            {{--<div class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">--}}
            {{--<div class="m-alert__icon">--}}
            {{--<i class="flaticon-exclamation m--font-brand"></i>--}}
            {{--</div>--}}
            {{--<div class="m-alert__text">--}}
            {{--Here you can see list of all objects in your current admin page. Click "Add New" to add new object.--}}
            {{--</div>--}}
            {{--</div>--}}
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{--                                {{ $dataType->display_name_plural }}--}}
                                {{ $dataType->display_name_singular }}
                                {{--<small>--}}
                                {{--initialized from javascript array--}}
                                {{--</small>--}}
                            </h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools" style="display: none;">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <div class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push" data-dropdown-toggle="hover" aria-expanded="true">
                                    <a href="#" class="m-portlet__nav-link m-portlet__nav-link--icon m-portlet__nav-link--icon-xl m-dropdown__toggle">
                                        <i class="la la-plus m--hide"></i>
                                        <i class="la la-ellipsis-h m--font-brand"></i>
                                    </a>
                                    <div class="m-dropdown__wrapper">
                                        <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav">
                                                        <li class="m-nav__section m-nav__section--first">
                                                            <span class="m-nav__section-text">
                                                                Quick Actions
                                                            </span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-share"></i>
                                                                <span class="m-nav__link-text">
                                                                    Create Post
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-chat-1"></i>
                                                                <span class="m-nav__link-text">
                                                                    Send Messages
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-multimedia-2"></i>
                                                                <span class="m-nav__link-text">
                                                                    Upload File
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__section">
                                                            <span class="m-nav__section-text">
                                                                Useful Links
                                                            </span>
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
                                                        <li class="m-nav__separator m-nav__separator--fit m--hide"></li>
                                                        <li class="m-nav__item m--hide">
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
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
                                    {{--<div class="col-md-4">--}}
                                    {{--<div class="m-form__group m-form__group--inline">--}}
                                    {{--<div class="m-form__label">--}}
                                    {{--<label>--}}
                                    {{--Status:--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="m-form__control">--}}
                                    {{--<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_status">--}}
                                    {{--<option value="">--}}
                                    {{--All--}}
                                    {{--</option>--}}
                                    {{--<option value="1">--}}
                                    {{--Pending--}}
                                    {{--</option>--}}
                                    {{--<option value="2">--}}
                                    {{--Delivered--}}
                                    {{--</option>--}}
                                    {{--<option value="3">--}}
                                    {{--Canceled--}}
                                    {{--</option>--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="d-md-none m--margin-bottom-10"></div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-md-4">--}}
                                    {{--<div class="m-form__group m-form__group--inline">--}}
                                    {{--<div class="m-form__label">--}}
                                    {{--<label class="m-label m-label--single">--}}
                                    {{--Type:--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                    {{--<div class="m-form__control">--}}
                                    {{--<select class="form-control m-bootstrap-select m-bootstrap-select--solid" id="m_form_type">--}}
                                    {{--<option value="">--}}
                                    {{--All--}}
                                    {{--</option>--}}
                                    {{--<option value="1">--}}
                                    {{--Online--}}
                                    {{--</option>--}}
                                    {{--<option value="2">--}}
                                    {{--Retail--}}
                                    {{--</option>--}}
                                    {{--<option value="3">--}}
                                    {{--Direct--}}
                                    {{--</option>--}}
                                    {{--</select>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="d-md-none m--margin-bottom-10"></div>--}}
                                    {{--</div>--}}
                                    <div class="col-md-4">
                                        <div class="m-input-icon m-input-icon--left">
                                            <input type="text" class="form-control m-input m-input--solid" placeholder="Search..." id="m_form_search">
                                            <span class="m-input-icon__icon m-input-icon__icon--left">
                                                <span>
                                                    <i class="la la-search"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(Auth::user()->role_id != 5)
                                <div class="col-xl-4 order-1 order-xl-2 m--align-right">
                                    <a href="{{ route('voyager.'.$dataType->slug.'.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                                        <span>
                                            <i class="la la-cart-plus"></i>
                                            <span>
{{--                                                {{ __('voyager.generic.add_new') }}--}}
                                                Nouveau
                                            </span>
                                        </span>
                                    </a>
                                    <div class="m-separator m-separator--dashed d-xl-none"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                    <!--end: Search Form -->
                    <!--begin: Datatable -->
                    <div class="m_datatable" id="local_data"></div>
                    <!--end: Datatable -->
                </div>
            </div>
        </div>
    </div>

    {{-- Single delete modal --}}
    <div class="modal modal-danger fade" tabindex="-1" id="delete_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('voyager.generic.close') }}"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"><i class="voyager-trash"></i> {{ __('voyager.generic.delete_question') }} {{ strtolower($dataType->display_name_singular) }}?</h4>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('voyager.'.$dataType->slug.'.index') }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger pull-right delete-confirm"
                               value="{{ __('voyager.generic.delete_confirm') }} {{ strtolower($dataType->display_name_singular) }}">
                    </form>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">{{ __('voyager.generic.cancel') }}</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@stop

@section('javascript')

    <script>
        //== Class definition

        var DatatableDataLocalDemo = function () {
            //== Private functions

            // demo initializer
            var demo = function () {

                var dataJSONArray = JSON.parse('<?= preg_replace('/\\\r\\\n|\\\n|\\\r/', "", json_encode($arrayJsonData, JSON_HEX_APOS , JSON_UNESCAPED_SLASHES)) ?>');
                var datatable = $('.m_datatable').mDatatable({
                    //internationalization setup
                    translate: {
                        records: {
                            processing: 'Traitement en cours...',
                            noRecords: 'Aucune donn&eacute;e disponible dans le tableau'
                        },
                        toolbar: {
                            pagination: {
                                items: {
                                    default: {
                                        first: 'Premier',
                                        prev: 'Précédent',
                                        next: 'Suivant',
                                        last: 'Dernier',
                                    },
                                    info: 'Affichage de l\'&eacute;l&eacute;ment ' + '{' + '{' + 'start' + '}' + '} - {' + '{' + 'end' + '}' + '} sur {' + '{' +  'total' + '}' + '} &eacute;l&eacute;ments'
                                }
                            }
                        }
                    },

                    // datasource definition
                    data: {
                        type: 'local',
                        source: dataJSONArray,
                        pageSize: 10
                    },

                    // layout definition
                    layout: {
                        theme: 'default', // datatable theme
                        class: '', // custom wrapper class
                        scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                        height: 450, // datatable's body's fixed height
                        footer: false // display/hide footer
                    },

                    // column sorting(refer to Kendo UI)
                    sortable: true,

                    // column based filtering(refer to Kendo UI)
                    filterable: false,

                    // pagination
                    pagination: true,

                    // inline and bactch editing(cooming soon)
                    // editable: false,

                    // columns definition

                    columns: [{
                        <?php if($dataType->display_name_plural == 'Pages') { ?>

                        field: "id",
                        title: "#",
                        width: 50,
                        sortable: false,
                        selector: false,
                        textAlign: 'center'
                    }, {
                        field: "title",
                        title: "Title",
                        width: 120

                    }, {
                        field: "slug",
                        title: "Slug",
                        width: 100

                    }, {
                        field: "status",
                        title: "Status",
                        width: 80

                    }, {
                        field: "image",
                        title: "Image",
                        width: 100,
                        template: function (row) {
                            return '<img style = "max-width: 100px;" src = "../storage/' + row.image + '"/>';
                        }

                    }, {
                        field: "created_at",
                        title: "Create date"

                    }, {
                        field: "Actions",
                        width: 80,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
                            return '\
                                <div class="dropdown ' + dropup + '">\
                                    <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                        <i class="la la-ellipsis-h"></i>\
                                    </a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>{{ __('voyager.generic.view') }}</a>\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>{{ __('voyager.generic.edit') }}</a>\
                                        <form action="{{ Request::url() }}/' + row.id + '" method="POST">\
                                            {{ method_field("DELETE") }}\
                                            {{ csrf_field() }}\
                                            <button type="submit" class="dropdown-item"><i class="la la-times-circle"></i>{{ __('voyager.generic.delete') }}</button>\
                                        </form>\
                                    </div>\
                                </div>\
                            ';
                        },

                        <?php } elseif($dataType->display_name_plural == 'Posts') { ?>

                        field: "reference",
                        title: "Réf.",
                        width: 70,
                        sortable: false,
                        selector: false

                    }, {
                        field: "image",
                        title: "",
                        width: 100,
                        template: function (row) {
                            return  '<a href="{{ Request::url() }}/' + row.id + '">' +
                                '<img style = "max-width: 100px;" src = "../storage/' + row.image + '"/>' +
                                '</a>';
                        }

                    }, {
                        field: "ann_type",
                        title: "Type"
                    }, {
                        field: "category_id",
                        title: "Catégorie"
                    }, {
                        field: "title_fr",
                        title: "Titre",
                        template: function (row) {
                            return '<a href="{{ Request::url() }}/' + row.id + '"">' + row.title_fr + '</a>'
                        }

                    }, {
                        field: "zip_code",
                        title: "Code postal",
                        width: 90

                    }, {
                        field: "town",
                        title: "Ville"

                    },  {
                        field: "price",
                        title: "Prix",
                        width: 90,

                        <?php if(Auth::user()->role_id != 5) { ?>
                        {{--{--}}
                        {{--field: "Email",--}}
                        {{--title: "Email",--}}
                        {{--width: 300,--}}
                        {{--template: function (row) {--}}
                        {{--return '<form action="{{ URL::to('/admin/confirm-email') }}" id="property_send" method="POST">{{ csrf_field() }}' +--}}
                        {{--'<div style="float:left;">' +--}}
                        {{--'<input type="email" name="email" class="form-control m-input" placeholder="email" />' +--}}
                        {{--'<div class="message_status"></div>' +--}}
                        {{--'<input type="hidden" name="property_id" value="' + row.id + '" />' +--}}
                        {{--'</div>' +--}}
                        {{--'<div style="float:left; padding-left: 5px;">' +--}}
                        {{--'<button type="submit" class="btn">Send</button>' +--}}
                        {{--'</div>' +--}}
                        {{--'</form>';--}}
                        {{--}--}}

                        {{--}, --}}
                    },  {
                        field: "Users",
                        title: "Users",
                        width: 200,
                        template: function (row) {
                            var arr = (row.vip_users).split(',');
                            return '<form action="{{ URL::to('/admin/add-vip-users') }}" id="vip_users_add_' + row.id + '" method="POST">{{ csrf_field() }}' +
                                '<div class="form-group">' +
                                '<select class="form-control m-select2 custom_select2" name="vip_users[]" multiple="multiple" data-placeholder="Sélectionner un client">' +
                                <?php
                                    foreach(TCG\Voyager\Models\IndividualView::where('role_id', 5)->get() as $user) {
                                    ?>
                                    '<option ' + ((jQuery.inArray( "{{ $user->id }}", arr ) !== -1) ? "selected" : " ") + '  value="{{ $user->id }}">{{ $user->name }}</option>' +
                                <?php
                                    }
                                    ?>
                                    '</select>' +
                                '<div class="message_status_' + row.id + '"></div>' +
                                '<input type="hidden" name="property_id" value="' + row.id + '" />' +
                                '</div>' +
                                '<div class="m--align-right">' +
                                '<button type="submit" id="submit_vip" class="btn">Envoyer</button>' +
                                '</div>' +
                                '</form>';

                        }

                    },  {
                        field: "Actions",
                        width: 60,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
//                                console.log(row.id);
                            return '\
                            <div class="dropdown ' + dropup + '">\
                                <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                    <i class="la la-ellipsis-h"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                    <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>Voir</a>\
                                    <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>Editer</a>\
                                    <button class="dropdown-item" data-toggle="modal" data-target="#m_modal_5"><i class="la la-times-circle"></i>Effacer</button>\
                                </div>\
                                <div class="modal fade" id="m_modal_5" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">\
                                <div class="modal-dialog modal-sm" role="document">\
                                    <div class="modal-content">\
                                        <div class="modal-header">\
                                            <h5 class="modal-title" id="exampleModalLabel">Remove object</h5>\
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                <span aria-hidden="true">×</span>\
                                            </button>\
                                        </div>\
                                        <div class="modal-body">\
                                            <p>Are you sure you want to delete this object?</p>\
                                        </div>\
                                        <div class="modal-footer">\
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                                            <form action="{{ Request::url() }}/' + row.id + '" method="POST">\
                                                {{ method_field("DELETE") }}\
                                                {{ csrf_field() }}\
                                                <button type="submit" class="btn btn-primary">Effacer</button>\
                                            </form>\
                                        </div>\
                                    </div>\
                                </div>\
                            ';
                        },  <?php } ?>

                            <?php } elseif($dataType->display_name_plural == 'Categories') { ?>

                        field: "id",
                        title: "#",
                        width: 50,
                        sortable: false,
                        selector: false,
                        textAlign: 'center'

                    }, {
                        field: "name",
                        title: "Name"

                    }, {
                        field: "parent_id",
                        title: "Parent"

                    }, {
                        field: "slug",
                        title: "Slug"

                    }, {
                        field: "created_at",
                        title: "Create date"

                    }, {
                        field: "Actions",
                        width: 80,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
//                                console.log(row.id);
                            return '\
                                <div class="dropdown ' + dropup + '">\
                                    <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                        <i class="la la-ellipsis-h"></i>\
                                    </a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>Voir</a>\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>Editer</a>\
                                        <form action="{{ Request::url() }}/' + row.id + '" method="POST">\
                                            {{ method_field("DELETE") }}\
                                            {{ csrf_field() }}\
                                            <button type="submit" class="dropdown-item"><i class="la la-times-circle"></i>Effacer</button>\
                                        </form>\
                                    </div>\
                                </div>\
                            ';
                        },

                        <?php } elseif($dataType->display_name_plural == 'Users') { ?>

                        field: "id",
                        title: "#",
                        width: 50,
                        sortable: false,
                        selector: false,
                        textAlign: 'center'

                    }, {
                        field: "name",
                        title: "Nom",
                        width: 150

                    }, {
                        field: "email",
                        title: "Courriel",
                        width: 200

                    }, {
                        field: "avatar",
                        title: "Avatar",
                        template: function (row) {
                            return '<img style = "max-width: 100px;" src = "../storage/' + row.avatar + '"/>';
                        }

                    }, {
                        field: "created_at",
                        title: "Date de création"

                    }, {
                        field: "Actions",
                        width: 80,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
//                                console.log(row.id);
                            var currentUSer = Number('{{ Auth::user()->role_id }}');
                            if (currentUSer <= row.id) {
                                return '\
                                    <div class="dropdown ' + dropup + '">\
                                        <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                            <i class="la la-ellipsis-h"></i>\
                                        </a>\
                                        <div class="dropdown-menu dropdown-menu-right">\
                                            <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>Voir</a>\
                                            <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>Editer</a>\
                                            <form action="{{ Request::url() }}/' + row.id + '" method="POST">\
                                                {{ method_field("DELETE") }}\
                                                {{ csrf_field() }}\
                                                <button type="submit" class="dropdown-item"><i class="la la-times-circle"></i>Effacer</button>\
                                            </form>\
                                        </div>\
                                    </div>\
                                    ';
                            }
                        },

                        <?php } elseif($dataType->display_name_plural == 'Roles') { ?>

                        field: "id",
                        title: "#",
                        width: 50,
                        sortable: false,
                        selector: false,
                        textAlign: 'center'

                    }, {
                        field: "name",
                        title: "Name",
                        width: 150

                    }, {
                        field: "display_name",
                        title: "Display name",
                        width: 200

                    }, {
                        field: "created_at",
                        title: "Create date"

                    }, {
                        field: "Actions",
                        width: 80,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
//                                console.log(row.id);
                            return '\
                                <div class="dropdown ' + dropup + '">\
                                    <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                        <i class="la la-ellipsis-h"></i>\
                                    </a>\
                                    <div class="dropdown-menu dropdown-menu-right">\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>{{ __('voyager.generic.view') }}</a>\
                                        <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>{{ __('voyager.generic.edit') }}</a>\
                                        <form action="{{ Request::url() }}/' + row.id + '" method="POST">\
                                            {{ method_field("DELETE") }}\
                                            {{ csrf_field() }}\
                                            <button type="submit" class="dropdown-item"><i class="la la-times-circle"></i>{{ __('voyager.generic.delete') }}</button>\
                                        </form>\
                                    </div>\
                                </div>\
                            ';
                        }
                        <?php } ?>

                    }]
                });

                var query = datatable.getDataSourceQuery();

                $('#m_form_search').on('keyup', function (e) {
                    datatable.search($(this).val().toLowerCase());
                }).val(query.generalSearch);

                $('#m_form_status').on('change', function () {
                    datatable.search($(this).val(), 'Status');
                }).val(typeof query.Status !== 'undefined' ? query.Status : '');

                $('#m_form_type').on('change', function () {
                    datatable.search($(this).val(), 'Type');
                }).val(typeof query.Type !== 'undefined' ? query.Type : '');

                $('#m_form_status, #m_form_type').selectpicker();

                $('select.custom_select2').select2();

            };

            return {
                //== Public functions
                init: function () {
                    // init dmeo
                    demo();
                }
            };
        }();



        jQuery(document).ready(function () {
            DatatableDataLocalDemo.init();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

    <script>
        jQuery(document).ready(function () {
            @foreach ($arrayJsonData as $data)
                jQuery("#vip_users_add_" + '{{ $data['id'] }}').validate({
                submitHandler: function (form) {
                    $.ajax({
                        type: form.method,
                        url: form.action,
                        data: $(form).serialize(),
                        cache: false
                    }).done(function (data) {
                        $('.message_status_' + {{ $data['id'] }} + '').append('<small style="color:limegreen">Users successfully add</small>');
                        setTimeout(function(){
                            $('.message_status_'+ {{ $data['id'] }} +'').fadeOut('500');
                        }, 1500);
                    })
                }
            });

            @endforeach
        });
    </script>

    {{--<script>
        jQuery(document).ready(function () {
            jQuery("#property_send").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                submitHandler: function (form) {
//                    console.log($(form).serialize());
                    $.ajax({
                        type: form.method,
                        url: form.action,
                        data: $(form).serialize(),
                        cache: false
                    }).done(function (data) {

                        $('.message_status').append('<small style="color:limegreen">Message send successful!</small>');
                        if(data.status === 'success') {
                            setTimeout(function(){
                                $('.message_status').fadeOut('500');
                            }, 1500);
                            form.reset();
                        }
                    })

                }
            })
        })
    </script>--}}
@stop
