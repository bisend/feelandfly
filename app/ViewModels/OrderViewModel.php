<?php

namespace App\ViewModels;

/**
 * Class OrderViewModel
 * @package App\ViewModels
 */
class OrderViewModel extends LayoutViewModel
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
    public $order;

    public $countries;

    public $checkoutPoints;

    public $deliveryTypes;

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
