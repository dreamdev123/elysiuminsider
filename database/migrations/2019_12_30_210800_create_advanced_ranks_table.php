<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateAdvancedRanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advanced_ranks', function (Blueprint $table) {
            $table->increments('id');
            $table->char('name', 50);
            $table->char('image', 200)->nullable();
            $table->integer('referral_rank')->nullable();
            $table->integer('referral_rank_count')->nullable();
            $table->integer('minimum_leg_count');
            $table->tinyInteger('is_active');
            $table->unsignedInteger('benefit')->nullable();
            $table->integer('accumulated_cycle');
            $table->integer('accumulated_cycle_preceding');
            $table->tinyInteger('need_active_referrals');
            $table->integer('second_referral_rank');
            $table->integer('second_referral_rank_count');
            $table->integer('second_referral_min_count');
            $table->integer('sponsor_line');
            $table->integer('sponsor_line_rank');
            $table->integer('investment_clients');
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
        Schema::dropIfExists('advanced_ranks');
    }
}
