<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePropertyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update property add colum is_visible
        Schema::table('property_values', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true);
        });
        Schema::table('property_names', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true);
        });
        Schema::table('properties', function (Blueprint $table) {
            $table->boolean('is_visible')->default(true);
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
