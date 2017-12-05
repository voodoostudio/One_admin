<?php

use Illuminate\Database\Migrations\Migration;

class AddVoyagerUserFields extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            if (!Schema::hasColumn('users', 'avatar')) {
                $table->string('avatar')->nullable()->after('email')->default('users/default.png');
            }
            $table->integer('role_id')->nullable()->after('id');

            $table->string('middle_name',30)->default();
            $table->string('last_name',30)->default();
            $table->integer('civility')->nullable();
            $table->integer('lng_corres')->nullable();
            $table->integer('civil_status')->nullable();
            $table->string('birth_date',20)->default();
            $table->string('birthplace',40)->default();
            $table->integer('nationality')->nullable();
            $table->string('profession',50)->default();
            $table->string('service',100)->default();
            $table->string('business',100)->default();
            $table->string('website')->default();
            $table->integer('email_type')->nullable();
            $table->integer('phone_type')->nullable();
            $table->string('country_code',10)->default();
            $table->integer('phone')->nullable();
            $table->integer('preferred_means_contact')->nullable();

            /*-- Husband/Wife--*/
            $table->string('photo_coup')->nullable();
            $table->integer('civility_coup')->nullable();
            $table->integer('lng_corres_coup')->nullable();
            $table->string('first_name_coup',30)->default();
            $table->string('middle_name_coup',30)->default();
            $table->string('last_name_coup',30)->default();
            $table->integer('civil_status_coup')->nullable();
            $table->string('birth_date_coup',20)->default();
            $table->string('birthplace_coup',40)->default();
            $table->integer('nationality_coup')->nullable();
            $table->string('profession_coup',50)->default();
            $table->string('service_coup')->default();
            $table->string('business_coup')->default();
            $table->string('website_coup')->default();
            $table->integer('email_type_coup')->nullable();
            $table->string('email_coup')->default();
            $table->integer('phone_type_coup')->nullable();
            $table->string('country_code_coup',10)->default();
            $table->integer('phone_coup')->nullable();
            $table->integer('preferred_means_contact_coup')->nullable();

            /*-- Children --*/
            $table->string('photo_child')->nullable();
            $table->integer('civility_child')->nullable();
            $table->integer('lng_corres_child')->nullable();
            $table->string('first_name_child',30)->default();
            $table->string('middle_name_child',30)->default();
            $table->string('last_name_child',30)->default();
            $table->integer('civil_status_child')->nullable();
            $table->string('birth_date_child',20)->default();
            $table->string('birthplace_child',40)->default();
            $table->integer('nationality_child')->nullable();
            $table->string('profession_child',50)->default();
            $table->string('service_child')->default();
            $table->string('business_child')->default();
            $table->string('website_child')->default();
            $table->integer('email_type_child')->nullable();
            $table->string('email_child')->default();
            $table->integer('phone_type_child')->nullable();
            $table->string('country_code_child',10)->default();
            $table->integer('phone_child')->nullable();
            $table->integer('preferred_means_contact_child')->nullable();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('avatar');
            $table->dropColumn('role_id');
        });
    }
}
