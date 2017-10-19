<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     */
    public function run()
    {
//        $post = $this->findPost('my-sample-post');
//        if (!$post->exists) {
//            $post->fill([
//                'title'             => 'My Sample Post',
//                'exclusiveness'     => 1,
//                'author_id'         => 0,
//                'seo_title'         => null,
//                'excerpt'           => 'This is the excerpt for the sample Post',
//                'body'              => '<p>This is the body for the sample post, which includes the body.</p>
//                <h2>We can use all kinds of format!</h2>
//                <p>And include a bunch of other stuff.</p>',
//                'image'             => 'posts/post2.jpg',
//                'slug'              => 'my-sample-post',
//                'meta_description'  => 'Meta Description for sample post',
//                'meta_keywords'     => 'keyword1, keyword2, keyword3',
//                'reference'         => 'Some reference',
//                'note_transaction'  => 'Nice transaction',
//                'broker_notes'      => 'All right',
//                'important_notes'   => 'Very good',
//                'owner_notes'       => 'All right',
//                'mandate_start'     => '2017-09-25 08:00:00',
//                'term_end'          => '2017-10-20 18:00:00',
//                'availability'      => '2017-10-15 18:00:00',
//                'availab_from'      => '2017-09-28 18:00:00',
//                'availab_until'     => '2017-10-25 18:00:00',
//                'status'            => 'PUBLISHED',
//                'address'           => 'Address',
//                'street'            => 'Angel ST.',
//                'number'            => '',
//                'po_box'            => '',
//                'zip_code'          => '',
//                'town'              => '',
//                'country'           => '',
//                'location'          => '',
//                'longitude'         => '',
//                'latitude'          => '',
//                'lng_of_add'        => '1',
//                'add_title'         => '',
//                'desc_add'          => '',
//                'сurrency'          => '1',
//                'show_price'        => '0',
//                'price'             => '',
//                'price_m2'             => '',
//                'gross_yield'             => '',
//                'net_return'             => '',
//                'owner_amount'             => '',
//                'client_fees'             => '',
//                'owner_fees'             => '',
//                'negotiable_amount'             => '',
//                'estimate_price'             => '',
//                'recording_rights'             => '',
//                'regime'             => '1',
//                'heating_loads'             => '',
//                'ppe_charges'             => '',
//                'condominium_fees'             => '',
//                'property_tax'             => '1',
//                'procedure_in_progress'             => '1',
//                'renovation_fund'             => '',
//                'annual_charges'             => '',
//                'rental_security'             => '',
//                'commercial_property'             => '',
//                'earnings'             => '',
//                'taxes'             => '',
//                // Agencement
//                'number_rooms'             => '',
//                'number_pieces'             => '',
//                'number_balconies'             => '',
//                'number_shower_rooms'             => '',
//                'number_toilets'             => '',
//                'number_terraces'             => '',
//                'number_floors_building'             => '',
//                'floor_property'             => '1',
//                'levels'             => '',
//                // surface
//                'surface_cellar'             => '',
//                'ceiling_height'             => '',
//                'roof_cover_area'             => '',
//                'surface_area_terrace_solarium'             => '',
//                'area_veranda'             => '',
//                'attic_space'             => '',
//                'surface_balcony'             => '',
//                'basement_area'             => '',
//                'surface_ground'             => '',
//                'ground'             => '',
//                'serviced'             => '',
//                'type_land'             => '1',
//                'useful_surface'             => '',
//                'ppe_area'             => '',
//                'volume'             => '',
//                'surface_eng_court'             => '',
//                'lower_ground_floor'             => '',
//                'row_area'             => '',
//                'garage_area'             => '',
//                'weighted_surface'             => '',
//                // Stationnement
//                'box_interior_garage'             => '',
//                'box_garage_interior_double'             => '',
//                'outdoor_garage'             => '',
//                'box_garage_outside_double'             => '',
//                'covered_outdoor_parking_space'             => '',
//                'outside_parking_space_uncovered'             => '',
//                'number_parking_spaces'             => '',
//                'boat_shed'             => '',
//                'mooring'             => '',
//                // Cuisine
//                'type'             => '1',
//                'freezer'             => '0',
//                'cooker'             => '0',
//                'oven'             => '1',
//                'microwave_oven'             => '',
//                'extractor_hood'             => '',
//                'washmachine'             => '',
//                'dishwasher'             => '0',
//                'plates'             => '0',
//                'induction_plates'             => '0',
//                'hotplates'             => '1',
//                'ceramic_plates'             => '0',
//                'fridge'             => '0',
//                'tumble_drier'             => '0',
//                'coffee_maker'             => '0',
//
//
//            ])->save();
//        }
    }

    /**
     * [post description].
     *
     * @param [type] $slug [description]
     *
     * @return [type] [description]
     */
    protected function findPost($slug)
    {
        return Post::firstOrNew(['slug' => $slug]);
    }
}
