<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    //黑名单为空
    protected $guarded = [];
    protected $table = 'home_mission';
}
