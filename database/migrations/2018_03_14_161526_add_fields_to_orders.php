<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToOrders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('checkout_point')->nullable();
            $table->string('np_delivery_type')->nullable();
            $table->string('country')->nullable();
            $table->string('np_city')->nullable();
            $table->string('np_city_ref')->nullable();
            $table->string('np_warehouse')->nullable();
            $table->string('np_warehouse_ref')->nullable();
            $table->string('a_street')->nullable();
            $table->string('a_land')->nullable();
            $table->string('a_city')->nullable();
            $table->string('post_index')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('checkout_point');
            $table->dropColumn('np_delivery_type');
            $table->dropColumn('country');
            $table->dropColumn('np_city');
            $table->dropColumn('np_city_ref');
            $table->dropColumn('np_warehouse');
            $table->dropColumn('np_warehouse_ref');
            $table->dropColumn('a_street');
            $table->dropColumn('a_land');
            $table->dropColumn('a_city');
            $table->dropColumn('post_index');
        });
    }
}
