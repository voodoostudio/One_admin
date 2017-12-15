<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            /**/
            $table->string('middle_name',30)->nullable();
            $table->string('last_name',30)->nullable();
            $table->integer('civility')->nullable();
            $table->integer('lng_corres')->nullable();
            $table->integer('civil_status')->nullable();
            $table->string('birth_date',20)->nullable();
            $table->string('birthplace',40)->nullable();
            $table->integer('nationality')->nullable();
            $table->string('profession',50)->nullable();
            $table->string('service',100)->nullable();
            $table->string('business',100)->nullable();
            $table->string('website')->nullable();
            $table->integer('email_type')->nullable();
            $table->integer('phone_type')->nullable();
            $table->string('country_code',10)->nullable();
            $table->integer('phone')->nullable();
            $table->integer('preferred_means_contact')->nullable();

            /*-- Husband/Wife--*/
            $table->string('photo_coup')->nullable();
            $table->integer('civility_coup')->nullable();
            $table->integer('lng_corres_coup')->nullable();
            $table->string('first_name_coup',30)->nullable();
            $table->string('middle_name_coup',30)->nullable();
            $table->string('last_name_coup',30)->nullable();
            $table->integer('civil_status_coup')->nullable();
            $table->string('birth_date_coup',20)->nullable();
            $table->string('birthplace_coup',40)->nullable();
            $table->integer('nationality_coup')->nullable();
            $table->string('profession_coup',50)->nullable();
            $table->string('service_coup')->nullable();
            $table->string('business_coup')->nullable();
            $table->string('website_coup')->nullable();
            $table->integer('email_type_coup')->nullable();
            $table->string('email_coup')->nullable();
            $table->integer('phone_type_coup')->nullable();
            $table->string('country_code_coup',10)->nullable();
            $table->integer('phone_coup')->nullable();
            $table->integer('preferred_means_contact_coup')->nullable();

            /*-- Children --*/
            $table->string('photo_child')->nullable();
            $table->integer('civility_child')->nullable();
            $table->integer('lng_corres_child')->nullable();
            $table->string('first_name_child',30)->nullable();
            $table->string('middle_name_child',30)->nullable();
            $table->string('last_name_child',30)->nullable();
            $table->integer('civil_status_child')->nullable();
            $table->string('birth_date_child',20)->nullable();
            $table->string('birthplace_child',40)->nullable();
            $table->integer('nationality_child')->nullable();
            $table->string('profession_child',50)->nullable();
            $table->string('service_child')->nullable();
            $table->string('business_child')->nullable();
            $table->string('website_child')->nullable();
            $table->integer('email_type_child')->nullable();
            $table->string('email_child')->nullable();
            $table->integer('phone_type_child')->nullable();
            $table->string('country_code_child',10)->nullable();
            $table->integer('phone_child')->nullable();
            $table->integer('preferred_means_contact_child')->nullable();
            /**/


            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
