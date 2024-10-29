<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoundersLaunchTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('capital_users');
        Schema::create('founders_launch', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('email')->unique();
            $table->string('ip', 15)->nullable();
            $table->string('iso_code', 64)->nullable();
            $table->string('country', 128)->nullable();
            $table->string('city', 128)->nullable();
            $table->string('state', 64)->nullable();
            $table->string('state_name', 512)->nullable();
            $table->string('postal_code', 64)->nullable();

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
        Schema::dropIfExists('founders_launch');
    }
}
