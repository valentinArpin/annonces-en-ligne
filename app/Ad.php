<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    //une annonce correspond a un utilisateur,

    public function user()
    {
    return $this->belongsTo('App\User');
    }
}
