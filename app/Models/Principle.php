<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Principle extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'home_principle';

    public function getImagesAttribute($images)
    {
        return array_values(json_decode($images, true) ?: []);
    }

    public function setImagesAttribute($images)
    {
        $this->attributes['images'] = json_encode(array_values($images));
    }
}
