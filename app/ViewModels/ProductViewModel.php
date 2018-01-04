<?php

namespace App\ViewModels;

/**
 * Class ProductViewModel
 * @package App\ViewModels
 */
class ProductViewModel extends LayoutViewModel
{
    /**
     * @var
     */
    public $slug;

    /**
     * @var
     */
    public $currentCategory;

    /**
     * @var
     */
    public $product;

    /**
     * @var
     */
    public $similarProducts;

    /**
     * @var
     */
    public $productProperties;

    /**
     * ProductViewModel constructor.
     * @param string $view
     * @param string $language
     * @param $slug
     */
    public function __construct($view, $language, $slug)
    {
        parent::__construct($view, $language);
        
        $this->slug = $slug;
    }
}
