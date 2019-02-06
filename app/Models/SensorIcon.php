<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SensorIcon
 *
 * @property int $id
 * @property string $icon
 * @property int $sensor_type
 * @property string $position_top
 * @property string $position_left
 * @property-read mixed $type_name
 * @property-read \App\Models\Sensor $sensor
 * @property-read \App\Models\SensorType $sensorType
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon whereIcon($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon wherePositionLeft($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon wherePositionTop($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorIcon whereSensorType($value)
 * @mixin \Eloquent
 */
class SensorIcon extends Model
{
    protected $table = 'sensor_icon';
    protected $fillable = ['sensor_type', 'icon', 'position_top', 'position_left'];
    protected $appends = ['type_name'];

    public function sensor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sensor::class, 'type', 'sensor_type');
    }

    public function sensorType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SensorType::class, 'id', 'sensor_type');
    }

    public function getTypeNameAttribute(): string
    {
        return $this->sensorType()->value('name');
    }
}
