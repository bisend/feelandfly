<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:58
 */

namespace App\Services;

use App\Repositories\CategoryRepository;
use App\Repositories\ProductRepository;

/**
 * Class HomeService
 * @package App\Services
 */
class HomeService extends LayoutService
{
    protected $productRepository;

    /**
     * HomeService constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        parent::fill($model); // TODO: Change the autogenerated stub

        $this->fillSalesProducts($model);

        $this->fillSalesIds($model);

        $this->fillTopProducts($model);

        $this->fillTopIds($model);

        $this->fillNewProducts($model);

        $this->fillNewIds($model);
    }

    private function fillSalesProducts($model)
    {
        $model->salesProducts = $this->productRepository->getSalesProducts($model);
    }

    private function fillSalesIds($model)
    {
        foreach ($model->salesProducts as $salesProduct)
        {
            $model->salesIds[] = $salesProduct->id;
        }
    }

    private function fillTopProducts($model)
    {
        $model->topProducts = $this->productRepository->getTopProducts($model);
    }

    private function fillTopIds($model)
    {
        $model->topIds = $model->salesIds;

        foreach ($model->topProducts as $topProduct)
        {
            $model->topIds[] = $topProduct->id;
        }
    }

    private function fillNewProducts($model)
    {
        $model->newProducts = $this->productRepository->getNewProducts($model);
    }

    private function fillNewIds($model)
    {
        $model->newIds = $model->topIds;

        foreach ($model->newProducts as $newProduct)
        {
            $model->newIds[] = $newProduct->id;
        }
    }
}