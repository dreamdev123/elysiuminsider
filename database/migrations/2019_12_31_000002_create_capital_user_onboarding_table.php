<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalUserOnBoardingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('capital_user_onboarding');
        Schema::create('capital_user_onboarding', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('capital_user_id')->unsigned();
            $table->boolean('personal_information')->default(false);
            $table->boolean('account_information')->default(false);
            $table->boolean('additional_information')->default(false);
            $table->boolean('proof_of_identity_and_residence')->default(false);
            $table->boolean('verify_email')->default(false);

            $table->timestamps();

            $table->unique('capital_user_id');

            $table->foreign('capital_user_id')->references('id')->on('capital_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capital_user_onboarding');
    }
}
