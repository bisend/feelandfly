<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 20.02.2018
 * Time: 17:39
 */

namespace App\ViewModels;


use App\Helpers\ProductsSort;

class SaleViewModel extends LayoutViewModel
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
    public $limit = 12;

    /**
     * @var int
     */
    public $page = 1;

    /**
     * @var int
     */
    public $offset;

    /**
     * @var
     */
    public $countProducts;

    /**
     * @var
     */
    public $products;

    public function __construct(string $view, string $language, string $sort, $page)
    {
        parent::__construct($view, $language);

        $this->sort = $sort;

        $this->page = $page;

        $this->sortItems = new ProductsSort(null, null, $page, $language, $this->sort);

        $this->offset = ($this->page - 1) * $this->limit;
    }
}