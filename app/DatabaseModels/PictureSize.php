<?php
/**
 * Created by PhpStorm.
 * User: Viktor
 * Date: 24.05.2018
 * Time: 22:51
 */

namespace App\DatabaseModels;
use Illuminate\Database\Eloquent\Model;


/**
 * App\DatabaseModels\PictureSize
 *
 * @property int $id
 * @property int $category_id
 * @property string|null $original
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string|null $image_size
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\PictureSize whereImageSize($value)
 */
class PictureSize extends Model
{
    protected $table = 'picture_size';
}