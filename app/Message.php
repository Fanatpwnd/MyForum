<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function thread()
    {
        return $this->belongsTo(Thread::class, 'thread_id');
    }

    protected $primaryKey = 'msg_id';
}
