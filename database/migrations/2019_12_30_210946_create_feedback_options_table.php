<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateFeedbackOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback_options', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('form_id');
            $table->text('feedback_option')->nullable();
            $table->integer('status');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->index('form_id', 'form_id');

            $table->foreign('form_id', 'feedback_options_ibfk_1')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_10')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_11')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_12')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_2')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_3')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_4')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_5')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_6')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_7')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_8')->references('id')->on('feedback_forms')->onDelete('RESTRICT
')->onUpdate('RESTRICT');
            $table->foreign('form_id', 'feedback_options_ibfk_9')->references('id')->on('feedback_forms')->onDelete('RESTRICT
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
        Schema::dropIfExists('feedback_options');
    }
}
