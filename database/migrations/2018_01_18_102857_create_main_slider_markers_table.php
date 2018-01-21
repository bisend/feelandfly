<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainSliderMarkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_slider_markers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('slide_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('position_x')->nullable();
            $table->integer('position_y')->nullable();
            $table->integer('priority')->default(1000);
            $table->boolean('is_visible')->default(true);
            $table->string('code_1c', 36)->nullable();

            $table->timestamps();

            $table->foreign('slide_id')->references('id')->on('main_slider');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('main_slider_markers');
    }
}
