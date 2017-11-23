<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.08.2017
 * Time: 11:54
 */

namespace App\Helpers;

/**
 * Class ProductsSort
 * @package App\Helpers
 */
class ProductsSort
{
    /**
     * Sort items collection
     *
     * @var array
     */
    public $items = [];

    /**
     * @var array
     */
    public $sortSlugs = [
        'default',
        'popularity',
        'new',
        'price-asc',
        'price-desc'
    ];

    /**
     * ProductsSort constructor.
     * @param null $slug
     * @param int $page
     * @param string $language
     * @param $sort
     * @param $filters
     */
    public function __construct($slug = null, $filters = null, $page = 1, $language = Languages::DEFAULT_LANGUAGE, $sort)
    {
        Languages::localizeApp($language);
        $this->buildItems($slug, $filters, $page, $language, $sort);
    }

    /**
     * @param $slug
     * @param $page
     * @param $language
     * @param $sort
     * @param $filters
     * @return array
     */
    public function buildItems($slug, $filters, $page, $language, $sort)
    {

        foreach ($this->sortSlugs as $sortSlug)
        {
            $this->items[] = new ProductsSortItems($slug, $filters, $sortSlug, $page, $language, $sort);
        }

        return $this->items;
    }
}