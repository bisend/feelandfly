<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 15:35
 */

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends LayoutService
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * ProductService constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;

        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        try
        {
            parent::fill($model); // TODO: Change the autogenerated stub

            $this->fillProduct($model);

            $this->fillCurrentCategory($model);

            $this->fillProductProperties($model);

            $this->fillSimilarProducts($model);

            $this->fillMetaTags($model);
        }
        catch (\Exception $e)
        {
            abort(404);
        }
    }

    /**
     * fill $model->product by product, $model->userType is type of user to define price etc.
     * @param $model
     */
    private function fillProduct($model)
    {
        $userTypeId = $model->userTypeId;

        $model->product = $this->productRepository->getProductBySlug($model->slug, $model->language, $userTypeId);


        if (is_null($model->product))
        {
            abort(404);
        }
    }

    /**
     * fill $model->currentCategory by current category
     * @param $model
     */
    private function fillCurrentCategory($model)
    {
        $model->currentCategory = $this->categoryRepository->getCurrentCategoryById(
            $model->product->category_id,
            $model->language
        );

        if (is_null($model->currentCategory))
        {
            abort(404);
        }
    }

    /**
     * fill $model->productProperties
     * @param $model
     */
    private function fillProductProperties($model)
    {
        $model->productProperties = $this->productRepository->getProductProperties($model->product->id, $model->language);
    }

    /**
     * fill $model->similarProducts by products from currentCategory 
     * @param $model
     */
    private function fillSimilarProducts($model)
    {
        $userTypeId = $model->userTypeId;

        $model->similarProducts = $this->productRepository->getSimilarProducts(
            $model->product->id, 
            $model->product->category_id, 
            $model->language,
            $userTypeId);
    }

    private function fillMetaTags($model)
    {
        if (!is_null($model->product->meta_title))
        {
            $model->title = $model->product->meta_title;
            $model->description = $model->product->meta_description;
            $model->keywords = $model->product->meta_keywords;
            $model->h1 = $model->product->meta_h1;
        }
        else
        {
            $model->title = 'Feelandfly';
            $model->description = 'Feelandfly';
            $model->keywords = 'Feelandfly';
            $model->h1 = 'Feelandfly';
        }
    }

    public function incrementNumberOfViews($model)
    {
        $this->productRepository->incrementNumberOfViews($model);
    }
}