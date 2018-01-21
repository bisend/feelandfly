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
    public function getBlogsOnHomePage($model)
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
    
    public function getBlog($model)
    {
        return Blog::with([
            'image'
        ])
            ->whereIsVisible(true)
            ->whereSlug($model->slug)
            ->first([
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
    
    public function getPopularBlogs($model)
    {
        return Blog::with([
            'image'
        ])
            ->whereIsVisible(true)
            ->orderByRaw('number_of_views desc')
            ->whereNotIn('id', [$model->blog->id])
            ->limit(3)
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
    
    public function getAllBlogs($model)
    {
        return Blog::with([
            'image'
        ])
            ->whereIsVisible(true)
            ->orderByRaw('created_at desc')
            ->offset($model->offset)
            ->limit($model->limit)
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
    
    public function getAllBlogsCount($model)
    {
        return Blog::whereIsVisible(true)->count();
    }
    
    public function incrementBlogViewCount($model)
    {
        $model->blog->increment('number_of_views');
    }
}