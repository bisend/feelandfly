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
            $table->integer('user_id')->unsigned();
            $table->integer('delivery_id')->unsigned()->nullable();
            $table->integer('checkout_point_id')->unsigned()->nullable();
            $table->integer('delivery_type_id')->unsigned()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('country_name')->nullable();
            $table->string('country_code')->nullable();
            $table->string('np_city')->nullable();
            $table->string('np_city_ref')->nullable();
            $table->string('np_warehouse')->nullable();
            $table->string('np_warehouse_ref')->nullable();
            $table->string('a_street')->nullable();
            $table->string('a_land')->nullable();
            $table->string('a_city')->nullable();
            $table->string('post_index')->nullable();
            $table->string('code_1c', 36)->nullable();
            $table->timestamps();

            //foreign keys
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('delivery_id')->references('id')->on('deliveries');
            $table->foreign('checkout_point_id')->references('id')->on('checkout_points');
            $table->foreign('delivery_type_id')->references('id')->on('delivery_types');
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
