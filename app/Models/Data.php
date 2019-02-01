<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Data
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data query()
 * @mixin \Eloquent
 * @property int $id
 * @property float $data
 * @property int $user_id
 * @property int $sensor_id
 * @property int $node_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereNodeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereSensorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Data whereUserId($value)
 */
class Data extends Model
{
    protected $table = 'data';
    protected $fillable = ['data', 'user_id', 'sensor_id', 'node_id'];
}
