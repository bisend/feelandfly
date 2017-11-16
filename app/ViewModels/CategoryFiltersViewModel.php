<?php

namespace App\ViewModels;

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
     * CategoryViewModel constructor.
     * @param string $view
     * @param string $language
     * @param string|null $slug
     * @param int $page
     */
    public function __construct($view, $language, $slug, $page, $filters)
    {
        parent::__construct($view, $language);

        $this->slug = $slug;

        $this->page = $page;

        $this->categoryProductsOffset = ($this->page - 1) * $this->categoryProductsLimit;

        $nameWithValues = explode(';', $filters);

        $parsedFilters = [];

        foreach ($nameWithValues as $item)
        {
            $pairNameValues = explode('=', $item);
            $parsedFilters[$pairNameValues[0]] = explode(',', $pairNameValues[1]);
        }

        \Debugbar::info($parsedFilters);

        $this->parsedFilters = $parsedFilters;
    }
}