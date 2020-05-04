<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'flat_id',
        'ip_address',
        'created_at'
    ];

    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
