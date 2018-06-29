<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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

    public function userInfo()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function isAdmin()
    {
        return $this->userInfo->policy == 'admin';
    }

    public function isModerator()
    {
        return $this->userInfo->policy == 'moderator';
    }

    public function isVIP()
    {
        return $this->userInfo->policy == 'VIP';
    }

    public function isWriter()
    {
        return $this->userInfo->policy == 'writer';
    }

    public function isReader()
    {
        return $this->userInfo->policy == 'reader';
    }
}
