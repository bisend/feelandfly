<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:57
 */

namespace App\Services;


use App\Helpers\Languages;
use App\Repositories\CategoryRepository;

/**
 * Class LayoutService
 * @package App\Services
 */
class LayoutService
{
    /**
     * @var CategoryRepository
     */
    protected $categoryRepository;

    /**
     * LayoutService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        $this->localizeApplication($model);
        $this->fillCategories($model);
    }

    /**
     * set locale APP
     * @param $model
     */
    private function localizeApplication($model)
    {
        Languages::localizeApp($model->language);
    }

    /**
     * fill model categories
     * @param $model 
     */
    private function fillCategories($model)
    {
        $model->categories = $this->categoryRepository->getCategories($model->language);
    }
}