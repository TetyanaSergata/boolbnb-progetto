<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extra_service extends Model
{
    protected $fillable = [
        'name'
    ];

    public function flats(){
        return $this->belongsToMany('App\Flat');
    }
}
