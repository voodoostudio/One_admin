<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_phones', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_phones')->insert(
            [
                [
                    'reference' => 1,
                    'locale'    => 'fr_FR',
                    'value'     => 'Portable',
                ],
                [
                    'reference' => 2,
                    'locale'    => 'fr_FR',
                    'value'     => 'Domicile',
                ],
                [
                    'reference' => 3,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bureau',
                ],
                [
                    'reference' => 4,
                    'locale'    => 'fr_FR',
                    'value'     => 'Principal',
                ],
                [
                    'reference' => 5,
                    'locale'    => 'fr_FR',
                    'value'     => 'Fax domicile',
                ],
                [
                    'reference' => 6,
                    'locale'    => 'fr_FR',
                    'value'     => 'Fax bureau',
                ],
                [
                    'reference' => 7,
                    'locale'    => 'fr_FR',
                    'value'     => 'Téléavertisseur',
                ],
                [
                    'reference' => 8,
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
        Schema::dropIfExists('admin_phones');
    }
}
