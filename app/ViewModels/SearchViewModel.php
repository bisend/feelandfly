<?php

namespace App\ViewModels;

use App\Helpers\ProductsSort;

/**
 * Class SearchViewModel
 * @package App\ViewModels
 */
class SearchViewModel extends LayoutViewModel
{
    /**
     * @var string
     */
    public $sort;

    /**
     * @var ProductsSort
     */
    public $sortItems;
    
    //pagination fields
    /**
     * @var int
     */
    public $searchProductsLimit = 24;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $searchProductsOffset;

    /**
     * @var
     */
    public $countSearchProducts;

    /**
     * @var
     */
    public $searchProducts;

    /**
     * @var null
     */
    public $series;

    /**
     * @var
     */
    public $seriesTitle;

    /**
     * SearchViewModel constructor.
     * @param string $view
     * @param string $language
     * @param $series
     * @param $sort
     * @param $page
     */
    public function __construct($view, $language, $series, $sort, $page)
    {
        parent::__construct($view, $language);

        $this->series = $series;

        $this->seriesTitle = str_replace('+', ' ', $series);

        $this->sort = $sort;

        $this->page = $page;

        $this->sortItems = new ProductsSort($series, null, $page, $language, $this->sort);

        $this->searchProductsOffset = ($this->page - 1) * $this->searchProductsLimit;
    }
}