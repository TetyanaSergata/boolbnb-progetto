<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'flat_id',
        'path_image'
    ];

    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
