<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'avatar', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //Which comments belongs to this user
    function comments(){
      return $this->belongsTo('App\Comment');
    }
    //Which roles belongs to this user
    function roles(){
      return $this->belongsTo('App\Role');
    }

    //Do this user has x role?
    public function hasRole($role)
    {
      return null !== $this->roles()->where('name', $role)->first();
    }
}
