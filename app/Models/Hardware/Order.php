<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function devices(){
        return $this->hasMany('App\Models\Hardware\Device');
    }
}
