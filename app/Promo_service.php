<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo_service extends Model
{
    protected $fillable = [

        'type',
        'time',
        'price'
    ];

    public function flats(){
        return $this->belongsToMany('App\Flat');
    }
}
