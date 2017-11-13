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
            $table->string('name_ru');
            $table->string('name_uk');
            $table->string('slug');

            $table->integer('category_id')->unsigned();
            $table->integer('breadcrumb_category_id')->nullable()->unsigned();

            $table->text('description_ru')->nullable();
            $table->text('description_uk')->nullable();
            $table->integer('priority')->default(1000);
            $table->string('vendor_code')->nullable();
            $table->decimal('rating', 8, 2)->nullable();
            $table->integer('number_of_views')->default(0);
            $table->string('code_1c', 36)->nullable();

            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('breadcrumb_category_id')->references('id')->on('categories');
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
