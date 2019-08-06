<?php

namespace App;

use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password', 'image', 'phone', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'password',
    ];

    protected $casts = [
        'address' => 'array'
    ];
/*
    protected $uploads = '/images/';
    
    public function getImageAttribute($image){
        return $this->uploads . $image;
    }
*/

    public function order(){
        return $this->hasMany('App\Order');
    }
}
