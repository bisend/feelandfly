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
     * @param string|null $slug
     * @param string|null $filters
     * @param string $language
     * @return mixed
     */
    public function index($slug = null, $filters = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category-filters', $language, $slug, 1, $filters);
        
        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts
        ]);

        return view('pages.category-filters', compact('model'));
    }

    public function indexPagination($slug = null, $filters = null, $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryFiltersViewModel('category', $language, $slug, $page, $filters);

        $this->categoryFiltersService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts
        ]);

        return view('pages.category-filters', compact('model'));
    }
}
