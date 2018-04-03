<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta_tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page_name');
            $table->string('meta_title_ru');
            $table->string('meta_title_uk');
            $table->string('meta_description_ru');
            $table->string('meta_description_uk');
            $table->string('meta_keywords_ru');
            $table->string('meta_keywords_uk');
            $table->string('meta_h1_ru');
            $table->string('meta_h1_uk');
            $table->string('code_1c', 36)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meta_tags');
    }
}
