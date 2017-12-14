<?php

namespace App\ViewModels;

class OrderViewModel extends LayoutViewModel
{
    public $payments;
    public $deliveries;
    public $order;
    
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
