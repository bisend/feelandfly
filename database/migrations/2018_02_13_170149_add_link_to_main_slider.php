<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLinkToMainSlider extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('main_slider', function (Blueprint $table) {
            $table->string('url_uk')->after('image_id')->nullable();
            $table->string('url_ru')->after('image_id')->nullable();
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
            $table->dropColumn('url_uk');
            $table->dropColumn('url_ru');
        });
    }
}
