<?php

namespace App\Models;

use App\Models\Hardware\Device;
use App\Models\Hardware\Type;
use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Request
 *
 * @property int $id
 * @property int $user_id
 * @property string $reason
 * @property int|null $technician_id
 * @property int $state_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Device[] $devices
 * @property-read int|null $devices_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Type[] $types
 * @property-read int|null $types_count
 * @property-read User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Request newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Request query()
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereStateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereTechnicianId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Request whereUserId($value)
 * @mixin \Eloquent
 */
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
