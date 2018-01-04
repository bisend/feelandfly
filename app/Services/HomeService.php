<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:58
 */

namespace App\Services;

use App\Repositories\CategoryRepository;

/**
 * Class HomeService
 * @package App\Services
 */
class HomeService extends LayoutService
{
    /**
     * HomeService constructor.
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    /**
     * @param $model
     */
    public function fill($model)
    {
        parent::fill($model); // TODO: Change the autogenerated stub
    }
}