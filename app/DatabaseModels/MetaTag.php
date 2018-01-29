<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\MetaTag
 *
 * @property int $id
 * @property string $page_name
 * @property string $title_ru
 * @property string $title_uk
 * @property string $description_ru
 * @property string $description_uk
 * @property string $keywords_ru
 * @property string $keywords_uk
 * @property string $h1_ru
 * @property string $h1_uk
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereH1Ru($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereH1Uk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereKeywordsRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereKeywordsUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag wherePageName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MetaTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MetaTag extends Model
{
    protected $table = 'meta_tags';
}
