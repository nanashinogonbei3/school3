<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Instructor extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $guarded = [
        'id',
    ];
   


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public static $rules = array(
        'last_name' => 'required',
        'first_name' => 'required',
        'password' => 'required',
        'email' => 'required',
        'phone_no' => 'required',
        'profile' => 'required',
        'introduction' => 'required',
        'profession' => 'required',
        'img' => 'required',
    );

    // hasMany() インストラクター１人に対して、レッスンは複数
    public function lesson()
    {
        return $this->hasMany("App\Lesson");
    }
}
