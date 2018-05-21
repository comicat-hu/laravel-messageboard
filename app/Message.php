<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['name'];

    /**
     * Get user of the message
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
