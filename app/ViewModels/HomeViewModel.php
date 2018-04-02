<?php

namespace App\ViewModels;

/**
 * Class HomeViewModel
 * @package App\ViewModels
 */
class HomeViewModel extends LayoutViewModel
{
    public $mainSlider;
    
    public $mainSliderProducts;
    
    public $salesProducts;
    
    public $salesIds = [];

    public $salesProductsCount = 0;
    
    public $topProducts;
    
    public $topIds = [];
    
    public $newProducts;
    
    public $newIds = [];
    
    public $blogs;

    public $salesLimit = 8;

    public $topLimit = 8;

    public $newLimit = 8;
    /**
     * HomeViewModel constructor.
     * @param string $view
     * @param string $language
     */
    public function __construct($view, $language)
    {
        parent::__construct($view, $language);
    }
}
