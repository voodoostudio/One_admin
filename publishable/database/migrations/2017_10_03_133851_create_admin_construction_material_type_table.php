<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminConstructionMaterialTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_construction_material_type', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_construction_material_type')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Béton',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Brique',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Bois Traditionnel',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'Préfabriqué',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Rondin',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Pierre',
                ],
                [
                    'reference' => '7',
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
        Schema::dropIfExists('admin_construction_material_type');
    }
}
