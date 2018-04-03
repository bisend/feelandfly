<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 03.04.2018
 * Time: 17:31
 */

namespace App\Repositories;


use App\DatabaseModels\DeliveryType;

class DeliveryTypeRepository
{
    public function getDeliveryTypes($model)
    {
        return DeliveryType::whereIsVisible(true)
            ->get([
                'id',
                "name_$model->language as name",
                "slug",
            ]);
    }
}