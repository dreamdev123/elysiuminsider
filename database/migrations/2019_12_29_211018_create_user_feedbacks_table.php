<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateUserFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_feedbacks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->integer('form_id');
            $table->text('options')->nullable();
            $table->integer('rating');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->index('user_id', 'user_id');

            $table->foreign('user_id', 'user_feedbacks_ibfk_1')->references('id')->on('users')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('user_id', 'user_feedbacks_ibfk_2')->references('id')->on('users')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('user_id', 'user_feedbacks_ibfk_3')->references('id')->on('users')->onDelete('RESTRICT
')->onUpdate('RESTRICT');

        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_feedbacks');
    }
}
