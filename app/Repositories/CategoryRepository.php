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
                    ])->orderByRaw('priority desc', 'name');
                    $query->with([
                        'childs' => function ($query) use ($language) {
                            $query->select([
                                'id',
                                'parent_id',
                                "name_$language as name",
                                'slug'
                            ])->orderByRaw('priority desc', 'name');
                        }
                    ]);
                }
            ])
            ->get([
                'id',
                'parent_id',
                'icon',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'priority'
            ]);
    }

    public function getCurrentCategoryBySlug($slug, $language)
    {
        return Category::with([
            'meta_tag' => function ($query) use ($language) {
                $query->select([
                    'meta_tags.id',
                    "meta_tags.title_$language as title",
                    "meta_tags.description_$language as description",
                    "meta_tags.keywords_$language as keywords",
                    "meta_tags.h1_$language as h1"
                ]);
            }
        ])
            ->whereSlug($slug)->whereIsVisible(true)
            ->first([
                'id',
                'parent_id',
                'meta_tag_id',
                'icon',
                "name_$language as name",
                'slug',
                "description_$language as description",
                'priority'
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
                'priority'
            ]);
    }
}