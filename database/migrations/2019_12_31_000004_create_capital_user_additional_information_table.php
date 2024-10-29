<?php

use App\Http\Validators\Panel\User\AdditionalInformationValidator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalUserAdditionalInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('capital_user_additional_information');
        Schema::create('capital_user_additional_information', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('capital_user_id')->unsigned();

            $table->enum('estimate_annual_gross_income', AdditionalInformationValidator::$estimate_annual_gross_income);
            $table->enum('net_worth', AdditionalInformationValidator::$net_worth);
            $table->enum('income_source', AdditionalInformationValidator::$income_source);
            $table->enum('education', AdditionalInformationValidator::$education);
            $table->enum('language', AdditionalInformationValidator::$language);
            $table->enum('public_position_held', AdditionalInformationValidator::$public_position_held);
            $table->string('public_position_details', 512)->nullable();

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
        Schema::dropIfExists('capital_user_additional_information');
    }
}
