<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_emails', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_emails')->insert(
            [
                [
                    'reference' => 1,
                    'locale'    => 'fr_FR',
                    'value'     => 'Domicile',
                ],
                [
                    'reference' => 2,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bureau',
                ],
                [
                    'reference' => 3,
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
        Schema::dropIfExists('admin_emails');
    }
}
