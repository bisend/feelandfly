<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('image_id')->unsigned();
            $table->string('title_ru')->unique();
            $table->string('title_uk')->unique();
            $table->string('slug')->unique();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->text('short_description_ru')->nullable();
            $table->text('short_description_uk')->nullable();
            $table->integer('number_of_views')->unsigned()->default(0);

            $table->string('code_1c')->nullable();
            $table->integer('priority')->default(1000);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->foreign('image_id')->references('id')->on('images');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blogs');
    }
}
