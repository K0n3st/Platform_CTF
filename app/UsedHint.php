<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedHint extends Model
{
    public function hint(){
        return $this->belongsTo('App\Challenge');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
    
}
