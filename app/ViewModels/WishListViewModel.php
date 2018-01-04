<?php

namespace App\ViewModels;

/**
 * Class WishListViewModel
 * @package App\ViewModels
 */
class WishListViewModel extends LayoutViewModel
{
    /**
     * @var
     */
    public $wishList;

    /**
     * @var
     */
    public $wishListProducts;

    /**
     * @var
     */
    public $countWishListProducts;

    /**
     * @var int
     */
    public $wishListProductsLimit = 7;

    /**
     * @var int|null
     */
    public $page = 1;

    /**
     * @var int|null
     */
    public $wishListProductsOffset;

    /**
     * WishListViewModel constructor.
     * @param string $view
     * @param string $language
     * @param $page
     */
    public function __construct($view, $language, $page)
    {
        parent::__construct($view, $language);
        
        $this->page = $page;

        $this->wishListProductsOffset = ($this->page - 1) * $this->wishListProductsLimit;
    }
}
