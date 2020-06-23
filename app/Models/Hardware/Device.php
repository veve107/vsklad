<?php

namespace App\Models\Hardware;

use App\Models\Request;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'name', 'brand_id', 'type_id', 'order_id', 'serial_number', 'inventory_number'
    ];

    public function brand(){
        return $this->belongsTo('App\Models\Hardware\Brand');
    }

    public function order(){
        return $this->belongsTo('App\Models\Hardware\Order');
    }

    public function type(){
        return $this->belongsTo('App\Models\Hardware\Type');
    }

    public function requests(){
        return $this->belongsToMany(Request::class);
    }
}
