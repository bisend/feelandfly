<?php

namespace App\ViewModels;

use Illuminate\Database\Eloquent\Model;

class OrderPaymentViewModel extends LayoutViewModel
{
    public $orderNumber;

    public $order;

    public $orderStatuses;

    public $status;

    public $liqpay;

    public function __construct(string $view, string $language, int $orderNumber)
    {
        parent::__construct($view, $language);

        $this->orderNumber = $orderNumber;
    }
}
