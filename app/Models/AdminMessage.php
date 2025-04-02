<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessage extends Model
{
    protected $table='admin_messages';
    protected $fillable = ['sender_id', 'subject', 'message'];

    public function sender()
    {
        return $this->belongsTo(Admin::class, 'sender_id');
    }

    public function recipients()
    {
        return $this->hasMany(AdminMessageRecipient::class, 'message_id');
    }
}
