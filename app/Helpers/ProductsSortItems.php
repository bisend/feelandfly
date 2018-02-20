<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 14.08.2017
 * Time: 12:05
 */

namespace App\Helpers;

/**
 * Class ProductsSortItems
 * @package App\Helpers
 */
class ProductsSortItems
{
    /**
     * @var
     */
    public $sortSlug;

    /**
     * @var array|\Illuminate\Contracts\Translation\Translator|null|string
     */
    public $name;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $url_filters;

    /**
     * @var string
     */
    public $url_search;

    /**
     * @var string
     */
    public $url_sale;

    /**
     * @var bool
     */
    public $isSelected = false;

    /**
     * @var bool
     */
    public $isVisible = true;

    /**
     * ProductsSortItems constructor.
     * @param $slug
     * @param $sortSlug
     * @param $page
     * @param string $language
     * @param $sort
     * @param $filters
     */
    public function __construct($slug, $filters, $sortSlug, $page, $language = Languages::DEFAULT_LANGUAGE, $sort)
    {
        $this->sortSlug = $sortSlug;
        $this->name = trans('layout.' . $sortSlug);
        
        $this->url = '/category';
        $this->url .= ('/' . $slug);
        $this->url .= ($sortSlug == 'default' ? '' : ('/' . $sortSlug));
        $this->url .= ($page == 1 ? '' : ('/' . $page));
        $this->url .= ($language == Languages::DEFAULT_LANGUAGE ? '' : ('/' . $language));
        
        if ($filters)
        {
            $this->url_filters = '/category';
            $this->url_filters .= ('/' . $slug);
            $this->url_filters .= ('/' . $filters);
            $this->url_filters .= ($sortSlug == 'default' ? '' : ('/' . $sortSlug));
            $this->url_filters .= ($page == 1 ? '' : ('/' . $page));
            $this->url_filters .= ($language == Languages::DEFAULT_LANGUAGE ? '' : ('/' . $language));
        }

        $this->url_search = '/search';
        $this->url_search .= ('/' . $slug);
        $this->url_search .= ($sortSlug == 'default' ? '' : ('/' . $sortSlug));
        $this->url_search .= ($page == 1 ? '' : ('/' . $page));
        $this->url_search .= ($language == Languages::DEFAULT_LANGUAGE ? '' : ('/' . $language));

        $this->url_sale = '/sale';
        $this->url_sale .= ($sortSlug == 'default' ? '' : ('/' . $sortSlug));
        $this->url_sale .= ($page == 1 ? '' : ('/' . $page));
        $this->url_sale .= ($language == Languages::DEFAULT_LANGUAGE ? '' : ('/' . $language));
        
        if ($sort == $sortSlug)
        {
            $this->isSelected = true;
            $this->isVisible = false;
        }
    }
}