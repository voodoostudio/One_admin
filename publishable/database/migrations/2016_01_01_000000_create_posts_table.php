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
//            $table->string('slug')->unique();
            $table->string('title');
            // Redaction
            $table->integer('lng_of_add');
            $table->text('desc_add')->nullable();
            $table->string('image')->nullable();
            $table->string('reference')->nullable();
            $table->boolean('exclusiveness')->default(0);
            $table->integer('category_id')->nullable();
            $table->integer('sub_category')->nullable();
            $table->integer('notation')->nullable();
            $table->integer('broker')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('mandate_id')->nullable();
            $table->integer('origin_id')->nullable();
            $table->date('mandate_start')->nullable();
            $table->date('term_end')->nullable();
            $table->date('availability')->nullable();
            $table->date('availab_from')->nullable();
            $table->date('availab_until')->nullable();
            $table->boolean('promotion')->default(0);
            $table->boolean('direct_transaction')->default(0);
            $table->string('note_transaction',255)->nullable();
            $table->string('broker_notes',255)->nullable();
            $table->string('important_notes',255)->nullable();
            $table->string('owner_notes',255)->nullable();
//            $table->text('body')->nullable();
//            $table->string('seo_title')->nullable();
            $table->text('excerpt');
            $table->text('meta_description');
            $table->text('meta_keywords');
//            $table->enum('status', ['PUBLISHED', 'DRAFT', 'PENDING'])->default('DRAFT');
//            $table->boolean('featured')->default(1);

            // Address
            $table->string('address',255)->nullable();
            $table->string('street',255)->nullable();
            $table->string('number',255)->nullable();
            $table->string('po_box',255)->nullable();
            $table->string('zip_code',255)->nullable();
            $table->string('town',255)->nullable();
            $table->string('country',255)->nullable();
            $table->string('location',255)->nullable();
            $table->integer('longitude')->nullable();
            $table->integer('latitude')->nullable();
//
//            // Prix
            $table->integer('сurrency')->nullable();
            $table->boolean('show_price')->default(1);
            $table->string('price',25)->nullable();
            $table->string('price_m2',25)->nullable();
            $table->string('gross_yield',25)->nullable();
            $table->string('net_return',25)->nullable();
            $table->string('owner_amount',25)->nullable();
            $table->string('client_fees',100)->nullable();
            $table->string('owner_fees',100)->nullable();
            $table->string('negotiable_amount',30)->nullable();
            $table->string('estimate_price',25)->nullable();
            $table->string('recording_rights',25)->nullable();
            $table->integer('regime')->nullable();
            $table->string('heating_loads',25)->nullable();
            $table->string('ppe_charges',25)->nullable();
            $table->string('condominium_fees',25)->nullable();
            $table->string('property_tax',25)->nullable();
            $table->boolean('procedure_in_progress')->default(0);
            $table->string('renovation_fund',100)->nullable();
            $table->string('annual_charges',25)->nullable();
            $table->string('taxes_1',25)->nullable();
            $table->string('rental_security',25)->nullable();
            $table->string('commercial_property',25)->nullable();
            $table->string('earnings',25)->nullable();
            $table->string('taxes',25)->nullable();
//            // Agencement
            $table->string('number_rooms',25)->nullable();
            $table->string('number_pieces',25)->nullable();
////            $table->string('number__bathrooms',25)->nullable();
            $table->string('number_balconies',25)->nullable();
            $table->string('number_shower_rooms',25)->nullable();
            $table->string('number_toilets',25)->nullable();
            $table->string('number_terraces',25)->nullable();
            $table->string('number_floors_building',25)->nullable();
            $table->integer('floor_property')->nullable();
            $table->string('levels',25)->nullable();
            // Surface
            $table->integer('surface_cellar')->nullable();
            $table->integer('ceiling_height')->nullable();
            $table->integer('roof_cover_area')->nullable();
            $table->integer('surf_area_terr_solar')->nullable();
            $table->integer('area_veranda')->nullable();
            $table->integer('attic_space')->nullable();
            $table->integer('surface_balcony')->nullable();
            $table->integer('basement_area')->nullable();
            $table->integer('surface_ground')->nullable();
            $table->integer('ground_length')->nullable();
            $table->integer('ground_width')->nullable();
            $table->boolean('serviced')->default(0);
            $table->integer('type_land')->nullable();
            $table->integer('useful_surface')->nullable();
            $table->integer('ppe_area')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('surface_eng_court')->nullable();
            $table->integer('lower_ground_floor')->nullable();
            $table->integer('row_area')->nullable();
            $table->integer('garage_area')->nullable();
            $table->integer('weighted_surface')->nullable();
