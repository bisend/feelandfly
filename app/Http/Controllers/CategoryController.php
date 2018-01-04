<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Repositories\ProductRepository;
use App\Services\CategoryService;
use App\ViewModels\CategoryViewModel;
use JavaScript;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends LayoutController
{
    /**
     * @var CategoryService
     */
    protected $categoryService;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryService $categoryService, ProductRepository $productRepository)
    {
        $this->categoryService = $categoryService;
        
        $this->productRepository = $productRepository;
    }

    /**
     * show category page
     * @param string|null $slug
     * @param string $language
     * @return mixed
     */
    public function index($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, 1, 'default');

        $this->categoryService->fill($model);
        
        if ($model->categoryProducts->count() < 1)
        {
            abort(404);
        }

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category', compact('model'));
    }

    /**
     * method handles categories pagination
     * @param null $slug
     * @param $page
     * @param string $language
     * @return mixed
     */
    public function indexPagination($slug = null, $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, $page, 'default');

        $this->categoryService->fill($model);

        if ($model->categoryProducts->count() < 1)
        {
            abort(404);
        }

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category', compact('model'));
    }

    /**
     * method handles categories with sort
     * @param null $slug
     * @param string $sort
     * @param string $language
     * @return mixed
     */
    public function indexSort($slug = null, $sort = 'default', $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, 1, $sort);

        $this->categoryService->fill($model);

        if ($model->categoryProducts->count() < 1)
        {
            abort(404);
        }

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category', compact('model'));
    }

    /**
     * method handles categories pagination with sort
     * @param null $slug
     * @param string $sort
     * @param $page
     * @param string $language
     * @return mixed
     */
    public function indexPaginationSort($slug = null, $sort = 'default', $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, $page, $sort);

        $this->categoryService->fill($model);

        if ($model->categoryProducts->count() < 1)
        {
            abort(404);
        }

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug,
            'priceMin' => $model->priceMin,
            'priceMax' => $model->priceMax
        ]);

        return view('pages.category', compact('model'));
    }
}
