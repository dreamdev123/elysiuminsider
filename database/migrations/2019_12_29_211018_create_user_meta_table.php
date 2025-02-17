<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateUserMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_meta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->date('dob')->default('2019-05-21');
            $table->string('address', 200);
            $table->unsignedInteger('country_id')->default(0);
            $table->unsignedInteger('state_id')->default(110);
            $table->unsignedInteger('city_id')->default(100);
            $table->char('gender', 1)->default(0);
            $table->string('type_of_document', 50);
            $table->string('passport_no', 50);
            $table->string('nationality', 50);
            $table->string('place_of_birth', 50);
            $table->string('date_of_passport_issuance', 10);
            $table->integer('country_of_passport_issuance');
            $table->string('passport_expirition_date', 10)->nullable();
            $table->string('street_name', 50);
            $table->integer('house_no');
            $table->integer('postcode');
            $table->integer('address_country');
            $table->string('city', 50)->nullable();
            $table->string('additional_info', 50)->nullable();
            $table->string('bank_name', 50)->nullable();
            $table->string('acc_number', 50)->nullable();
            $table->bigInteger('pin')->default(0);
            $table->text('profile_pic');
            $table->text('about_me');
            $table->text('facebook');
            $table->text('twitter');
            $table->text('linked_in');
            $table->text('google_plus');
            $table->nullableTimestamps();

            $table->unique('user_id', 'user_meta_user_id_unique');
            $table->index('country_id', 'country_id');
            $table->index('state_id', 'state_id');
            $table->index('city_id', 'city_id');

            $table->foreign('user_id', 'user_meta_ibfk_1')->references('id')->on('users')->onDelete('RESTRICT')->onUpdate('RESTRICT');
            $table->foreign('country_id', 'user_meta_ibfk_2')->references('id')->on('countries')->onDelete('RESTRICT')->onUpdate('RESTRICT');

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_meta');
    }
}
