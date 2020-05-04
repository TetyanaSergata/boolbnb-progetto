<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_info extends Model
{
    protected $fillable=[
        'user_id',
        'path_image',
        'address',
        'phone_number',
        'gender'
        
    ];

    public function user(){
        return $this->belongsTo('App\User');
      }
}
