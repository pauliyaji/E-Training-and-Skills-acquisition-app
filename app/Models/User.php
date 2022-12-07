<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Rappasoft\LaravelAuthenticationLog\Traits\AuthenticationLoggable;




class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, AuthenticationLoggable;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'role',
        'status',
        'photo',
        'setting_id',
        'usertype_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Always encrypt password when it is updated.
     *
     * @param $value
     * @return string
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function role()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    public function states(){
        return $this->belongsTo(State::class, 'state_id');
    }

    public function settings(){
        return $this->belongsTo(Setting::class, 'setting_id');
    }

    public function usertypes(){
        return $this->hasOne(Usertype::class, 'usertype_id');
    }


}
