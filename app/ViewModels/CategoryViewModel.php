<?php

namespace App\ViewModels;

use App\Helpers\ProductsSort;

/**
 * Class CategoryViewModel
 * @package App\ViewModels
 */
class CategoryViewModel extends LayoutViewModel
{
    /**
     * @var string|null Should contain category slug
     */
    public $slug;

    /**
     * @var mixed currentCategory Should contain current category
     */
    public $currentCategory;

    /**
     * @var mixed categoryProducts Should contain products for current category
     */
    public $categoryProducts;

    /**
     * @var int Should contain count of products for current category
     */
    public $countCategoryProducts;

    /**
     * @var int Should contain number of page
     */
    public $page = 1;

    /**
     * @var int Should contain products per page
     */
    public $categoryProductsLimit = 12;

    /**
     * @var int Should contain offset for products
     */
    public $categoryProductsOffset = 0;

    /**
     * @var array
     */
    public $filters = [];

    /**
     * @var
     */
    public $priceMin;

    /**
     * @var
     */
    public $priceMax;

    /**
     * @var string
     */
    public $sort;

    /**
     * @var 
     */
    public $sortItems;

    public $metaLinkPrev;

    public $metaLinkNext;

    public $setNoIndex = false;

    /**
     * CategoryViewModel constructor.
     * @param string $view
     * @param string $language
     * @param string|null $slug
     * @param int $page
     * @param string $sort
     */
    public function __construct($view, $language, $slug, $page, $sort)
    {
        parent::__construct($view, $language);

        $this->slug = $slug;

        $this->page = $page;
        
        $this->sort = $sort;

        $this->sortItems = new ProductsSort($slug, null, $page, $language, $this->sort);

        $this->categoryProductsOffset = ($this->page - 1) * $this->categoryProductsLimit;
    }
}
