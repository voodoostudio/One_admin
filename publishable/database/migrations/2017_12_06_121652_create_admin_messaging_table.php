<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMessagingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_messaging', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_messaging')->insert(
            [
                [
                    'reference' => 1,
                    'locale'    => 'fr_FR',
                    'value'     => 'AIM',
                ],
                [
                    'reference' => 2,
                    'locale'    => 'fr_FR',
                    'value'     => 'Facebook',
                ],
                [
                    'reference' => 3,
                    'locale'    => 'fr_FR',
                    'value'     => 'Gadu-Gadu',
                ],
                [
                    'reference' => 4,
                    'locale'    => 'fr_FR',
                    'value'     => 'Google Talk',
                ],
                [
                    'reference' => 5,
                    'locale'    => 'fr_FR',
                    'value'     => 'ICQ',
                ],
                [
                    'reference' => 6,
                    'locale'    => 'fr_FR',
                    'value'     => 'abber',
                ],
                [
                    'reference' => 7,
                    'locale'    => 'fr_FR',
                    'value'     => 'MSN',
                ],
                [
                    'reference' => 8,
                    'locale'    => 'fr_FR',
                    'value'     => 'QQ',
                ],
                [
                    'reference' => 9,
                    'locale'    => 'fr_FR',
                    'value'     => 'Skype',
                ],
                [
                    'reference' => 10,
                    'locale'    => 'fr_FR',
                    'value'     => 'Yahoo',
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
        Schema::dropIfExists('admin_messaging');
    }
}
