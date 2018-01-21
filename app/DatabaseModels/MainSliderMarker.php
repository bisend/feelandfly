<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\MainSliderMarker
 *
 * @property int $id
 * @property int $slide_id
 * @property int $product_id
 * @property int $priority
 * @property bool $is_visible
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereSlideId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\Product $product
 * @property int|null $position_x
 * @property int|null $position_y
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePositionX($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSliderMarker wherePositionY($value)
 */
class MainSliderMarker extends Model
{
    protected $table = 'main_slider_markers';

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
