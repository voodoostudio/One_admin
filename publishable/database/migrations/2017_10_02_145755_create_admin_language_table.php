<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_language', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_language')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Anglais',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Espagnol',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'Français',
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
        Schema::dropIfExists('admin_language');
    }
}
