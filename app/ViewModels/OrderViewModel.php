<?php

namespace App\ViewModels;

/**
 * Class OrderViewModel
 * @package App\ViewModels
 */
class OrderViewModel extends LayoutViewModel
{
    public $order;

    public $deliveries;
    public $deliveryTypes;
    public $countries;
    public $checkoutPoints;
    public $delivery;
    public $deliveryType;

    public $selectedDeliveryId;
    public $selectedDeliveryTypeId;
    public $selectedCountryCode;
    public $country;
    public $selectedCheckoutPointId;
    public $checkoutPoint;
    public $selectedCityRef;
    public $selectedWarehouseRef;
    public $selectedStreet;
    public $selectedLand;
    public $selectedCity;
    public $selectedIndex;

    /**
     * OrderViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
