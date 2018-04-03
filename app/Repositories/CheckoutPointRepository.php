<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 16.03.2018
 * Time: 11:17
 */

namespace App\Repositories;


use App\DatabaseModels\CheckoutPoint;

class CheckoutPointRepository
{
    public function getCheckoutPoints($model)
    {
        return CheckoutPoint::whereIsVisible(true)
            ->orderBy('priority')
            ->get([
                'id',
                "name_$model->language as name",
                'slug'
            ]);
    }
}