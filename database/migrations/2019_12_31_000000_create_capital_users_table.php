<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsiderUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('insider_users');
        Schema::create('insider_users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->integer('user_id')->nullable()->unsigned();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('status', ['enabled', 'disabled'])->default('enabled');
            $table->unsignedInteger('country_id')->nullable(); // active = 1
            $table->string('phone', 17)->nullable();
            $table->string('street_address', 100)->nullable();
            $table->string('city', 60)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('state', 64)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('scm_app_key', 32)->nullable();
            $table->enum('scm_status', ['not_connected', 'added', 'open', 'rejected', 'accepted'])->default('not_connected');
            $table->string('scm_login', 64)->nullable();
            $table->rememberToken();
            $table->string('email_verification_token', 128)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('ip', 15)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('set null');

            $table->unique('scm_app_key');
            $table->unique('scm_login');
            $table->unique('email_verification_token');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insider_users');
    }
}
