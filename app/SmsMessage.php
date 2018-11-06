<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsMessage extends Model
{
    public function conversation() {
        return $this->belongsTo(Conversation::class);
    }
}
