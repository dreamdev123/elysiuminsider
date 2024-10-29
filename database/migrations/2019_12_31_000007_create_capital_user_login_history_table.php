<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsiderUserLoginHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('insider_user_login_history');
        Schema::create('insider_user_login_history', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('insider_user_id')->unsigned()->nullable();
            $table->string('ip', 15)->nullable()->default( NULL );
            $table->string('email')->nullable();
            $table->enum('action', ['attempt', 'login', 'logout'])->default('attempt');
            $table->timestamps();

            $table->foreign('insider_user_id')->references('id')->on('insider_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insider_user_login_history');
    }
}
