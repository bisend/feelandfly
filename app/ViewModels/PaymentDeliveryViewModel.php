<?php

namespace App\ViewModels;

/**
 * Class PaymentDeliveryViewModel
 * @package App\ViewModels
 */
class PaymentDeliveryViewModel extends LayoutViewModel
{
    public $deliveries;
    public $deliveryTypes;


    public $selectedDeliveryId;
    public $selectedDeliveryTypeId;

    public $delivery;
    public $deliveryType;

    /**
     * PaymentDeliveryViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