//            // Stationnement
            $table->integer('box_interior_garage')->nullable();
            $table->integer('box_gar_inter_doub')->nullable();
            $table->integer('outdoor_garage')->nullable();
            $table->integer('box_garage_outside_double')->nullable();
            $table->integer('covered_outdoor_parking_space')->nullable();
            $table->integer('outside_parking_space_uncovered')->nullable();
            $table->integer('number_parking_spaces')->nullable();
            $table->integer('boat_shed')->nullable();
            $table->integer('mooring')->nullable();
//            // Cuisine
            $table->integer('type')->nullable();
            $table->boolean('freezer')->default(0);
            $table->boolean('cooker')->default(0);
            $table->boolean('oven')->default(0);
            $table->boolean('microwave_oven')->default(0);
            $table->boolean('extractor_hood')->default(0);
            $table->boolean('washmachine')->default(0);
            $table->boolean('dishwasher')->default(0);
            $table->boolean('plates')->default(0);
            $table->boolean('induction_plates')->default(0);
            $table->integer('hotplates')->nullable();
            $table->boolean('ceramic_plates')->default(0);
            $table->boolean('fridge')->default(0);
            $table->boolean('cuisine_tumble_drier')->default(0);
            $table->boolean('coffee_maker')->default(0);
//            // Chauffage
            $table->integer('format')->nullable();
            $table->integer('chauffage_energy')->nullable();
            $table->integer('type_heating')->nullable();
            $table->integer('type_radiator')->nullable();
//            // Eau chaude
            $table->integer('distribution')->nullable();
            $table->integer('eau_chaude_energy')->nullable();
//            // Eau usées
            $table->integer('usees_distribution')->nullable();
//            // Divers
            $table->integer('divers_format')->nullable();
            $table->integer('sonority')->nullable();
            $table->integer('style')->nullable();
//            // Commodités
            $table->boolean('shelter')->default(0);
            $table->boolean('access_disabled')->default(0);
            $table->boolean('water_softener')->default(0);
            $table->boolean('air_conditioning')->default(0);
            $table->boolean('pets_welcome')->default(0);
            $table->boolean('fitted_wardrobes')->default(0);
            $table->boolean('private_lift')->default(0);
            $table->boolean('central_aspiration')->default(0);
            $table->boolean('workshop')->default(0);
            $table->boolean('patch_panel')->default(0);
            $table->boolean('windows')->default(0);
            $table->boolean('bath')->default(0);
            $table->boolean('balneo_bath')->default(0);
            $table->boolean('private_laundry_room')->default(0);
            $table->boolean('cafeteria')->default(0);
            $table->boolean('carnotzet')->default(0);
            $table->boolean('cave')->default(0);
            $table->boolean('wine_cellar')->default(0);
            $table->boolean('cellar')->default(0);
            $table->boolean('fireplace')->default(0);
            $table->boolean('air_conditioner')->default(0);
            $table->boolean('removable_partitions')->default(0);
            $table->boolean('addiction')->default(0);
            $table->boolean('automation')->default(0);
            $table->boolean('double_glazing')->default(0);
            $table->boolean('shower')->default(0);
            $table->boolean('dressing')->default(0);
            $table->boolean('automatic_fire_extinguisher')->default(0);
            $table->boolean('false_ceiling')->default(0);
            $table->boolean('optical_fiber')->default(0);
            $table->boolean('attic')->default(0);
            $table->boolean('generator')->default(0);
            $table->boolean('hammam')->default(0);
            $table->boolean('high_internet')->default(0);
            $table->boolean('jacuzzi')->default(0);
            $table->boolean('winter_garden')->default(0);
            $table->boolean('ski_locker')->default(0);
            $table->boolean('bicycle_storage')->default(0);
            $table->boolean('loggia')->default(0);
            $table->boolean('net')->default(0);
            $table->boolean('hoist')->default(0);
            $table->boolean('open_plan')->default(0);
            $table->boolean('outdoor_pool')->default(0);
            $table->boolean('indoor_pool')->default(0);
            $table->boolean('ceramic_stove')->default(0);
            $table->boolean('swedish_stove')->default(0);
            $table->boolean('loading_dock')->default(0);
            $table->boolean('connection_chimney')->default(0);
            $table->boolean('connection_swedish_stove')->default(0);
            $table->boolean('reception')->default(0);
            $table->boolean('metallic_curtain')->default(0);
            $table->boolean('armed_with_fire_tap')->default(0);
            $table->boolean('do_it_yourself_room')->default(0);
            $table->boolean('theater')->default(0);
            $table->boolean('game_room')->default(0);
            $table->boolean('fitness_room')->default(0);
            $table->boolean('conference_room')->default(0);
            $table->boolean('satellite')->default(0);
            $table->boolean('sauna')->default(0);
            $table->boolean('subsoil')->default(0);
            $table->boolean('blinds')->default(0);
            $table->boolean('electric_blinds')->default(0);
            $table->boolean('thermostat_connected')->default(0);
            $table->boolean('triple_glazing')->default(0);
            $table->boolean('veranda')->default(0);
            $table->boolean('crawlspace')->default(0);
            $table->boolean('electric_shutters')->default(0);
            $table->boolean('tumble_drier')->default(0);
            $table->boolean('hair_dryer')->default(0);
            $table->boolean('satellite_tv')->default(0);
            $table->boolean('phone')->default(0);
