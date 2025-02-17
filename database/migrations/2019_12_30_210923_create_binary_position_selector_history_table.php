<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateBinaryPositionSelectorHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('binary_position_selector_history', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('from_selector');
            $table->unsignedInteger('to_selector');
            $table->nullableTimestamps();

            $table->index('user_id', 'binary_position_selector_history_user_id_foreign');
            $table->index('from_selector', 'binary_position_selector_history_from_selector_foreign');
            $table->index('to_selector', 'binary_position_selector_history_to_selector_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('binary_position_selector_history');
    }
}
