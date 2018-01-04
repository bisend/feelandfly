<?php

namespace App\ViewModels;

/**
 * Class PaymentDeliveryViewModel
 * @package App\ViewModels
 */
class PaymentDeliveryViewModel extends LayoutViewModel
{
    /**
     * @var
     */
    public $payments;

    /**
     * @var
     */
    public $deliveries;

    /**
     * @var
     */
    public $selectedPaymentId;

    /**
     * @var
     */
    public $selectedDeliveryId;

    /**
     * @var
     */
    public $address;

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
