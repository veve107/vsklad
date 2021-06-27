<?php

namespace App\Models\Hardware;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hardware\Order
 *
 * @property int $id
 * @property int $order_number
 * @property string $delivery_date
 * @property string $end_of_warranty
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hardware\Device[] $devices
 * @property-read int|null $devices_count
 * @method static \Illuminate\Database\Eloquent\Builder|Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereDeliveryDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereEndOfWarranty($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Order whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Order extends Model
{
    protected $fillable = ['order_number', 'delivery_date', 'end_of_warranty'];
    public function devices(){
        return $this->hasMany('App\Models\Hardware\Device');
    }
}
