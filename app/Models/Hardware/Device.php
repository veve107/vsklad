<?php

namespace App\Models\Hardware;

use App\Models\Request;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hardware\Device
 *
 * @property int $id
 * @property string $name
 * @property int $brand_id
 * @property int $type_id
 * @property int $order_id
 * @property string $serial_number
 * @property int $inventory_number
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Hardware\Brand $brand
 * @property-read \App\Models\Hardware\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection|Request[] $requests
 * @property-read int|null $requests_count
 * @property-read \App\Models\Hardware\Type $type
 * @method static \Illuminate\Database\Eloquent\Builder|Device newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Device query()
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereBrandId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereInventoryNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereSerialNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Device whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
