<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
 * @property-read mixed $existing_types
 * @property-read mixed $type_name
 * @property-read \App\Models\NodeType $nodeType
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sensor[] $sensors
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Node onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Node whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Node withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Node withoutTrashed()
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Data[] $data
 */
class Node extends Model
{
    use SoftDeletes;

    protected $table = 'nodes';
    protected $fillable = ['type', 'object_name', 'user_id'];
    protected $appends = ['type_name', 'existing_types'];
    protected $dates = ['deleted_at'];

    public static function rules(): array
    {
        return [
            'user_id' => ['sometimes', 'required', 'integer'],
            'type' => ['required', 'integer'],
            'object_name' => ['required', 'string', 'max:255'],
        ];
    }

    public function nodeType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(NodeType::class, 'id', 'type');
    }

    public function sensors(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Sensor::class, 'node_id', 'id');
    }

    public function data(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Data::class, 'node_id', 'id');
    }

    public function getTypeNameAttribute(): string
    {
        return $this->nodeType->name;
    }

    public function getExistingTypesAttribute(): array
    {
        return $this->sensors->pluck('type')->toArray();
    }
}
