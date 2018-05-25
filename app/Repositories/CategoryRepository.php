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
        return Category::whereIsVisible(true)
            ->whereNull('parent_id')
            ->with([
                'childs' => function ($query) use ($language) {
                    $query->select([
                        'id',
                        'parent_id',
                        "name_$language as name",
                        'slug'
                    ])->whereIsVisible(true)->orderByRaw('priority desc', 'name');
                    $query->with([
                        'childs' => function ($query) use ($language) {
                            $query->select([
                                'id',
                                'parent_id',
                                "name_$language as name",
                                'slug'
                            ])->whereIsVisible(true)->orderByRaw('priority desc', 'name');
                        }
                    ]);
                }
            ])
            ->orderByRaw('priority desc', 'name')
            ->get([
                'id',
                'parent_id',
                'icon',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'picture_size',
                'priority'
            ]);
    }

    public function getCurrentCategoryBySlug($slug, $language)
    {
        return Category::whereSlug($slug)->whereIsVisible(true)
            ->first([
                'id',
                'parent_id',
                'icon',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'priority',
                'picture_size',
                "meta_title_$language as meta_title",
                "meta_description_$language as meta_description",
                "meta_keywords_$language as meta_keywords",
                "meta_h1_$language as meta_h1",
            ]);
    }

    public function getCurrentCategoryById($categoryId, $language)
    {
        return Category::whereId($categoryId)->whereIsVisible(true)
            ->first([
                'id',
                'parent_id',
                'icon',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'picture_size',
                'priority'
            ]);
    }
}