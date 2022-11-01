<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id');
    }
    public function userroles(){
        
        return $this->belongsToMany(UserRole::class, 'user_id', 'role_id');
    }

    public function getRolesAttribute($value)
    {


       return $value->roles;
    }


    //one to many relationship with OauthAccessToken table

    public function AauthAcessToken()
    {
        return $this->hasMany('\App\OauthAccessToken');
    }

    //get created at format

    public function getCreatedAtAttribute($value){

        return Carbon::parse($value)->format('M, D, Y');

    }
}
