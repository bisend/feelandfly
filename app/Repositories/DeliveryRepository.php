<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 12.12.2017
 * Time: 17:20
 */

namespace App\Repositories;


use App\DatabaseModels\Delivery;

/**
 * Class DeliveryRepository
 * @package App\Repositories
 */
class DeliveryRepository
{
    /**
     * return all deliveries
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllDeliveries($model)
    {
        return Delivery::get([
            'id',
            "name_$model->language as name",
            'slug'
        ]);
    }
}