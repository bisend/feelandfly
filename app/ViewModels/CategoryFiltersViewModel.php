<?php

namespace App\ViewModels;
use App\Helpers\ProductsSort;

/**
 * Class CategoryFiltersViewModel
 * @package App\ViewModels
 */
class CategoryFiltersViewModel extends LayoutViewModel
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
    public $parsedFilters = [];

    /**
     * @var array
     */
    public $filters = [];

    /**
     * @var string
     */
    public $filtersParam = '';

    public $initialPriceMin;

    public $initialPriceMax;

    public $priceMin;

    public $priceMax;

    /**
     * @var string
     */
    public $sort;

    /**
     * @var
     */
    public $sortItems;

    /**
     * CategoryViewModel constructor.
     * @param string $view
     * @param string $language
     * @param string|null $slug
     * @param int $page
     * @param $filters
     */
    public function __construct($view, $language, $slug, $page, $filters, $sort)
    {
        parent::__construct($view, $language);

        $this->slug = $slug;

        $this->page = $page;
        
        $this->sort = $sort;

        $this->categoryProductsOffset = ($this->page - 1) * $this->categoryProductsLimit;

        $this->sortItems = new ProductsSort($slug, $filters, $page, $language, $this->sort);

        $this->filtersParam = $filters;

        $nameWithValues = explode(';', $filters);

        $parsedFilters = [];

        foreach ($nameWithValues as $item)
        {
            $pairNameValues = explode('=', $item);
            
            if (str_contains('price-range', $pairNameValues[0]))
            {
                $priceValues = explode(',', $pairNameValues[1]);
                $this->priceMin = $priceValues[0];
                $this->priceMax = $priceValues[1];
            }
            else
            {
                $parsedFilters[$pairNameValues[0]] = explode(',', $pairNameValues[1]);
            }
        }
        
        $this->parsedFilters = $parsedFilters;
    }
}