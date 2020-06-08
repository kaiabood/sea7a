<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category',   'name', 'phone_number', 'city','time','contente','image','show','map'
           
   
       ];

       protected $hidden = [
        'created_at', 'updated_at',
    ];


}
