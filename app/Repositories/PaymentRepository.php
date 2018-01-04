<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 12.12.2017
 * Time: 17:19
 */

namespace App\Repositories;


use App\DatabaseModels\Payment;

/**
 * Class PaymentRepository
 * @package App\Repositories
 */
class PaymentRepository
{
    /**
     * return all payments
     * @param $model
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllPayments($model)
    {
        return Payment::get([
            'id',
            "name_$model->language as name",
            'slug'
        ]);
    }
}