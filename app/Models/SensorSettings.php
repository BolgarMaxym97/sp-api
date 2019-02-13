<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorSettings extends Model
{
    protected $table = 'sensor_settings';
    protected $fillable = ['sensor_id', 'max_normal_value', 'min_normal_value'];

    public function sensor(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Sensor::class, 'id', 'sensor_id');
    }
}
