<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getRoles()
    {
        return ['admin', 'moderator', 'VIP', 'writer', 'reader'];
    }

    protected $fillable = ['user_id', 'nickname', 'avatar_path', 'bio'];
}
