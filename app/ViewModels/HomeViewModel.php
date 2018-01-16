<?php

namespace App\ViewModels;

/**
 * Class HomeViewModel
 * @package App\ViewModels
 */
class HomeViewModel extends LayoutViewModel
{
    public $salesProducts;
    
    public $salesIds = [];
    
    public $topProducts;
    
    public $topIds = [];
    
    public $newProducts;
    
    public $newIds = [];
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
