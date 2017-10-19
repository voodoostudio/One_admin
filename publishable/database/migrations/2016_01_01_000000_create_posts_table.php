<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('author_id');
            $table->integer('category_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('mandate_id')->nullable();
            $table->integer('origin_id')->nullable();
            $table->string('title');
            $table->boolean('exclusiveness')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('excerpt');
            $table->text('body');
            $table->string('image')->nullable();
            $table->string('slug')->unique();
            $table->text('meta_description');
            $table->text('meta_keywords');
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
            $table->string('reference');
            $table->string('note_transaction',255);
            $table->string('broker_notes',255);
            $table->string('important_notes',255);
            $table->string('owner_notes',255);
            $table->date('mandate_start');
            $table->date('term_end');
            $table->date('availability');
            $table->date('availab_from');
            $table->date('availab_until');
            $table->boolean('featured')->default(0);

            $table->integer('notation')->nullable();
            $table->integer('broker')->nullable();
            $table->integer('promotion');
            $table->integer('direct_transaction');

            // Address
            $table->string('address',255);
            $table->string('street',255);
            $table->string('number',255);
            $table->string('po_box',255);
            $table->string('zip_code',255);
            $table->string('town',255);
            $table->string('country',255);
            $table->string('location',255);
            $table->string('longitude',100);
            $table->string('latitude',100);
            // Redaction
            $table->integer('lng_of_add')->nullable();
            $table->string('add_title',80);
            $table->text('desc_add');
            // Prix
            $table->integer('сurrency')->nullable();
            $table->boolean('show_price')->default(0);
            $table->string('price',25);
            $table->string('price_m2',25);
            $table->string('gross_yield',25);
            $table->string('net_return',25);
            $table->string('owner_amount',25);
            $table->string('client_fees',100);
            $table->string('owner_fees',100);
            $table->string('negotiable_amount',30);
            $table->string('estimate_price',25);
            $table->string('recording_rights',25);
            $table->integer('regime')->nullable();
            $table->string('heating_loads',25);
            $table->string('ppe_charges',25);
            $table->string('condominium_fees',25);
            $table->string('property_tax',25);
            $table->string('procedure_in_progress',100);
            $table->string('renovation_fund',100);
            $table->string('annual_charges',25);
            $table->string('rental_security',25);
            $table->string('commercial_property',25);
            $table->string('earnings',25);
            $table->string('taxes',25);
            // Agencement
            $table->string('number_rooms',25);
            $table->string('number_pieces',25);
            $table->string('number_balconies',25);
            $table->string('number_shower_rooms',25);
            $table->string('number_toilets',25);
            $table->string('number_terraces',25);
            $table->string('number_floors_building',25);
            $table->integer('floor_property')->nullable();
            $table->string('levels',25);
            // Surface
            $table->string('surface_cellar',25);
            $table->string('ceiling_height',25);
            $table->string('roof_cover_area',25);
            $table->string('surface_area_terrace_solarium',100);
            $table->string('area_veranda',25);
            $table->string('attic_space',25);
            $table->string('surface_balcony',25);
            $table->string('basement_area',25);
            $table->string('surface_ground',25);
            $table->string('ground',25);
            $table->string('serviced',25);
            $table->integer('type_land')->nullable();
            $table->string('useful_surface',25);
            $table->string('ppe_area',25);
            $table->string('volume',25);
            $table->string('surface_eng_court',25);
            $table->string('lower_ground_floor',25);
            $table->string('row_area',25);
            $table->string('garage_area',25);
            $table->string('weighted_surface',25);
            // Stationnement
            $table->string('box_interior_garage',100);
            $table->string('box_garage_interior_double',100);
            $table->string('outdoor_garage',100);
            $table->string('box_garage_outside_double',100);
            $table->string('covered_outdoor_parking_space',100);
            $table->string('outside_parking_space_uncovered',100);
            $table->string('number_parking_spaces',25);
            $table->string('boat_shed',100);
            $table->string('mooring',100);
            // Cuisine
            $table->integer('type')->nullable();
            $table->integer('freezer');
            $table->integer('cooker');
            $table->integer('oven');
            $table->integer('microwave_oven');
            $table->integer('extractor_hood');
            $table->integer('washmachine');
            $table->integer('dishwasher');
            $table->integer('plates');
            $table->integer('induction_plates');
            $table->integer('hotplates')->nullable();
            $table->integer('ceramic_plates');
            $table->integer('fridge');
            $table->integer('cuisine_tumble_drier');
            $table->integer('coffee_maker');
            // Chauffage
            $table->integer('format')->nullable();
            $table->integer('chauffage_energy')->nullable();
            $table->integer('type_heating')->nullable();
            $table->integer('type_radiator')->nullable();
            // Eau chaude
            $table->integer('distribution')->nullable();
            $table->integer('eau_chaude_energy')->nullable();
            // Eau usées
            $table->integer('usees_distribution')->nullable();
            // Divers
            $table->integer('divers_format')->nullable();
            $table->integer('sonority')->nullable();
            $table->integer('style')->nullable();
            // Commodités
            $table->integer('shelter');
            $table->integer('access_disabled');
            $table->integer('water_softener');
            $table->integer('air_conditioning');
            $table->integer('pets_welcome');
            $table->integer('fitted_wardrobes');
            $table->integer('private_lift');
            $table->integer('central_aspiration');
            $table->integer('workshop');
            $table->integer('patch_panel');
            $table->integer('windows');
            $table->integer('bath');
            $table->integer('balneo_bath');
            $table->integer('private_laundry_room');
            $table->integer('cafeteria');
            $table->integer('carnotzet');
            $table->integer('cave');
            $table->integer('wine_cellar');
            $table->integer('cellar');
            $table->integer('fireplace');
            $table->integer('air_conditioner');
            $table->integer('removable_partitions');
            $table->integer('addiction');
            $table->integer('automation');
            $table->integer('double_glazing');
            $table->integer('shower');
            $table->integer('dressing');
            $table->integer('automatic_fire_extinguisher');
            $table->integer('false_ceiling');
            $table->integer('optical_fiber');
            $table->integer('attic');
            $table->integer('generator');
            $table->integer('hammam');
            $table->integer('high_internet');
            $table->integer('jacuzzi');
            $table->integer('winter_garden');
            $table->integer('ski_locker');
            $table->integer('bicycle_storage');
            $table->integer('loggia');
            $table->integer('net');
            $table->integer('hoist');
            $table->integer('open_plan');
            $table->integer('outdoor_pool');
            $table->integer('indoor_pool');
            $table->integer('ceramic_stove');
            $table->integer('swedish_stove');
            $table->integer('loading_dock');
            $table->integer('connection_chimney');
            $table->integer('connection_swedish_stove');
            $table->integer('reception');
            $table->integer('metalli_curtain');
            $table->integer('armed_with_fire_tap');
            $table->integer('do_it_yourself_room');
            $table->integer('theater');
            $table->integer('game_room');
            $table->integer('fitness_room');
            $table->integer('conference_room');
            $table->integer('satellite');
            $table->integer('sauna');
            $table->integer('subsoil');
            $table->integer('blinds');
            $table->integer('electric_blinds');
            $table->integer('thermostat_connected');
            $table->integer('triple_glazing');
            $table->integer('veranda');
            $table->integer('crawlspace');
            $table->integer('electric_shutters');
            $table->integer('tumble_drier');
            $table->integer('hair_dryer');
            $table->integer('satellite_tv');
            $table->integer('phone');
            // Equipement extérieur
            $table->integer('car_shelter');
            $table->integer('spray');
            $table->integer('barbecue');
            $table->integer('exterior_lighting');
            $table->integer('drilling');
            $table->integer('heliport');
            $table->integer('well');
            $table->integer('source');
            // Immeuble
            $table->integer('collective_lift');
            $table->integer('communal_laundry_room');
            $table->integer('network_cabling');
            $table->integer('collective_optical_fiber');
            $table->integer('parable');
            // Sécurité
            $table->integer('alarm');
            $table->integer('magnetic_card');
            $table->integer('fenced');
            $table->integer('safe');
            $table->integer('digidode');
            $table->integer('guardian');
            $table->integer('caretaker');
            $table->integer('intercom');
            $table->integer('electric_gate');
            $table->integer('reinforced_door');
            $table->integer('videophone');
            // Vue
            $table->integer('clear');
            $table->integer('impregnable');
            $table->integer('panoramic');
            $table->integer('courtyard');
            $table->integer('on_countryside');
            $table->integer('on_forest');
            $table->integer('on_sea');
            $table->integer('on_pool');
            $table->integer('on_river');
            $table->integer('on_street');
            $table->integer('on_city');
            $table->integer('on_garden');
            $table->integer('on_lake');
            $table->integer('on_park');
            $table->integer('on_haven');
            $table->integer('on_hills');
            $table->integer('on_mountains');
            $table->integer('on_ski_slopes');
            $table->integer('vis_a_vis');
            //
            $table->integer('interior_condition')->nullable();
            $table->integer('type_construction')->nullable();
            $table->integer('state_front')->nullable();
            $table->integer('external_state')->nullable();
            $table->integer('year_construction')->nullable();
            $table->integer('year_renovation')->nullable();
            // Exposition
            $table->integer('nord');
            $table->integer('south');
            $table->integer('est');
            $table->integer('west');
            $table->timestamps();

            //$table->foreign('author_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('posts');
    }
}
