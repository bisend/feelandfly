<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:58
 */

namespace App\Services;

use App\DatabaseModels\MetaTag;
use App\Repositories\BlogRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\MetaTagRepository;
use App\Repositories\ProductRepository;

/**
 * Class HomeService
 * @package App\Services
 */
class HomeService extends LayoutService
{
    protected $productRepository;
    
    protected $blogRepository;

    protected $metaTagRepository;

    /**
     * HomeService constructor.
     * @param CategoryRepository $categoryRepository
     * @param ProductRepository $productRepository
     * @param BlogRepository $blogRepository
     */
    public function __construct(CategoryRepository $categoryRepository,
                                ProductRepository $productRepository,
                                BlogRepository $blogRepository,
                                MetaTagRepository $metaTagRepository)
    {
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;
        
        $this->blogRepository = $blogRepository;

        $this->metaTagRepository = $metaTagRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        parent::fill($model); // TODO: Change the autogenerated stub

        $this->fillMainSlider($model);

        $this->fillMainSliderProducts($model);

        $this->fillSalesProducts($model);

        $this->fillSalesIds($model);

        $this->fillTopProducts($model);

        $this->fillTopIds($model);

        $this->fillNewProducts($model);

        $this->fillNewIds($model);
        
        $this->fillBlogs($model);

        $this->fillMetaTags($model);
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
    
    private function fillMainSlider($model)
    {
        $model->mainSlider = $this->productRepository->getMainSlider($model);
    }

    private function fillMainSliderProducts($model)
    {
        foreach ($model->mainSlider as $slide)
        {
            foreach ($slide->markers as $marker)
            {
                if ($marker->product != null)
                {
                    $model->mainSliderProducts[] = $marker->product;
                }
            }
        }
    }
    
    private function fillBlogs($model)
    {
        $model->blogs = $this->blogRepository->getBlogsOnHomePage($model);
    }

    private function fillMetaTags($model)
    {
        $metaTag = $this->metaTagRepository->getMetaTagByPageName($model);
        $model->title = $metaTag->title;
        $model->description = $metaTag->description;
        $model->keywords = $metaTag->keywords;
        $model->h1 = $metaTag->h1;
    }
}