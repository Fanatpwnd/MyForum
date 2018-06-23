<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $fillable = ['body', 'user_id', 'thread_id', 'is_delete'];
}
