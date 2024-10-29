<?php

use App\Http\Validators\Panel\User\AccountInformationValidator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalUserAccountInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('capital_user_account_information');
        Schema::create('capital_user_account_information', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('capital_user_id')->unsigned();

            $table->enum('account_type', AccountInformationValidator::$account_type);
            $table->enum('currency', AccountInformationValidator::$currency);
            $table->enum('platform', AccountInformationValidator::$platform);
            $table->enum('client', AccountInformationValidator::$client);
            $table->enum('purpose', AccountInformationValidator::$purpose);
            $table->enum('avarge_trading_volume', AccountInformationValidator::$avarge_trading_volume);
            $table->enum('leverage', AccountInformationValidator::$leverage);
            $table->enum('experience_years', AccountInformationValidator::$experience_years);
            $table->enum('trading_frequency', AccountInformationValidator::$trading_frequency);

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
        Schema::dropIfExists('capital_user_account_information');
    }
}
