<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isManager () {
        $count_id_in_table = Rights::where('id_user', $this->id)->where('rights','manager')->count();
        return $count_id_in_table != 0 ? true : false;
    }

    public function isClient () {
        $count_id_in_table = Rights::where('id_user', $this->id)->count();
        return $count_id_in_table == 0 ? true : false;
    }

}
