@extends('voyager::master_metronic')

{{--{{ dd($dataTypeContent->toArray()) }}--}}

@foreach(TCG\Voyager\Models\User::all() as $user)
    {{--{{ dd(TCG\Voyager\Models\User::all()->toArray()) }}--}}
    {{--<img class="m-widget19__img" src="../../storage/{{ ($dataTypeContent->author_id == Auth::user()->role_id) ? $user->avatar : '' }}" alt="">--}}
    {{--{{ dd($user->toArray()) }}--}}

@endforeach

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

                                    {{--@elseif(property_exists($rowDetails, 'options'))--}}
                                    {{--@foreach($dataTypeContent->{$row->field} as $item)--}}
                                    {{--{{ $rowDetails->options->{$item} . (!$loop->last ? ', ' : '') }}--}}
                                    {{--@endforeach--}}
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

    <div id="view_page_info_block" class="m-grid__item m-grid__item--fluid m-wrapper" style="display: block;">

        @if(substr($_SERVER['REQUEST_URI'],0,12) == '/admin/posts')
            @include('voyager::includes.posts')
        @elseif(substr($_SERVER['REQUEST_URI'],0,12) === '/admin/users')
            @include('voyager::includes.users')
        @endif

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
            { id: 77, field: $('select[name="usees_distribution"]') },
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
            { id: 128, field: $('span[name="connection_swedish_stove"]') },
            { id: 129, field: $('span[name="reception"]') },
            { id: 130, field: $('span[name="metallic_curtain"]') },
            { id: 131, field: $('span[name="armed_with_fire_tap"]') },
            { id: 132, field: $('span[name="do_it_yourself_room"]') },
            { id: 133, field: $('span[name="theater"]') },
            { id: 134, field: $('span[name="game_room"]') },
            { id: 135, field: $('span[name="fitness_room"]') },
            { id: 136, field: $('span[name="conference_room"]') },
            { id: 137, field: $('span[name="satellite"]') },
            { id: 138, field: $('span[name="sauna"]') },
            { id: 139, field: $('span[name="subsoil"]') },
            { id: 140, field: $('span[name="blinds"]') },
            { id: 141, field: $('span[name="electric_blinds"]') },
            { id: 142, field: $('span[name="thermostat_connected"]') },
            { id: 143, field: $('span[name="triple_glazing"]') },
            { id: 144, field: $('span[name="veranda"]') },
            { id: 145, field: $('span[name="crawlspace"]') },
            { id: 146, field: $('span[name="electric_shutters"]') },
            { id: 147, field: $('span[name="tumble_drier"]') },
            { id: 148, field: $('span[name="hair_dryer"]') },
            { id: 149, field: $('span[name="satellite_tv"]') },
            { id: 150, field: $('span[name="phone"]') },
            { id: 151, field: $('span[name="car_shelter"]') },
            { id: 152, field: $('span[name="spray"]') },
            { id: 153, field: $('span[name="barbecue"]') },
            { id: 154, field: $('span[name="exterior_lighting"]') },
            { id: 155, field: $('input[name="drilling"]') },
            { id: 156, field: $('span[name="heliport"]') },
            { id: 157, field: $('span[name="well"]') },
            { id: 158, field: $('span[name="source"]') },
            { id: 159, field: $('span[name="collective_lift"]') },
            { id: 160, field: $('span[name="communal_laundry_room"]') },
            { id: 161, field: $('span[name="network_cabling"]') },
            { id: 162, field: $('span[name="collective_optical_fiber"]') },
            { id: 163, field: $('span[name="parable"]') },
            { id: 164, field: $('span[name="alarm"]') },
            { id: 165, field: $('span[name="magnetic_card"]') },
            { id: 166, field: $('span[name="fenced"]') },
            { id: 167, field: $('span[name="safe"]') },
            { id: 168, field: $('span[name="digidode"]') },
            { id: 169, field: $('span[name="guardian"]') },
            { id: 170, field: $('span[name="caretaker"]') },
            { id: 171, field: $('span[name="intercom"]') },
            { id: 172, field: $('span[name="electric_gate"]') },
            { id: 173, field: $('span[name="reinforced_door"]') },
            { id: 174, field: $('span[name="videophone"]') },
            { id: 175, field: $('span[name="clear"]') },
            { id: 176, field: $('span[name="impregnable"]') },
            { id: 177, field: $('span[name="panoramic"]') },
            { id: 178, field: $('span[name="courtyard"]') },
            { id: 179, field: $('span[name="on_countryside"]') },
            { id: 180, field: $('span[name="on_forest"]') },
            { id: 181, field: $('span[name="on_sea"]') },
            { id: 182, field: $('span[name="on_pool"]') },
            { id: 183, field: $('span[name="on_river"]') },
            { id: 184, field: $('span[name="on_street"]') },
            { id: 185, field: $('span[name="on_city"]') },
            { id: 186, field: $('span[name="on_garden"]') },
            { id: 187, field: $('span[name="on_lake"]') },
            { id: 188, field: $('span[name="on_park"]') },
            { id: 189, field: $('span[name="on_haven"]') },
            { id: 190, field: $('span[name="on_hills"]') },
            { id: 191, field: $('span[name="on_mountains"]') },
            { id: 192, field: $('span[name="on_ski_slopes"]') },
            { id: 193, field: $('span[name="vis_a_vis"]') },
            { id: 194, field: $('span[name="interior_condition"]') },
            { id: 195, field: $('span[name="type_construction"]') },
            { id: 196, field: $('span[name="state_front"]') },
            { id: 197, field: $('span[name="external_state"]') },
            { id: 198, field: $('span[name="year_construction"]') },
            { id: 199, field: $('span[name="year_renovation"]') },
            { id: 200, field: $('span[name="nord"]') },
            { id: 201, field: $('span[name="south"]') },
            { id: 202, field: $('span[name="est"]') },
            { id: 203, field: $('span[name="west"]') }
        ];

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
                                this.field.parent().parent().addClass('not_specified');
//                                this.field.parent().parent().parent().css('display','none');
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
