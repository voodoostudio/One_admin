@extends('voyager::master_metronic')

@section('page_title', __('voyager.generic.viewing').' '.$dataType->display_name_plural)

@section('content')
    @php
        foreach (explode(',', Illuminate\Support\Facades\DB::table('posts')->value('vip_users')) as $users) {
            $user_id[$users] = $users;
        }

        $arrayJsonData = [];
        if(Illuminate\Support\Facades\Auth::user()->role_id != 5) {
            if($dataType->display_name_plural == 'Properties') {
                foreach ($dataTypeContent as $data) {
                    if(!empty($_GET['client_id']) && (in_array($_GET['client_id'], explode(',', $data->vip_users)))) {
                        $reference =  'HIS-' . str_pad($data->id, 4, '0', STR_PAD_LEFT);
                        $arrayJsonData[] = [
                            'id'            => $data->id,
                            'reference'     => $reference,
                            'image'         => (!empty(json_decode($data->image)[0])) ? json_decode($data->image)[0] : 'posts/no_image.png',
                            'ann_type'      => ($data->ann_type == 0) ? 'Location' : 'Vente',
                            'category_id'   => Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $data->category_id)->value('name'),
                            'title_fr'      => $data->title_fr,
                            'zip_code'      => $data->zip_code,
                            'town'          => $data->town,
                            'price'         => ($data->show_price == 1) ? $data->price . ' ' . Illuminate\Support\Facades\DB::table('admin_currency')->where('reference', '=', $data->сurrency)->value('value') : '',
                            'vip_users'     => $data->vip_users
                        ];
                    } elseif(empty($_GET['client_id'])) {
                        $reference =  'HIS-' . str_pad($data->id, 4, '0', STR_PAD_LEFT);
                        $arrayJsonData[] = [
                            'id'            => $data->id,
                            'reference'     => $reference,
                            'image'         => (!empty(json_decode($data->image)[0])) ? json_decode($data->image)[0] : 'posts/no_image.png',
                            'ann_type'      => ($data->ann_type == 0) ? 'Location' : 'Vente',
                            'category_id'   => Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $data->category_id)->value('name'),
                            'title_fr'      => $data->title_fr,
                            'zip_code'      => $data->zip_code,
                            'town'          => $data->town,
                            'price'         => ($data->show_price == 1) ? $data->price . ' ' . Illuminate\Support\Facades\DB::table('admin_currency')->where('reference', '=', $data->сurrency)->value('value') : '',
                            'vip_users'     => $data->vip_users
                        ];
                    }
                }
            } elseif($dataType->display_name_plural == 'Clients') {
                foreach ($dataTypeContent->where('role_id', '=', 5) as $data) {
                    $arrayJsonData[] = [
                        'id'            => $data->id,
                        'name'          => $data->name,
                        'email'         => $data->email,
                        'avatar'        => $data->avatar,
                        'created_at'    => $data->created_at->format('d.m.Y /  H:m'),
                    ];
                }
            } elseif($dataType->display_name_plural == 'Users') {
                foreach ($dataTypeContent->where('role_id', '!=', 5)->where('role_id', '>=', Auth::user()->role_id) as $data) {
                    $arrayJsonData[] = [
                        'id'            => $data->id,
                        'name'          => $data->name,
                        'email'         => $data->email,
                        'avatar'        => $data->avatar,
                        'created_at'    => $data->created_at->format('d.m.Y / H:m'),
                    ];
                }
            } else {
                foreach ($dataTypeContent as $data) {
                    foreach ($dataType->browseRows as $row) {
                        $data[$row->display_name] = $data->{$row->field};
                    }
                    $arrayJsonData[] = $data;
                }
            }
        } else {
            foreach (Illuminate\Support\Facades\DB::table('posts')->where('vip_users', 'rlike', '(^|,)' . array_search(Illuminate\Support\Facades\Auth::user()->id, $user_id) . '(,|$)')->get() as $data) {
                if($dataType->display_name_plural == 'Properties') {
                    $reference =  'HIS-' . str_pad($data->id, 4, '0', STR_PAD_LEFT);
                    $arrayJsonData[] = [
                        'id'            => $data->id,
                        'reference'     => $reference,
                        'image'         => (!empty(json_decode($data->image)[0])) ? json_decode($data->image)[0] : 'posts/no_image.png',
                        'ann_type'      => ($data->ann_type == 0) ? 'Location' : 'Vente',
                        'category_id'   => Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $data->category_id)->value('name'),
                        'title_fr'      => $data->title_fr,
                        'zip_code'      => $data->zip_code,
                        'town'          => $data->town,
                        'price'         => ($data->show_price == 1) ? $data->price . ' ' . Illuminate\Support\Facades\DB::table('admin_currency')->where('reference', '=', $data->сurrency)->value('value') : '',
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
                    @if(Auth::user()->role_id == 5)
                        <h3 class="m-subheader__title">
                            Bonjour {{ Auth::user()->name }} {{ Auth::user()->last_name }}
                        </h3>
                        <p>Voici les objets que nous avons sélectionnés pour vous.</p>
                    @endif
                </div>
            </div>
        </div>
        <!-- END: Subheader -->
        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">
                                {{ $dataType->display_name_singular }}
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <!--begin: Search Form -->
                    <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                        <div class="row align-items-center">
                            <div class="col-xl-8 order-2 order-xl-1">
                                <div class="form-group m-form__group row align-items-center">
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
            const client_cgu_title_de = `Confidentiality clause`;
            const client_cgu_title_en = `Confidentiality clause`;
            const client_cgu_title_es = `Cláusula de confidencialidad`;
            const client_cgu_title_fr = `Clause de Confidentialité`;
            const client_cgu_title_it = `Clause de Confidentialité`;

            const client_cgu_check_text_de = `Read and approved`;
            const client_cgu_check_text_en = `Read and approved`;
            const client_cgu_check_text_es = `Leído y aprobado`;
            const client_cgu_check_text_fr = `Lu et approuvé`;
            const client_cgu_check_text_it = `Lu et approuvé`;

            const client_cgu_de = `The product offered to you through this application by House Invest Spain is subject to this confidentiality clause. <br /><br />
                                    Real estate, financial or entrepreneurial projects that we present to our customers are, or may be, exclusive and their content is strictly confidential. They can not and must not at any time be retransmitted by the recipient to third parties, natural or legal person without the written consent of our company.
                                    House Invest Spain holds directly the mandates of sale of these projects, as well as all the rights for their commercialization.<br /><br />
                                    By accessing the information through this application, the recipient agrees to treat the information as confidential and not to disclose its content.<br /><br />
                                    Any information communicated by our company will remain the property of House Invest Spain and can not be used at any time to the detriment of the company.<br /><br />
                                    Upon request of House Invest Spain the beneficiary of the information will agree to transmit a certificate of destruction of it.<br /><br />
                                    For all disputes that may arise regarding the interpretation or execution of this confidentiality clause and regardless of the current and future domicile of the parties, they agree, by accessing this information, both parties together with beneficiaries, the exclusive jurisdiction of the Courts of the Canton of Geneva, without prejudice to a possible appeal to the Federal Court.`;

            const client_cgu_en = `The product offered to you through this application by House Invest Spain is subject to this confidentiality clause.<br /><br />
                                    Real estate, financial or entrepreneurial projects that we present to our customers are, or may be, exclusive and their content is strictly confidential. They can not and must not at any time be retransmitted by the recipient to third parties, natural or legal person without the written consent of our company.<br /><br />
                                    House Invest Spain holds directly the mandates of sale of these projects, as well as all the rights for their commercialization.<br /><br />
                                    By accessing the information through this application, the recipient agrees to treat the information as confidential and not to disclose its content.<br /><br />
                                    Any information communicated by our company will remain the property of House Invest Spain and can not be used at any time to the detriment of the company.<br /><br />
                                    Upon request of House Invest Spain the beneficiary of the information will agree to transmit a certificate of destruction of it.<br /><br />
                                    For all disputes that may arise regarding the interpretation or execution of this confidentiality clause and regardless of the current and future domicile of the parties, they agree, by accessing this information, both parties together with beneficiaries, the exclusive jurisdiction of the Courts of the Canton of Geneva, without prejudice to a possible appeal to the Federal Court.`;

            const client_cgu_es = `El producto que les propone House Invest Spain con esta aplicación queda sometido a la presente cláusula de confidencialidad.<br /><br />
                                    Los productos inmobiliarios, financieros o empresariales que ofrecemos a nuestra clientela, tienen un carácter exclusivo. Su contenido es estrictamente confidencial y no pueden ser objeto de transmisión a terceros, ya sean personas físicas o morales, sin el acuerdo escrito de nuestra sociedad. <br /><br />
                                    House Invest Spain posee directamente los mandatos de venta de tales productos, así como todos los derechos para su comercialización.<br /><br />
                                    El destinatario considerará como confidencial la información recibida a través de esta aplicación y se compromete a no divulgar su contenido.<br /><br />
                                    Toda la información comunicada por nuestra sociedad pertenece a House Invest Spain y no podrá ser utilizada en ningún momento con el fin de ocasionarle perjuicio.<br /><br />
                                    Bajo demanda de House Invest Spain, el beneficiario de la información aceptará transmitir, mediante certificado, la destrucción de la misma. <br /><br />
                                    Para todo litigio que pudiera producirse en cuanto a la interpretación o a la ejecución de la presente cláusula de confidencialidad, y cualquiera que sea el domicilio actual y futuro de las partes, estas aceptan, accediendo a la presenta información, tanto para ellas como para sus derechohabientes, la competencia exclusiva de los Tribunales del Cantón de Ginebra, sin perjuicio de un eventual recurso al Tribunal Federal.`;

            const client_cgu_fr = `Le produit qui vous est proposé à travers cette application par House Invest Spain, est soumis à la présente clause de confidentialité.<br /><br />
                                    Les projets immobiliers, financiers ou entrepreneuriaux que nous présentons à notre aimable clientèle sont, ou peuvent être, à caractère exclusif et leur contenu est strictement confidentiel.<br /><br />
                                    Ils ne peuvent et ne doivent à aucun moment, être retransmis par le destinataire à des tiers, personnes physiques ou morales sans l’accord écrit de notre société.<br /><br />
                                    House Invest Spain détient directement les mandats de vente desdits projets, ainsi que tous les droits pour leur commercialisation.<br /><br />
                                    En accédant à l’information qu’il reçoit à travers la présente application, le destinataire accepte de considérer l’information comme confidentielle et à ne pas en divulguer son contenu.<br /><br />
                                    Toute information communiquée par notre société demeurera la propriété de House Invest Spain et ne pourra, à aucun moment, être utilisée dans le but de lui porter préjudice.<br /><br />
                                    Sur demande de House Invest Spain, le bénéficiaire de l’information acceptera de transmettre une attestation de destruction de celle-ci.<br /><br />
                                    Pour tous les litiges qui pourraient survenir quant à l’interprétation ou à l’exécution de la présente clause de confidentialité et quel que soit le domicile actuel et futur des parties, celles-ci acceptent, en accédant à la présente information, tant pour elles que pour leurs ayants droits, la compétence exclusive des Tribunaux du Canton de Genève, sans préjudice d’un éventuel recours au Tribunal Fédéral.`;

            const client_cgu_it = `Le produit qui vous est proposé à travers cette application par House Invest Spain, est soumis à la présente clause de confidentialité.<br /><br />
                                    Les projets immobiliers, financiers ou entrepreneuriaux que nous présentons à notre aimable clientèle sont, ou peuvent être, à caractère exclusif et leur contenu est strictement confidentiel.<br /><br />
                                    Ils ne peuvent et ne doivent à aucun moment, être retransmis par le destinataire à des tiers, personnes physiques ou morales sans l’accord écrit de notre société.<br /><br />
                                    House Invest Spain détient directement les mandats de vente desdits projets, ainsi que tous les droits pour leur commercialisation.<br /><br />
                                    En accédant à l’information qu’il reçoit à travers la présente application, le destinataire accepte de considérer l’information comme confidentielle et à ne pas en divulguer son contenu.<br /><br />
                                    Toute information communiquée par notre société demeurera la propriété de House Invest Spain et ne pourra, à aucun moment, être utilisée dans le but de lui porter préjudice.<br /><br />
                                    Sur demande de House Invest Spain, le bénéficiaire de l’information acceptera de transmettre une attestation de destruction de celle-ci.<br /><br />
                                    Pour tous les litiges qui pourraient survenir quant à l’interprétation ou à l’exécution de la présente clause de confidentialité et quel que soit le domicile actuel et futur des parties, celles-ci acceptent, en accédant à la présente information, tant pour elles que pour leurs ayants droits, la compétence exclusive des Tribunaux du Canton de Genève, sans préjudice d’un éventuel recours au Tribunal Fédéral.`;
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

                        <?php } elseif($dataType->display_name_plural == 'Properties') { ?>

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
                            <?php if(Auth::user()->role_id != 5) { ?>
                                return  '<a href="{{ Request::url() }}/' + row.id + '"><img style = "max-width: 100px;" src = "../storage/' + row.image + '"/></a>';
                            <?php } else { ?>
                                return '\
                                    <a href="" data-toggle="modal" data-target="#view_post_confirmation_img"><img style = "max-width: 100px;" src = "../storage/' + row.image + '"/></a>\
                                    <div class="modal fade view_post_cgu_confirmation" id="view_post_confirmation_img" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">\
                                        <div class="modal-dialog modal-lg" role="document">\
                                            <div class="modal-content">\
                                                <div class="modal-header">\
                                                    <h5 class="modal-title" id="exampleModalLabel">\
                                                        <?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "' + client_cgu_title_de + '";
                                            break;
                                        case 2:
                                            echo "' + client_cgu_title_en + '";
                                            break;
                                        case 3:
                                            echo "' + client_cgu_title_es + '";
                                            break;
                                        case 4:
                                            echo "' + client_cgu_title_fr + '";
                                            break;
                                        case 5:
                                            echo "' + client_cgu_title_it + '";
                                            break;
                                    }?>
                                    </h5>\
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                        <span aria-hidden="true">×</span>\
                                    </button>\
                                </div>\
                                <div class="modal-body">\
                                    <div class="row">\
                                        <div class="col-lg-12">\
<?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "<p>' + client_cgu_de + '</p>";
                                            break;
                                        case 2:
                                            echo "<p>' + client_cgu_en + '</p>";
                                            break;
                                        case 3:
                                            echo "<p>' + client_cgu_es + '</p>";
                                            break;
                                        case 4:
                                            echo "<p>' + client_cgu_fr + '</p>";
                                            break;
                                        case 5:
                                            echo "<p>' + client_cgu_it + '</p>";
                                            break;
                                    }?>
                                    </div>\
                                    <div class="col-lg-12">\
                                        <div class="pure_switch">\
                                            <span class="m-switch m-switch--outline m-switch--brand">\
                                                <label>\
                                                    <input type="checkbox" name="save_check1" onchange="checkViewPostCheckbox();">\
                                                    <span></span>\
                                                </label>\
                                            </span>\
                                            <label class="pure_switch_label">\
<?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "' + client_cgu_check_text_de + '";
                                            break;
                                        case 2:
                                            echo "' + client_cgu_check_text_en + '";
                                            break;
                                        case 3:
                                            echo "' + client_cgu_check_text_es + '";
                                            break;
                                        case 4:
                                            echo "' + client_cgu_check_text_fr + '";
                                            break;
                                        case 5:
                                            echo "' + client_cgu_check_text_it + '";
                                            break;
                                    }?>
                                    </label>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                        <a href="{{ Request::url() }}/' + row.id + '" class="btn btn-primary disabled" >Voir</a>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>'
                            <?php }?>
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
                            <?php if(Auth::user()->role_id != 5) { ?>
                                return '<a href="{{ Request::url() }}/' + row.id + '"">' + row.title_fr + '</a>'
                            <?php } else { ?>
                                return '\
                                    <a href="" data-toggle="modal" data-target="#view_post_confirmation_title">' + row.title_fr + '</a>\
                                    <div class="modal fade view_post_cgu_confirmation" id="view_post_confirmation_title" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">\
                                        <div class="modal-dialog modal-lg" role="document">\
                                            <div class="modal-content">\
                                                <div class="modal-header">\
                                                    <h5 class="modal-title" id="exampleModalLabel">\
                                                        <?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "' + client_cgu_title_de + '";
                                            break;
                                        case 2:
                                            echo "' + client_cgu_title_en + '";
                                            break;
                                        case 3:
                                            echo "' + client_cgu_title_es + '";
                                            break;
                                        case 4:
                                            echo "' + client_cgu_title_fr + '";
                                            break;
                                        case 5:
                                            echo "' + client_cgu_title_it + '";
                                            break;
                                    }?>
                                    </h5>\
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                        <span aria-hidden="true">×</span>\
                                    </button>\
                                </div>\
                                <div class="modal-body">\
                                    <div class="row">\
                                        <div class="col-lg-12">\
