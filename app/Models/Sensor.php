<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Sensor
 *
 * @property int $id
 * @property int $type
 * @property int $user_id
 * @property int $node_id
 * @property \Illuminate\Support\Carbon|null $last_data_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $type_name
 * @property-read \App\Models\SensorType $sensorType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereLastDataTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Sensor whereUserId($value)
 * @mixin \Eloquent
 */
class Sensor extends Model
{
    protected $table = 'sensors';
    protected $fillable = ['type', 'user_id', 'node_id', 'last_data_time'];
    protected $dates = [
        'created_at',
        'updated_at',
        'last_data_time'
    ];
    protected $appends = ['type_name'];

    public function sensorType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SensorType::class, 'id', 'type');
    }

    public function node(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Node::class, 'id', 'node_id');
    }

    public function icon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SensorIcon::class, 'sensor_type', 'type');
    }

    public function getTypeNameAttribute(): string
    {
        return $this->sensorType()->value('name');
    }
}
