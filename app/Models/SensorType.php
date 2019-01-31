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
 */
class SensorType extends Model
{
    protected $table = 'sensor_types';
    protected $fillable = ['name'];
}
