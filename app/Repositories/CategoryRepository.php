<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 11.10.2017
 * Time: 11:59
 */

namespace App\Repositories;

use App\DatabaseModels\Category;

/**
 * Class CategoryRepository
 * @package App\Repositories
 */
class CategoryRepository
{
    /**
     * return all categories by language
     * @param $language
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategories($language)
    {
        return Category::get([
            'id',
            'parent_id',
            "name_$language as name",
            'slug',
            "description_$language as description",
            'priority'
        ]);
    }

    /**
     * return current category by slug and language
     * @param $slug
     * @param $language
     * @return \Illuminate\Database\Eloquent\Model|null|static
     */
    public function getCurrentCategoryBySlug($slug, $language)
    {
        return Category::whereSlug($slug)
            ->first([
                'id',
                'parent_id',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'priority'
            ]);
    }
    
    public function getCurrentCategoryById($categoryId, $language)
    {
        return Category::whereId($categoryId)
            ->first([
                'id',
                'parent_id',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'priority'
            ]);
    }
}