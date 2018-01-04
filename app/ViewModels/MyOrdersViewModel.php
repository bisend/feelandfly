<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 20.12.2017
 * Time: 9:57
 */

namespace App\ViewModels;

/**
 * Class MyOrdersViewModel
 * @package App\ViewModels
 */
class MyOrdersViewModel extends LayoutViewModel
{
    /**
     * @var
     */
    public $orders;

    /**
     * @var
     */
    public $payments;

    /**
     * @var
     */
    public $deliveries;
    
//    public $orderProducts;

    /**
     * @var int
     */
    public $totalOrdersCount = 0;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $ordersLimit = 5;

    /**
     * @var int
     */
    public $ordersOffset;

    /**
     * MyOrdersViewModel constructor.
     * @param string $view
     * @param string $language
     * @param $page
     */
    public function __construct($view, $language, $page)
    {
        parent::__construct($view, $language);

        $this->page = $page;

        $this->ordersOffset = ($this->page - 1) * $this->ordersLimit;
    }
}