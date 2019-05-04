<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

/**
 * App\Models\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Client[] $clients
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Passport\Token[] $tokens
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @mixin \Eloquent
 * @property int $id
 * @property string $email
 * @property string|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property string $name_first
 * @property string $name_last
 * @property string $phone
 * @property int $is_active
 * @property string|null $avatar
 * @property string|null $last_visit_time
 * @property string|null $auth_key
 * @property string|null $access_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAuthKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereLastVisitTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNameFirst($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereNameLast($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 * @property int $is_customer
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User customers()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereIsCustomer($value)
 * @property string $address
 * @property-read mixed $full_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereAddress($value)
 * @property-read mixed $nodes_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Node[] $nodes
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User admins()
 * @property string|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User withoutTrashed()
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes;

    protected $fillable = [
        'email', 'password', 'name_first', 'name_last', 'phone', 'is_customer', 'address'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = ['full_name', 'nodes_count'];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeCustomers($query)
    {
        return $query->where('is_customer', 1);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeAdmins($query)
    {
        return $query->where('is_customer', 0);
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function nodes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Node::class, 'user_id', 'id');
    }

    public function getNodesCountAttribute(): string
    {
        return count($this->nodes);
    }

    public function getFullNameAttribute(): string
    {
        return $this->name_first . ' ' . $this->name_last;
    }
}
