<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminOriginTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_origin', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_origin')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Ancien client',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Apporteur',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Collaborateur',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'e-mailing',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Internet',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Journal',
                ],
                [
                    'reference' => '7',
                    'locale'    => 'fr_FR',
                    'value'     => 'Magazine',
                ],
                [
                    'reference' => '8',
                    'locale'    => 'fr_FR',
                    'value'     => 'Mailing',
                ],
                [
                    'reference' => '9',
                    'locale'    => 'fr_FR',
                    'value'     => 'Marchand',
                ],
                [
                    'reference' => '10',
                    'locale'    => 'fr_FR',
                    'value'     => 'Notoriété',
                ],
                [
                    'reference' => '11',
                    'locale'    => 'fr_FR',
                    'value'     => 'Panneau',
                ],
                [
                    'reference' => '12',
                    'locale'    => 'fr_FR',
                    'value'     => 'Passage/Vitrine',
                ],
                [
                    'reference' => '13',
                    'locale'    => 'fr_FR',
                    'value'     => 'Pige',
                ],
                [
                    'reference' => '14',
                    'locale'    => 'fr_FR',
                    'value'     => 'Prospection',
                ],
                [
                    'reference' => '15',
                    'locale'    => 'fr_FR',
                    'value'     => 'Prospectus',
                ],
                [
                    'reference' => '16',
                    'locale'    => 'fr_FR',
                    'value'     => 'Relation',
                ],
                [
                    'reference' => '17',
                    'locale'    => 'fr_FR',
                    'value'     => 'Salon',
                ],
                [
                    'reference' => '18',
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
        Schema::dropIfExists('admin_origin');
    }
}
