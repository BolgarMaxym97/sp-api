<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'email', 'password', 'name_first', 'name_last', 'phone'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // TODO: add all rules and translate messages
    public static function rules(): array
    {
        return [
            'name_first' => ['required'],
            'name_last' => ['required'],
            'phone' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ];
    }
}
