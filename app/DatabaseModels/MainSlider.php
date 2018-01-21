<?php

namespace App\DatabaseModels;

use Illuminate\Database\Eloquent\Model;

/**
 * App\DatabaseModels\MainSlider
 *
 * @property int $id
 * @property int $image_id
 * @property int $priority
 * @property bool $is_visible
 * @property string|null $code_1c
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereCode1c($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereIsVisible($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider wherePriority($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\DatabaseModels\MainSlider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \App\DatabaseModels\Image $image
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\DatabaseModels\MainSliderMarker[] $markers
 */
class MainSlider extends Model
{
    protected $table = 'main_slider';
    
    public function markers()
    {
        return $this->hasMany(MainSliderMarker::class, 'slide_id', 'id');
    }
    
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'image_id');
    }
}
