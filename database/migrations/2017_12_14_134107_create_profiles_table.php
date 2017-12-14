<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');

            //foreign key references to id on users table
            $table->integer('user_id')->unsigned();
            //foreign key references to id on payments table
            $table->integer('payment_id')->unsigned()->nullable();
            //foreign key references to id on deliveries table
            $table->integer('delivery_id')->unsigned()->nullable();

            //phone number
            $table->string('phone_number')->nullable();
            //address
            $table->string('address_delivery')->nullable();
            //1c
            $table->string('code_1c', 36)->nullable();
            //created at updated at
            $table->timestamps();

            //foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('payment_id')->references('id')->on('payments');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
