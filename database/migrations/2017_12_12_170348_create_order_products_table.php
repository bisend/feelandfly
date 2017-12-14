<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');

            //foreign key references to id on orders table
            $table->integer('order_id')->unsigned();
            //foreign key references to id on products table
            $table->integer('product_id')->unsigned();
            
            $table->integer('size_id')->unsigned();


            //product count
            $table->integer('product_count')->unsigned();
            //product price
            $table->decimal('price', 8, 2);
            //1c
            $table->string('code_1c', 36)->nullable();
            
            $table->timestamps();

            //foreign keys
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('size_id')->references('id')->on('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
