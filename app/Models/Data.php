<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';
    protected $fillable = ['data', 'user_id', 'sensor_id', 'node_id', 'type'];

    public const TYPE_TEMPERATURE = 'temperature';
}
