<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMandateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_mandate', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_mandate')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Co-exclusif',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Délégation',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Exclusif',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Exclusif agence',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Simple',
                ],
                [
                    'reference' => '6',
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
        Schema::dropIfExists('admin_mandate');
    }
}
