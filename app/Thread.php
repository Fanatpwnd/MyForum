<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $primaryKey = 'thread_id';

    public function messages()
    {
        return $this->hasMany(Message::class, 'msg_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
