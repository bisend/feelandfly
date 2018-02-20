<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeImageSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_slider', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $table->string('image')->after('id')->unique();
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('main_slider', function (Blueprint $table) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
            $table->dropColumn('image');
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        });
    }
}
