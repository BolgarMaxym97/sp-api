<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\SensorSettings
 *
 * @property int $id
 * @property int $sensor_id
 * @property float|null $max_normal_value
 * @property float|null $min_normal_value
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sensor $sensor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereMaxNormalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereMinNormalValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereSensorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\SensorSettings whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SensorSettings extends Model
{
    protected $table = 'sensor_settings';
    protected $fillable = ['sensor_id', 'max_normal_value', 'min_normal_value'];

    public static function rules(): array
    {
        return [
            'sensor_id' => ['sometimes', 'required', 'integer'],
            'min_normal_value' => ['required', 'numeric'],
            'max_normal_value' => ['required', 'numeric'],
        ];
    }

    public function sensor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sensor::class, 'id', 'sensor_id');
    }
}
