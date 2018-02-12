<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Repositories\ProductRepository;
use App\Services\CategoryFiltersService;
use App\ViewModels\CategoryFiltersViewModel;
use JavaScript;

/**
 * Class CategoryFiltersController
 * @package App\Http\Controllers
 */
class CategoryFiltersController extends LayoutController
{
    /**
     * @var CategoryFiltersService
     */
    protected $categoryFiltersService;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * CategoryFiltersController constructor.
     * @param CategoryFiltersService $categoryFiltersService
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryFiltersService $categoryFiltersService, ProductRepository $productRepository)
    {
        $this->categoryFiltersService = $categoryFiltersService;
        
        $this->productRepository = $productRepository;
    }

    /**
     * filtered categories
     * @param string|null $slug
     * @param string|null $filters
     * @param string $language
     * @return mixed
     */
    public function index($slug = null, $filters = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category-filters', $language, $slug, 1, $filters, 'default');
        
        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'initialPriceMin' => $model->initialPriceMin,
            'initialPriceMax' => $model->initialPriceMax,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category-filters', compact('model'));
    }

    /**
     * paginated filtered categories
     * @param null $slug
     * @param null $filters
     * @param $page
     * @param string $language
     * @return mixed
     */
    public function indexPagination($slug = null, $filters = null, $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category-filters', $language, $slug, $page, $filters, 'default');

        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'initialPriceMin' => $model->initialPriceMin,
            'initialPriceMax' => $model->initialPriceMax,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category-filters', compact('model'));
    }

    /**
     * filtered categories with sort
     * @param null $slug
     * @param null $filters
     * @param string $sort
     * @param string $language
     * @return mixed
     */
    public function indexSort($slug = null, $filters = null, $sort = 'default', $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category-filters', $language, $slug, 1, $filters, $sort);

        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'initialPriceMin' => $model->initialPriceMin,
            'initialPriceMax' => $model->initialPriceMax,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category-filters', compact('model'));
    }

    /**
     * filtered categories with pagination and sort
     * @param null $slug
     * @param null $filters
     * @param string $sort
     * @param $page
     * @param string $language
     * @return mixed
     */
    public function indexPaginationSort($slug = null, $filters = null, $sort = 'default', $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category-filters', $language, $slug, $page, $filters, $sort);

        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'initialPriceMin' => $model->initialPriceMin,
            'initialPriceMax' => $model->initialPriceMax,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category-filters', compact('model'));
    }
}
