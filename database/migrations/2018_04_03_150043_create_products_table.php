<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('color_id')->unsigned()->nullable();
            $table->integer('group_id')->unsigned()->nullable();
//            $table->integer('meta_tag_id')->nullable()->unsigned();
            $table->integer('breadcrumb_category_id')->nullable()->unsigned();
            $table->string('name_ru')->unique();
            $table->string('name_uk')->unique();
            $table->string('slug')->unique();
            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->integer('priority')->default(1000);
            $table->string('vendor_code')->nullable();
            $table->decimal('rating', 8, 2)->nullable();
            $table->integer('number_of_views')->unsigned()->default(0);
            $table->boolean('is_visible')->default(true);
            $table->string('code_1c', 36)->nullable();
            //meta
            $table->text('meta_title_ru')->nullable();
            $table->text('meta_title_uk')->nullable();
            $table->text('meta_description_ru')->nullable();
            $table->text('meta_description_uk')->nullable();
            $table->text('meta_keywords_ru')->nullable();
            $table->text('meta_keywords_uk')->nullable();
            $table->text('meta_h1_ru')->nullable();
            $table->text('meta_h1_uk')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('breadcrumb_category_id')->references('id')->on('categories');
            $table->foreign('color_id')->references('id')->on('colors');
            $table->foreign('group_id')->references('id')->on('product_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
