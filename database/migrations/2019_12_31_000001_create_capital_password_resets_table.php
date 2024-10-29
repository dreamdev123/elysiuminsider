<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitalPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::dropIfExists('capital_password_resets');
        Schema::create('capital_user_password_resets', static function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('capital_user_id')->unsigned();
            $table->string('token', 128);
            $table->string('generated_ip', 15)->nullable()->default( NULL );
            $table->string('used_ip', 15)->nullable()->default( NULL );
            $table->timestamp('used_at')->nullable();
            $table->timestamps();

            $table->unique('token');
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
        Schema::dropIfExists('capital_user_password_resets');
    }
}
