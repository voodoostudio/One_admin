<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminHeatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_heating', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_heating')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Non précisé',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Central',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Collectif',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Individuel',
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
        Schema::dropIfExists('admin_heating');
    }
}