<?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "<p>' + client_cgu_de + '</p>";
                                            break;
                                        case 2:
                                            echo "<p>' + client_cgu_en + '</p>";
                                            break;
                                        case 3:
                                            echo "<p>' + client_cgu_es + '</p>";
                                            break;
                                        case 4:
                                            echo "<p>' + client_cgu_fr + '</p>";
                                            break;
                                        case 5:
                                            echo "<p>' + client_cgu_it + '</p>";
                                            break;
                                    }?>
                                    </div>\
                                    <div class="col-lg-12">\
                                        <div class="pure_switch">\
                                            <span class="m-switch m-switch--outline m-switch--brand">\
                                                <label>\
                                                    <input type="checkbox" name="save_check1" onchange="checkViewPostCheckbox();">\
                                                    <span></span>\
                                                </label>\
                                            </span>\
                                            <label class="pure_switch_label">\
<?php
                                    switch (Auth::user()->lng_corres) {
                                        case 1:
                                            echo "' + client_cgu_check_text_de + '";
                                            break;
                                        case 2:
                                            echo "' + client_cgu_check_text_en + '";
                                            break;
                                        case 3:
                                            echo "' + client_cgu_check_text_es + '";
                                            break;
                                        case 4:
                                            echo "' + client_cgu_check_text_fr + '";
                                            break;
                                        case 5:
                                            echo "' + client_cgu_check_text_it + '";
                                            break;
                                    }?>
                                    </label>\
                                </div>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="modal-footer">\
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                        <a href="{{ Request::url() }}/' + row.id + '" class="btn btn-primary disabled" >Voir</a>\
                                                </div>\
                                            </div>\
                                        </div>\
                                    </div>'
                            <?php }?>
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
                        field: "Actions",
                        width: 60,
                        title: "Actions",
                        sortable: false,
                        overflow: 'visible',
                        template: function (row) {
                            var dropup = (row.getDatatable().getPageSize() - row.getIndex()) <= 4 ? 'dropup' : '';
//                                console.log(row.id);

                            var arr = (row.vip_users).split(',');
                            return '\
                            <div class="dropdown ' + dropup + '">\
                                <a href="#" class="btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown">\
                                    <i class="la la-ellipsis-h"></i>\
                                </a>\
                                <div class="dropdown-menu dropdown-menu-right">\
                                    <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '"><i class="la la-eye"></i>Voir</a>\
                                    <a class="dropdown-item" href="{{ Request::url() }}/' + row.id + '/edit"><i class="la la-edit"></i>Editer</a>\
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#add_clients_modal_' + row.id + '"><i class="la la-edit"></i>Add clients</a>\
                                    <button class="dropdown-item" data-toggle="modal" data-target="#remove_confirm_modal"><i class="la la-times-circle"></i>Effacer</button>\
                                </div>\
                                <div class="modal fade" id="remove_confirm_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">\
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
                                </div>\
                                <div class="modal fade" id="add_clients_modal_' + row.id + '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">\
                                    <div class="modal-dialog modal-sm" role="document">\
                                        <div class="modal-content">\
                                            <div class="modal-header">\
                                                <h5 class="modal-title" id="exampleModalLabel">Sélectionner un client</h5>\
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                    <span aria-hidden="true">×</span>\
                                                </button>\
                                            </div>\
                                            <form action="{{ URL::to('/admin/add-vip-users') }}" id="vip_users_add_' + row.id + '" method="POST">{{ csrf_field() }}\
                                                <div class="modal-body">\
                                                    <div class="form-group">\
                                                        <select class="form-control m-select2 custom_select2" name="vip_users[]" multiple="multiple" data-placeholder="Sélectionner un client">\
                                                            <?php foreach(TCG\Voyager\Models\IndividualView::where('role_id', 5)->get() as $user) {?>
                                                                <option ' + ((jQuery.inArray( "{{ $user->id }}", arr ) !== -1) ? "selected" : " ") + '  value="{{ $user->id }}">{{ $user->name }} {{ $user->last_name }}</option>\
                                                            <?php }?>
                                                        </select>\
                                                    <div class="message_status_' + row.id + '"></div>\
                                                        <input type="hidden" name="property_id" value="' + row.id + '" />\
                                                    </div>\
                                                </div>\
                                                <div class="modal-footer">\
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>\
                                                    <button type="submit" id="submit_vip" class="btn btn-primary">Envoyer</button>\
                                                </div>\
                                            </form>\
                                        </div>\
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

                        <?php } elseif($dataType->display_name_plural == 'Clients') { ?>

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
                            return '<img style = "max-width: 70px;" src = "../storage/' + row.avatar + '"/>';
                        }

                    }, {
                        field: "created_at",
                        title: "Date de création"

                    }, {
                        field: "Actions",
                        width: 110,
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
                        $('.message_status_' + {{ $data['id'] }} + '').append('<small style="color:limegreen">Users were successfully added</small>');
                        setTimeout(function(){
                            $('.message_status_'+ {{ $data['id'] }} +'').html('');
                        }, 500);
                    })
                }
            });

            @endforeach
        });
    </script>

    <script>
        function checkViewPostCheckbox() {
            var cgu_modal = $(".view_post_cgu_confirmation.show");
            var checkbox =  cgu_modal.find(".pure_switch input[type='checkbox']");
            var checked =  cgu_modal.find(".pure_switch input[type='checkbox']:checked");
            if ($(checkbox).length == $(checked).length) {
                cgu_modal.find(".modal-footer a.btn").removeClass('disabled');
            } else {
                cgu_modal.find(".modal-footer a.btn").addClass('disabled');
            }
        }
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
