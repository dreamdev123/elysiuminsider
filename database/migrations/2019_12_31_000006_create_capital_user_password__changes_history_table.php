<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsiderUserPasswordChangesHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('insider_user_password_changes_history');
        Schema::create('insider_user_password_changes_history', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('insider_user_id')->unsigned();
            $table->string('ip', 15)->nullable()->default( NULL );
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
        Schema::dropIfExists('insider_user_password_changes_history');
    }
}
