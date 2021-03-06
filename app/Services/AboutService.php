<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.02.2018
 * Time: 11:18
 */

namespace App\Services;


use App\Repositories\CategoryRepository;

class AboutService extends LayoutService
{
    public function __construct(CategoryRepository $categoryRepository)
    {
        parent::__construct($categoryRepository);
    }

    public function fill($model)
    {
        parent::fill($model); // TODO: Change the autogenerated stub

        $this->fillMetaTags($model);
    }

    private function fillMetaTags($model)
    {
        $model->title = trans('header.about_us');
        $model->description = trans('header.about_us');
        $model->keywords = trans('header.about_us');
        $model->h1 = trans('header.about_us');
    }
}