<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            //primary key
            $table->increments('id');
            
            //foreign key references to id on users table
            $table->integer('user_id')->nullable()->unsigned();
            //foreign key references to id on payments table
            $table->integer('payment_id')->unsigned();
            //foreign key references to id on deliveries table
            $table->integer('delivery_id')->unsigned();
            
            $table->integer('status_id')->unsigned();
            

            //total products count
            $table->integer('total_products_count')->unsigned();
            //total order amount
            $table->decimal('total_order_amount', 8, 2);
            //address delivery
            $table->string('address_delivery');
            //user email
            $table->string('email');
            //name of user
            $table->string('name');
            //phone number of user
            $table->string('phone_number');
            //order number
            $table->integer('order_number')->nullable();
            //comment to order
            $table->text('comment')->nullable();
            //1c
            $table->string('code_1c', 36)->nullable();
            //created at updated at
            $table->timestamps();


            //foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->foreign('status_id')->references('id')->on('order_statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
