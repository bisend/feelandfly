<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 15.11.2017
 * Time: 15:03
 */

namespace App\Repositories;

use DB;

/**
 * Class FilterRepository
 * @package App\Repositories
 */
class FilterRepository
{
    /**
     * init filters for category
     * @param $model
     * @return array
     */
    public function initFilters($model)
    {
        $query = "SELECT
                      property_names.id          AS filter_name_id,
                      property_values.id         AS filter_value_id,
                      property_names.slug        AS filter_name_slug,
                      property_values.slug       AS filter_value_slug,
                      property_names.name_" . $model->language . " AS filter_name_title,
                      property_values.name_" . $model->language . " AS filter_value_title,
                      filter_products_count
                    FROM
                    (
                        SELECT
                          properties.property_name_id,
                          properties.property_value_id,
                          COUNT(DISTINCT products.id) AS filter_products_count
                        FROM properties
                        JOIN products
                          ON properties.product_id = products.id AND products.is_visible = true
                        JOIN product_category
                          ON products.id = product_category.product_id AND product_category.category_id = " . $model->currentCategory->id . "
                        GROUP BY properties.property_name_id, properties.property_value_id
                      ) properties
                  JOIN property_names
                    ON property_names.id = properties.property_name_id
                  JOIN property_values
                    ON property_values.id = properties.property_value_id
                  ORDER BY property_names.id, property_values.id";
        
        return DB::select($query);
    }

    /**
     * init active filters
     * @param $model
     * @return array
     */
    public function initActiveFilters($model)
    {
        $activeFiltersQuery = "";

        foreach ($model->parsedFilters as $filterName => $values)
        {
            $filterValues = '';
            
            foreach ($values as $value){
                $filterValues .= "'$value',";
            }
            $filterValues = rtrim($filterValues, ',');
            
            $activeFiltersQuery .= "
                        AND
                        ((property_names.slug = '$filterName' AND property_values.slug NOT IN ($filterValues))
                         OR
                         EXISTS(
                         SELECT 1
                         FROM properties
                           JOIN property_names
                             ON properties.property_name_id = property_names.id
                           JOIN property_values
                             ON properties.property_value_id = property_values.id
                         WHERE
                           properties.product_id = products.id
                           AND
                           property_names.slug = '$filterName'
                           AND
                           property_values.slug IN ($filterValues))) ";
        }

        $priceQuery = '';

        if ($model->priceMin && $model->priceMax)
        {
            $priceQuery = "
                          JOIN product_prices
                            ON product_prices.product_id = products.id 
                            AND product_prices.user_type_id = " . $model->userTypeId . "  AND product_prices.price between ". $model->priceMin . " and " . $model->priceMax . "
                          ";
        }

        $query = "SELECT
                      property_names.id          AS filter_name_id,
                      property_values.id         AS filter_value_id,
                      property_names.slug        AS filter_name_slug,
                      property_values.slug       AS filter_value_slug,
                      property_names.name_" . $model->language . " AS filter_name_title,
                      property_values.name_" . $model->language . " AS filter_value_title,
                      filter_products_count
                    FROM
                    (
                        SELECT
                          properties.property_name_id,
                          properties.property_value_id,
                          COUNT(DISTINCT products.id) AS filter_products_count
                        FROM properties
                        JOIN property_names
                          ON property_names.id = properties.property_name_id
                        JOIN property_values
                          ON property_values.id = properties.property_value_id
                        JOIN products
                          ON properties.product_id = products.id AND products.is_visible = true
                        " . $priceQuery . "
                        JOIN product_category
                          ON products.id = product_category.product_id AND product_category.category_id = " . $model->currentCategory->id . "
                        " . $activeFiltersQuery . "
                        GROUP BY properties.property_name_id, properties.property_value_id
                      ) properties
                  JOIN property_names
                    ON property_names.id = properties.property_name_id
                  JOIN property_values
                    ON property_values.id = properties.property_value_id
                  ORDER BY property_names.id, property_values.id";

        return DB::select($query);
    }
}