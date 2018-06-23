<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    protected $fillable = ['name', 'desc', 'is_hide'];
}
