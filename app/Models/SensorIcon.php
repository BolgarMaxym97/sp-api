<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
