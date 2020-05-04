<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'flat_id',
        'email',
        'title',
        'message'
    ];

    public function flat()
    {
        return $this->belongsTo('App\Flat');
    }
}
