<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Migration auto-generated by Sequel Pro Laravel Export (1.5.0)
 * @see https://github.com/cviebrock/sequel-pro-laravel-export
 */
class CreateLeftMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('left_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label', 191);
            $table->string('link', 191)->nullable();
            $table->integer('parent_id');
            $table->char('slug', 100);
            $table->integer('sort_order')->nullable();
            $table->longText('description')->nullable();
            $table->longText('route')->nullable();
            $table->char('icon_font', 100)->nullable();
            $table->char('icon_image', 100)->nullable();
            $table->char('routeParams', 100)->nullable();
            $table->tinyInteger('protected');

            

            

        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('left_menus');
    }
}
