<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateAutoresponderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autoresponder', function (Blueprint $table) {
            $table->increments('id');
            $table->char('subject', 255);
            $table->text('mailcontent');
            $table->char('type', 20);
            $table->dateTime('dispatch_date')->nullable();
            $table->char('time', 50)->nullable();
            $table->char('period', 50)->nullable();
            $table->char('day', 50)->nullable();
            $table->integer('month_day')->nullable();
            $table->dateTime('date')->nullable();
            $table->nullableTimestamps();
            $table->softDeletes();
        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('autoresponder');
    }
}
