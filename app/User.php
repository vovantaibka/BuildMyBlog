<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function searches()
    {
        return $this->hasMany('App\Search');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getImageAttribute($value)
    {
        return url('/imgs/'.$value);
    }
}
