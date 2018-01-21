<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\Blog
 *
 * @property int $id
 * @property int $image_id
 * @property string $title_ru
 * @property string $title_uk
 * @property string $slug
 * @property string|null $description_ru
 * @property string|null $description_uk
 * @property string|null $short_description_ru
 * @property string|null $short_description_uk
 * @property int $number_of_views
 * @property string|null $code_1c
 * @property int $priority
 * @property bool $is_visible
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\DatabaseModels\Image $image
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereNumberOfViews($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereShortDescriptionRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereShortDescriptionUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereTitleRu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereTitleUk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Blog whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Blog extends Model
{
    use \Laravelrus\LocalizedCarbon\Traits\LocalizedEloquentTrait;

    protected $table = 'blogs';

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
