<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['order_number', 'delivery_date', 'end_of_warranty'];
    public function devices(){
        return $this->hasMany('App\Models\Hardware\Device');
    }
}
