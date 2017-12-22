<?php

namespace App\Http\Controllers;

use App\Helpers\Languages;
use App\Services\ProductService;
use App\Services\ReviewService;
use App\User;
use App\ViewModels\ProductViewModel;
use Illuminate\Support\Facades\DB;
use JavaScript;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

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

    protected $reviewService;

    public function __construct(ProductService $productService, ReviewService $reviewService)
    {
        $this->productService = $productService;

        $this->reviewService = $reviewService;
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
        
        $reviews = $this->reviewService->getReviews($model->product->id, 1);

        $reviewsCount = $this->reviewService->getReviewsCount($model->product->id);
        
        JavaScript::put([
            'product' => $model->product,
            'similarProducts' => $model->similarProducts,
            'reviews' => $reviews,
            'reviewsCount' => $reviewsCount
        ]);

        \Debugbar::info($model);
        
        return view('pages.product', compact('model'));
    }
    
    public function getReviews()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $productId = request('productId');
        
        $page = request('page');

        $reviews = $this->reviewService->getReviews($productId, $page);

        $reviewsCount = $this->reviewService->getReviewsCount($productId);
        
        return response()->json([
            'reviews' => $reviews,
            'reviewsCount' => $reviewsCount
        ]);
    }

    public function addReview()
    {
        if(!request()->ajax())
        {
            throw new BadRequestHttpException();
        }

        $productId = request('productId');
        $userId = auth()->check() ? auth()->user()->id : null;
        $review = request('review');
        $name = request('name');
        $email = request('email');
        $rating = request('rating');

        try
        {
            DB::beginTransaction();
            $this->reviewService->addReview($productId, $userId, $review, $name, $email, $rating);
        }
        catch (\Exception $e)
        {
            DB::rollBack();

            return response()->json([
                'status' => 'error'
            ]);
        }
        DB::commit();

        return response()->json([
            'status' => 'success'
        ]);
    }
    
}