<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $with = ['sender'];
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
