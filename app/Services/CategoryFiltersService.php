<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 16.11.2017
 * Time: 11:22
 */

namespace App\Services;

use App\Helpers\Paginator;
use App\Repositories\CategoryRepository;
use App\Repositories\FilterRepository;
use App\Repositories\ProductRepository;

class CategoryFiltersService extends LayoutService
{
    /**
     * @var CategoryRepository
     */
    public $categoryRepository;

    /**
     * @var ProductRepository
     */
    public $productRepository;

    /**
     * @var FilterRepository
     */
    public $filterRepository;

    /**
     * CategoryService constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param FilterRepository $filterRepository
     */
    public function __construct(CategoryRepository $categoryRepository, 
                                ProductRepository $productRepository, 
                                FilterRepository $filterRepository)
    {
        parent::__construct($categoryRepository);

        $this->categoryRepository = $categoryRepository;

        $this->productRepository = $productRepository;

        $this->filterRepository = $filterRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        try
        {
            parent::fill($model); // TODO: Change the autogenerated stub

            $this->fillCurrentCategory($model);

            $this->fillCategoryProducts($model);

            $this->fillCountCategoryProducts($model);

            $this->fillFilters($model);

            $this->fillInitialPriceMin($model);

            $this->fillInitialPriceMax($model);

            $this->fillMetaTags($model);

            $this->fillSeoTags($model);
        }
        catch (\Exception $e)
        {
            abort(404);
        }
    }

    /**
     * fill current category
     * @param $model
     */
    private function fillCurrentCategory($model)
    {
        $model->currentCategory = $this->categoryRepository->getCurrentCategoryBySlug($model->slug, $model->language);

        if (empty($model->currentCategory) || !isset($model->currentCategory) || is_null($model->currentCategory))
        {
            abort(404);
        }
    }

    /**
     * fill filtered products
     * @param $model
     */
    private function fillCategoryProducts($model)
    {
        $userTypeId = $model->userTypeId;

        $model->categoryProducts = $this->productRepository->getAllProductsForFiltersCategory(
            $model->currentCategory,
            $model->categoryProductsLimit,
            $model->categoryProductsOffset,
            $model->language,
            $userTypeId,
            $model
        );
    }

    /**
     * fill count of filtered products
     * @param $model
     */
    private function fillCountCategoryProducts($model)
    {
        $model->countCategoryProducts = $this->productRepository->getCountProductsFiltersCategory($model);
    }

    /**
     * fill active filters
     * @param $model
     */
    private function fillFilters($model)
    {

        $filtersArray = $this->filterRepository->initActiveFilters($model);

        $filters = [];

        foreach (collect($filtersArray) as $item)
        {
            $filterName = $item->filter_name_title;

            $filters[$filterName][] = $item;
        }

        $model->filters = collect($filters);

        foreach ($model->filters as $filterName => $filterValues)
        {
            foreach ($filterValues as $filterValue)
            {
                $filterValue->isChecked = false;

                foreach ($model->parsedFilters as $parsedFilterName => $parsedFilterValues)
                {
                    if (in_array($filterValue->filter_value_slug, $parsedFilterValues))
                    {
                        $filterValue->isChecked = true;
                    }
                }
                $filterValue->initialState = $filterValue->isChecked;
            }
        }
    }

    /**
     * fill min price
     * @param $model
     */
    private function fillInitialPriceMin($model)
    {
        $model->initialPriceMin = $this->productRepository->getPriceMinForFiltersCategoryProducts($model);
    }

    /**
     * fill max price
     * @param $model
     */
    private function fillInitialPriceMax($model)
    {
        $model->initialPriceMax = $this->productRepository->getPriceMaxForFiltersCategoryProducts($model);
    }

    private function fillMetaTags($model)
    {

        if ($model->currentCategory->meta_tag)
        {
            $model->title = $model->currentCategory->meta_tag->title;
            $model->description = $model->currentCategory->meta_tag->description;
            $model->keywords = $model->currentCategory->meta_tag->keywords;
            $model->h1 = $model->currentCategory->meta_tag->h1;
        }
        else
        {
            $model->title = 'Feelandfly';
            $model->description = 'Feelandfly';
            $model->keywords = 'Feelandfly';
            $model->h1 = 'Feelandfly';
        }
    }

    private function fillSeoTags($model)
    {
        $pages = Paginator::createPagination($model->page, $model->categoryProductsLimit, $model->countCategoryProducts);

        $isPrev = array_shift($pages);

        $isNext = array_pop($pages);

        if ($isPrev)
        {
            $model->metaLinkPrev = url_category_filters_per_page($model->currentCategory->slug, $model->filtersParam . ($model->sort == 'default' ? '' : '/' . $model->sort), $model->page - 1, $model->language);
        }

        if ($isNext)
        {
            $model->metaLinkNext = url_category_filters_per_page($model->currentCategory->slug, $model->filtersParam . ($model->sort == 'default' ? '' : '/' . $model->sort), $model->page + 1, $model->language);
        }

        if ((int)$model->page > 1)
        {
            $model->setNoIndex = true;
        }

        if ($model->sort != 'default')
        {
            $model->setNoIndex = true;
        }

        if (count($model->parsedFilters) > 1)
        {
            $model->setNoIndex = true;
        }
        elseif (count($model->parsedFilters) == 1)
        {
            if (!is_null($model->priceMin) || !is_null($model->priceMax))
            {
                $model->setNoIndex = true;
            }

            foreach ($model->parsedFilters as $filterName)
            {
                if (count($filterName) > 1)
                {
                    $model->setNoIndex = true;
                }
            }
        }
    }
}