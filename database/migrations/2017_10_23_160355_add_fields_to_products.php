<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('color_id')->after('slug')->unsigned()->nullable();
            $table->integer('group_id')->after('slug')->unsigned()->nullable();

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
        Schema::table('products', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $table->dropForeign('color_id');
            $table->dropForeign('group_id');

            $table->dropColumn('color_id');
            $table->dropColumn('group_id');
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        });
    }
}