<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_size_id')->unsigned();
            $table->integer('user_type_id')->unsigned();
            $table->integer('stock')->unsigned()->default(0);
            $table->integer('priority')->default(1000);
            $table->timestamps();

            $table->foreign('product_size_id')->references('id')->on('product_sizes');
            $table->foreign('user_type_id')->references('id')->on('user_types');

            $table->unique(['product_size_id', 'user_type_id'], 'unique_product_size_id_user_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_stocks');
    }
}
