<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLocalisationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_localisation', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_localisation')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Banlieue',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Bord de mer',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Campagne',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Centre commercial',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Centre ville',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Hauteurs',
                ],
                [
                    'reference' => '7',
                    'locale'    => 'fr_FR',
                    'value'     => 'Périphérie',
                ],
                [
                    'reference' => '8',
                    'locale'    => 'fr_FR',
                    'value'     => 'Pieds dans l\'eau',
                ],
                [
                    'reference' => '9',
                    'locale'    => 'fr_FR',
                    'value'     => 'Piste de ski',
                ],
                [
                    'reference' => '10',
                    'locale'    => 'fr_FR',
                    'value'     => 'Technopolé',
                ],
                [
                    'reference' => '11',
                    'locale'    => 'fr_FR',
                    'value'     => 'Veille ville',
                ],
                [
                    'reference' => '12',
                    'locale'    => 'fr_FR',
                    'value'     => 'Village',
                ],
                [
                    'reference' => '13',
                    'locale'    => 'fr_FR',
                    'value'     => 'Zone aéroportuaire',
                ],
                [
                    'reference' => '14',
                    'locale'    => 'fr_FR',
                    'value'     => 'Zone d\'activité',
                ],
                [
                    'reference' => '15',
                    'locale'    => 'fr_FR',
                    'value'     => 'Zone piétonne',
                ],
                [
                    'reference' => '16',
                    'locale'    => 'fr_FR',
                    'value'     => 'Zone portuaire',
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
        Schema::dropIfExists('admin_localisation');
    }
}
