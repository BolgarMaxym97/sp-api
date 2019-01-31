<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Node
 *
 * @property int $id
 * @property int $type
 * @property string $object_name
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereObjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereUserId($value)
 * @mixin \Eloquent
 */
class Node extends Model
{
    protected $table = 'nodes';
    protected $fillable = ['type', 'object_name', 'user_id'];
    protected $appends = ['type_name'];

    public function nodeType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(NodeType::class, 'id', 'type');
    }

    public function getTypeNameAttribute() : string
    {
        return $this->nodeType()->value('name');
    }
}
