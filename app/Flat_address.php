<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Flat_address extends Model
{
    protected $fillable = [
        'flat_id',
        'street',
        'street_number',
        'zip_code',
        'city'
    ];
    
    public function flat(){
        return $this->belongsTo('App\Flat');
      }
}
