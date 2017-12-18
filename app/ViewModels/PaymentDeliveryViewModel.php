<?php

namespace App\ViewModels;

class PaymentDeliveryViewModel extends LayoutViewModel
{
    public $payments;
    
    public $deliveries;
    
    public $selectedPaymentId;
    
    public $selectedDeliveryId;
    
    public $address;
    
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
