<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 19.01.2018
 * Time: 17:14
 */

namespace App\Repositories;


use App\DatabaseModels\Blog;

class BlogRepository
{
    public function getBlogs($model)
    {
        return Blog::with([
            'image'
        ])
            ->whereIsVisible(true)
            ->orderByRaw('created_at desc')
            ->limit(6)
            ->get([
                'id',
                'image_id',
                "title_$model->language as title",
                'slug',
                "description_$model->language as description",
                "short_description_$model->language as short_description",
                'number_of_views',
                'priority',
                'is_visible',
                'created_at'
            ]);
    }
}