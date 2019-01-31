<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\NodeType
 *
 * @property int $id
 * @property string $name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NodeType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NodeType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NodeType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NodeType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\NodeType whereName($value)
 * @mixin \Eloquent
 */
class NodeType extends Model
{
    protected $table = 'node_types';
    protected $fillable = ['name'];
}
