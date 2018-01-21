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
    
    public $topProducts;
    
    public $topIds = [];
    
    public $newProducts;
    
    public $newIds = [];
    
    public $blogs;
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
