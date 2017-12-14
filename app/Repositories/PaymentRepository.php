<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 12.12.2017
 * Time: 17:19
 */

namespace App\Repositories;


use App\DatabaseModels\Payment;

class PaymentRepository
{
    public function getAllPayments($model)
    {
        return Payment::get([
            'id',
            "name_$model->language as name",
            'slug'
        ]);
    }
}