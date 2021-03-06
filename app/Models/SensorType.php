<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SensorType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType whereName($value)
 * @mixin \Eloquent
 * @property string|null $dimension
 * @property-read \App\Models\SensorIcon $sensorIcon
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorType whereDimension($value)
 */
class SensorType extends Model
{
    protected $table = 'sensor_types';
    protected $fillable = ['name', 'dimension'];

    const TYPE_TEMPERATURE = 1;
    const TYPE_HUMIDITY = 2;
    const TYPE_GERCON_1 = 3;
    const TYPE_GERCON_2 = 4;

    public function sensorIcon(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SensorIcon::class, 'sensor_type', 'id');
    }
}
