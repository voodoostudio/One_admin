<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_group', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_group')->insert(
            [
                [
                    'reference' => 1,
                    'locale'    => 'fr_FR',
                    'value'     => 'Communauté de biens',
                ],
                [
                    'reference' => 2,
                    'locale'    => 'fr_FR',
                    'value'     => 'Communauté universelle',
                ],
                [
                    'reference' => 3,
                    'locale'    => 'fr_FR',
                    'value'     => 'Séparation de biens',
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
        Schema::dropIfExists('admin_group');
    }
}
