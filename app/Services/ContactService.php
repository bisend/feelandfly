<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 22.02.2018
 * Time: 12:26
 */

namespace App\Services;


use App\Repositories\CategoryRepository;

class ContactService extends LayoutService
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
        $model->title = trans('header.contacts');
        $model->description = trans('header.contacts');
        $model->keywords = trans('header.contacts');
        $model->h1 = trans('header.contacts');
    }
}