//            // Equipement extérieur
            $table->boolean('car_shelter')->default(0);
            $table->boolean('spray')->default(0);
            $table->boolean('barbecue')->default(0);
            $table->boolean('exterior_lighting')->default(0);
            $table->boolean('drilling')->default(0);
            $table->boolean('heliport')->default(0);
            $table->boolean('well')->default(0);
            $table->boolean('source')->default(0);
//            // Immeuble
            $table->boolean('collective_lift')->default(0);
            $table->boolean('communal_laundry_room')->default(0);
            $table->boolean('network_cabling')->default(0);
            $table->boolean('collective_optical_fiber')->default(0);
            $table->boolean('parable')->default(0);
//            // Sécurité
            $table->boolean('alarm')->default(0);
            $table->boolean('magnetic_card')->default(0);
            $table->boolean('fenced')->default(0);
            $table->boolean('safe')->default(0);
            $table->boolean('digidode')->default(0);
            $table->boolean('guardian')->default(0);
            $table->boolean('caretaker')->default(0);
            $table->boolean('intercom')->default(0);
            $table->boolean('electric_gate')->default(0);
            $table->boolean('reinforced_door')->default(0);
            $table->boolean('videophone')->default(0);
//            // Vue
            $table->boolean('clear')->default(0);
            $table->boolean('impregnable')->default(0);
            $table->boolean('panoramic')->default(0);
            $table->boolean('courtyard')->default(0);
            $table->boolean('on_countryside')->default(0);
            $table->boolean('on_forest')->default(0);
            $table->boolean('on_sea')->default(0);
            $table->boolean('on_pool')->default(0);
            $table->boolean('on_river')->default(0);
            $table->boolean('on_street')->default(0);
            $table->boolean('on_city')->default(0);
            $table->boolean('on_garden')->default(0);
            $table->boolean('on_lake')->default(0);
            $table->boolean('on_park')->default(0);
            $table->boolean('on_haven')->default(0);
            $table->boolean('on_hills')->default(0);
            $table->boolean('on_mountains')->default(0);
            $table->boolean('on_ski_slopes')->default(0);
            $table->boolean('vis_a_vis')->default(0);
//            // Etat
            $table->integer('interior_condition')->nullable();
            $table->integer('type_construction')->nullable();
            $table->integer('state_front')->nullable();
            $table->integer('external_state')->nullable();
            $table->date('year_construction')->nullable();
            $table->date('year_renovation')->nullable();
//            // Exposition
            $table->integer('nord')->nullable();
            $table->integer('south')->nullable();
            $table->integer('est')->nullable();
            $table->integer('west')->nullable();
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
