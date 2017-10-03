<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_state', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_state')->insert(
            [
                [
                    'reference' => '1',
                    'locale'    => 'fr_FR',
                    'value'     => 'Non précisé',
                ],
                [
                    'reference' => '2',
                    'locale'    => 'fr_FR',
                    'value'     => 'Sur plans',
                ],
                [
                    'reference' => '3',
                    'locale'    => 'fr_FR',
                    'value'     => 'En construction',
                ],
                [
                    'reference' => '4',
                    'locale'    => 'fr_FR',
                    'value'     => 'A rénover entièrement',
                ],
                [
                    'reference' => '5',
                    'locale'    => 'fr_FR',
                    'value'     => 'Bon état',
                ],
                [
                    'reference' => '6',
                    'locale'    => 'fr_FR',
                    'value'     => 'Très bon état',
                ],
                [
                    'reference' => '7',
                    'locale'    => 'fr_FR',
                    'value'     => 'Refait à neuf',
                ],
                [
                    'reference' => '8',
                    'locale'    => 'fr_FR',
                    'value'     => 'Neuf',
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
        Schema::dropIfExists('admin_state');
    }
}
