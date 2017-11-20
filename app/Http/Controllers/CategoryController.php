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

    protected $productRepository;

    /**
     * CategoryController constructor.
     * @param CategoryService $categoryService
     */
    public function __construct(CategoryService $categoryService, ProductRepository $productRepository)
    {
        $this->categoryService = $categoryService;
        $this->productRepository = $productRepository;
    }

    /**
     * @param string|null $slug
     * @param string $language
     * @return mixed
     */
    public function index($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, 1);

        $this->categoryService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug
        ]);

        return view('pages.category', compact('model'));
    }

    public function indexPagination($slug = null, $page, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new CategoryViewModel('category', $language, $slug, $page);

        $this->categoryService->fill($model);

        \Debugbar::info($model);

        JavaScript::put([
            'products' => $model->categoryProducts,
            'filters' => $model->filters,
            'categorySlug' => $model->currentCategory->slug
        ]);

        return view('pages.category', compact('model'));
    }

//    public function getAjaxProductPreview()
//    {
//        $productId = request('productId');
//
//        $language = request('language');
//
//        $product = $this->productRepository->getProductById($productId, $language);
//
//        $view = view('partial.category-page.product-preview-ajax', compact('product', 'language'))->render();
//
//        return response()->json([
//            'status' => 'success',
//            'view' => $view
//        ]);
//    }
}
