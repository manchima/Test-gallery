<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picdatas extends Model
{
    //
    protected $fillable = [
        'user_id', 'image_name', 'image_size', 'type',
    ];
}
