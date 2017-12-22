<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');

            //foreign key references to id on products table
            $table->integer('product_id')->unsigned();
            //foreign key references to id on users table
            $table->integer('user_id')->unsigned()->nullable();
            $table->boolean('is_moderated')->default(0);
            //review text
            $table->text('review');
            $table->string('name');
            $table->string('email');
            $table->decimal('rating', 8, 2);
            //1c
            $table->string('code_1c', 36)->nullable();
            $table->timestamps();

            //foreign keys
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
