<?php
/**
 * Created by PhpStorm.
 * User: vlad_
 * Date: 29.01.2018
 * Time: 11:16
 */

namespace App\Repositories;


use App\DatabaseModels\MetaTag;

class MetaTagRepository
{
    public function getMetaTagByPageName($model)
    {
        return MetaTag::wherePageName($model->view)
            ->first([
                'meta_tags.id',
                "meta_tags.meta_title_$model->language as title",
                "meta_tags.meta_description_$model->language as description",
                "meta_tags.meta_keywords_$model->language as keywords",
                "meta_tags.meta_h1_$model->language as h1"
            ]);
    }
}