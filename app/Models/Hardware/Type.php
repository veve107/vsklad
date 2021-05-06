<?php

namespace App\Models\Hardware;

use App\Models\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Hardware\Type
 *
 * @mixin Builder
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hardware\Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Request[] $requests
 * @property-read int|null $requests_count
 * @method static Builder|Type newModelQuery()
 * @method static Builder|Type newQuery()
 * @method static Builder|Type query()
 * @method static Builder|Type whereCreatedAt($value)
 * @method static Builder|Type whereId($value)
 * @method static Builder|Type whereName($value)
 * @method static Builder|Type whereUpdatedAt($value)
 */
class Type extends Model
{
    protected $fillable = ['name', 'type'];

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function requests()
    {
        return $this->belongsToMany(Request::class);
    }
}
