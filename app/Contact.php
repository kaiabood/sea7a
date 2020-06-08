<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    
    protected $fillable = [
        'subject', 'name', 'email', 'message' , 
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];
}


