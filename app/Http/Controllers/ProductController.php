<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ProductService;
use App\User;
use App\ViewModels\ProductViewModel;
use Illuminate\Support\Facades\DB;
use JavaScript;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends LayoutController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProductController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * @param string|null $slug
     * @param string $language
     * @return mixed
     */
    public function index($slug = null, $language = Languages::DEFAULT_LANGUAGE)
    {
        $model = new ProductViewModel('product', $language, $slug);

        $this->productService->fill($model);

        JavaScript::put([
            'product' => $model->product,
            'similarProducts' => $model->similarProducts
        ]);

        \Debugbar::info($model);
//        \Debugbar::info($model->similarProducts->product_group);

        return view('pages.product', compact('model'));
    }
    
}