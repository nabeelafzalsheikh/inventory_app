<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminMessageRecipient extends Model
{
    protected $fillable = ['message_id', 'recipient_id', 'is_read', 'read_at'];
    protected $table='admin_message_recipients';

    public function message()
    {
        return $this->belongsTo(AdminMessage::class);
    }

    public function recipient()
    {
        return $this->belongsTo(Admin::class, 'recipient_id');
    }
}
