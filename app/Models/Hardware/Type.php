<?php

namespace App\Models\Hardware;

use App\Models\Request;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    public function devices(){
        return $this->hasMany(Device::class);
    }

    public function requests(){
        return $this->belongsToMany(Request::class);
    }
}
