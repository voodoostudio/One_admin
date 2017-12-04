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
            $table->string('place_birth',40)->default();
            $table->string('nationality')->nullable();
            $table->string('profession',50)->default();
            $table->string('service',100)->default();
            $table->string('business',100)->default();
            $table->string('website')->default();
            $table->integer('email_type')->nullable();
            $table->integer('phone_type')->nullable();
            $table->string('country_code',10)->default();
            $table->integer('phone')->nullable();
            $table->integer('preferred_means_contact')->nullable();
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
