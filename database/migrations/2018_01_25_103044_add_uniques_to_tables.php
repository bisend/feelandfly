<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUniquesToTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        
        try
        {
            Schema::table('products', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
                $table->unique('vendor_code', 'unique_vendor_code');
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('colors', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
                $table->unique('html_code', 'unique_html_code');
            });

            Schema::table('deliveries', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('images', function (Blueprint $table) {
                $table->unique('original', 'unique_original');
                $table->unique('big', 'unique_big');
                $table->unique('medium', 'unique_medium');
                $table->unique('small', 'unique_small');
            });

            Schema::table('order_statuses', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('payments', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('products_promotions', function (Blueprint $table) {
                $table->unique(['product_id', 'promotion_id'], 'unique_product_id_promotion_id');
            });

            Schema::table('product_category', function (Blueprint $table) {
                $table->unique(['product_id', 'category_id'], 'unique_product_id_category_id');
            });

//        Schema::table('product_images', function (Blueprint $table) {
//            $table->unique(['product_id', 'image_id'], 'unique_product_id_image_id');
//        });

            Schema::table('product_prices', function (Blueprint $table) {
                $table->unique(['product_id', 'user_type_id'], 'unique_product_id_user_type_id');
            });

            Schema::table('product_sizes', function (Blueprint $table) {
                $table->unique(['product_id', 'size_id'], 'unique_product_id_size_id');
            });

            Schema::table('product_stocks', function (Blueprint $table) {
                $table->unique(['product_size_id', 'user_type_id'], 'unique_product_size_id_user_type_id');
            });

            Schema::table('profiles', function (Blueprint $table) {
                $table->unique('user_id', 'unique_user_id');
            });

            Schema::table('promotions', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('properties', function (Blueprint $table) {
                $table->unique(['product_id', 'property_name_id', 'property_value_id'], 'unique_product_id_property_name_id_property_value_id');
            });

            Schema::table('property_names', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('property_values', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('sizes', function (Blueprint $table) {
                $table->unique('name_ru', 'unique_name_ru');
                $table->unique('name_uk', 'unique_name_uk');
                $table->unique('slug', 'unique_slug');
            });

            Schema::table('user_types', function (Blueprint $table) {
                $table->unique('type_ru', 'unique_type_ru');
                $table->unique('type_uk', 'unique_type_uk');
                $table->unique('slug', 'unique_slug');
            });

            DB::commit();
        } 
        catch (Exception $e) {
            DB::rollBack();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        
        try 
        {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');

            Schema::table('products', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
                $table->dropUnique('unique_vendor_code');
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('categories', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
                $table->dropUnique('unique_html_code');
            });

            Schema::table('deliveries', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('images', function (Blueprint $table) {
                $table->dropUnique('unique_original');
                $table->dropUnique('unique_big');
                $table->dropUnique('unique_medium');
                $table->dropUnique('unique_small');
            });

            Schema::table('order_statuses', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('payments', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('products_promotions', function (Blueprint $table) {
                $table->dropUnique('unique_product_id_promotion_id');
            });

            Schema::table('product_category', function (Blueprint $table) {
                $table->dropUnique('unique_product_id_category_id');
            });

//        Schema::table('product_images', function (Blueprint $table) {
//            $table->dropUnique('unique_product_id_image_id');
//        });

            Schema::table('product_prices', function (Blueprint $table) {
                $table->dropUnique('unique_product_id_user_type_id');
            });

            Schema::table('product_sizes', function (Blueprint $table) {
                $table->dropUnique('unique_product_id_size_id');
            });

            Schema::table('product_stocks', function (Blueprint $table) {
                $table->dropUnique('unique_product_size_id_user_type_id');
            });

            Schema::table('profiles', function (Blueprint $table) {
                $table->dropUnique('unique_user_id');
            });

            Schema::table('promotions', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('properties', function (Blueprint $table) {
                $table->dropUnique('unique_product_id_property_name_id_property_value_id');
            });

            Schema::table('property_names', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('property_values', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('sizes', function (Blueprint $table) {
                $table->dropUnique('unique_name_ru');
                $table->dropUnique('unique_name_uk');
                $table->dropUnique('unique_slug');
            });

            Schema::table('user_types', function (Blueprint $table) {
                $table->dropUnique('unique_type_ru');
                $table->dropUnique('unique_type_uk');
                $table->dropUnique('unique_slug');
            });

            DB::commit();
        }
        catch (Exception $e)
        {
            DB::rollBack();
        }
        
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
