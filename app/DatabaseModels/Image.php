<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\Image
 *
 * @property int $id
 * @property string|null $original
 * @property string|null $big
 * @property string|null $medium
 * @property string|null $small
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereBig($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereMedium($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereOriginal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereSmall($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property bool $is_visible
 * @property int $priority
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\Image wherePriority($value)
 */
class Image extends Model
{
    protected $table = 'images';

//    private $noPhotos = [
//        'small' => '/public/img/product/small/no-photo.jpg',
//        'small-dev' => '/img/product/small/no-photo.jpg',
//    ];
//
//    public function getSmallAttribute($value)
//    {
//        $filePath = $_SERVER['DOCUMENT_ROOT'] . $value;
//        if (file_exists($filePath)) {
//            return $value;
//        }
//
//        return $this->getImage('small');
//    }
//
//    /**
//     * Returns image by the given size
//     * @param $size
//     * @return mixed
//     */
//    private function getImage($size)
//    {
//        if (strpos(url('/'), 'feelandfly.xyz') != false) {
//            return $this->noPhotos["$size-dev"];
//        }
//
//        return $this->noPhotos[$size];
//    }
}
