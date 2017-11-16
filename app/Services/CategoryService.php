<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 14:54
 */

namespace App\Services;


use App\Repositories\CategoryRepository;
use App\Repositories\FilterRepository;
use App\Repositories\ProductRepository;

/**
 * Class CategoryService
 * @package App\Services
 */
class CategoryService extends LayoutService
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
    public function __construct(CategoryRepository $categoryRepository, ProductRepository $productRepository, FilterRepository $filterRepository)
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
        parent::fill($model); // TODO: Change the autogenerated stub

        $this->fillCurrentCategory($model);

        $this->fillCategoryProducts($model);

        $this->fillCountCategoryProducts($model);

        $this->fillFilters($model);
    }

    /**
     * @param $model
     */
    private function fillCurrentCategory($model)
    {
        $model->currentCategory = $this->categoryRepository->getCurrentCategoryBySlug($model->slug, $model->language);
    }

    private function fillCategoryProducts($model)
    {
        $userTypeId = $model->userTypeId;

        if ($userTypeId == 4)
        {
            $userTypeId = 1;
        }
        
        $model->categoryProducts = $this->productRepository->getAllProductsForCategory(
            $model->currentCategory,
            $model->categoryProductsLimit,
            $model->categoryProductsOffset,
            $model->language,
            $userTypeId
        );
    }

    private function fillCountCategoryProducts($model)
    {
        $model->countCategoryProducts = $this->productRepository->getCountProductsCategory($model->currentCategory);
    }
    
    private function fillFilters($model)
    {

        $filtersArray = $this->filterRepository->initFilters($model);

        $filters = [];

        foreach (collect($filtersArray) as $item)
        {
            $filterName = $item->filter_name_title;

            $filters[$filterName][] = $item;
        }

        $model->filters = collect($filters);
        
        \Debugbar::info($model->filters);
    }
}