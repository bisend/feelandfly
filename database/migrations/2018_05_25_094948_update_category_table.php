<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        // UPDATE category add colum picture_size
        Schema::table('products', function (Blueprint $table) {
            $table->string('picture_size')->nullable();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('picture_size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

    }
}
