<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_status', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_status')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Actif',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Chantier ouvert',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Contrat expiré',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Contrat résilié',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'En cours d\'insertion',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Loué',
                ],
                [
                    'reference' => '7',
                    'locale'    => 'fr_FR',
                    'value'     => 'Loué par la concurrence',
                ],
                [
                    'reference' => '8',
                    'locale'    => 'fr_FR',
                    'value'     => 'Nouveau',
                ],
                [
                    'reference' => '9',
                    'locale'    => 'fr_FR',
                    'value'     => 'Prospect',
                ],
                [
                    'reference' => '10',
                    'locale'    => 'fr_FR',
                    'value'     => 'Réservé',
                ],
                [
                    'reference' => '11',
                    'locale'    => 'fr_FR',
                    'value'     => 'Réservé par la proprétaire',
                ],
                [
                    'reference' => '12',
                    'locale'    => 'fr_FR',
                    'value'     => 'Suspendu',
                ],
                [
                    'reference' => '13',
                    'locale'    => 'fr_FR',
                    'value'     => 'Vendu',
                ],
                [
                    'reference' => '14',
                    'locale'    => 'fr_FR',
                    'value'     => 'Vendu par la concurrence',
                ],
                [
                    'reference' => '15',
                    'locale'    => 'fr_FR',
                    'value'     => 'Vendu par la proprétaire',
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
        Schema::dropIfExists('admin_status');
    }
}
