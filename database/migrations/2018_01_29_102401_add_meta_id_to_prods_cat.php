<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaIdToProdsCat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('meta_tag_id')->after('category_id')->unsigned()->nullable();
            $table->foreign('meta_tag_id')->references('id')->on('meta_tags');
        });

        Schema::table('categories', function (Blueprint $table) {
            $table->integer('meta_tag_id')->after('parent_id')->unsigned()->nullable();
            $table->foreign('meta_tag_id')->references('id')->on('meta_tags');
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
           $table->dropColumn('meta_tag_id');
        });

        Schema::table('categories', function (Blueprint $table) {
           $table->dropColumn('meta_tag_id');
        });
    }
}
