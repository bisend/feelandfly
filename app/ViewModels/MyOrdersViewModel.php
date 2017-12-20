<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 20.12.2017
 * Time: 9:57
 */

namespace App\ViewModels;


class MyOrdersViewModel extends LayoutViewModel
{
    public $orders;
    
    public $payments;
    
    public $deliveries;
    
//    public $orderProducts;
    
    public $totalOrdersCount = 0;
    
    public $page = 1;

    public $ordersLimit = 5;

    public $ordersOffset;
    
    public function __construct($view, $language, $page)
    {
        parent::__construct($view, $language);

        $this->page = $page;

        $this->ordersOffset = ($this->page - 1) * $this->ordersLimit;
    }
}