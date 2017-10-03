<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRadiatorTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_radiator_type', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_radiator_type')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Non précisé',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Eau chaude',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur électrique',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur au sol',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur soufflant',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur à accumulation',
                ],
                [
                    'reference' => '7',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur transversal',
                ],
                [
                    'reference' => '8',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur a nid d\'abeilles',
                ],
                [
                    'reference' => '9',
                    'locale'    => 'fr_FR',
                    'value'     => 'Radiateur à ailettes',
                ],
                [
                    'reference' => '10',
                    'locale'    => 'fr_FR',
                    'value'     => 'Autre',
                ],
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_radiator_type');
    }
}
