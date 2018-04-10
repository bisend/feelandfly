<?php

namespace App\ViewModels;

/**
 * Class PaymentDeliveryViewModel
 * @package App\ViewModels
 */
class PaymentDeliveryViewModel extends LayoutViewModel
{
    public $deliveries;
    public $selectedDeliveryId;
    public $delivery;

    public $deliveryTypes;
    public $selectedDeliveryTypeId;
    public $deliveryType;

    public $countries;
    public $selectedCountryCode;
    public $country;

    public $checkoutPoints;
    public $selectedCheckoutPointId;
    public $checkoutPoint;

    public $selectedCityRef;
    public $selectedWarehouseRef;

    public $selectedStreet;
    public $selectedLand;
    public $selectedCity;
    public $selectedIndex;


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
