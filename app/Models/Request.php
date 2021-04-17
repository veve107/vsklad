<?php

namespace App\Models;

use App\Models\Hardware\Device;
use App\Models\Hardware\Type;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['reason'];
    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function devices(){
        return $this->belongsToMany(Device::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
