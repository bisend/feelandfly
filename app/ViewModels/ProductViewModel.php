<?php

namespace App\ViewModels;

/**
 * Class ProductViewModel
 * @package App\ViewModels
 */
class ProductViewModel extends LayoutViewModel
{
    public $slug;
    
    public $currentCategory;

    public $product;

    public $similarProducts;
    
    public $productProperties;
    
    public function __construct($view, $language, $slug)
    {
        parent::__construct($view, $language);
        
        $this->slug = $slug;
    }
}
