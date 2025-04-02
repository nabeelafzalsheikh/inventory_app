<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $guard_name = 'web'; // Ensure this is set correctly
    protected $table = 'admins'; // Specify the table name if different

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

// app/Models/Admin.php

public function messages()
{
    return $this->hasMany(AdminMessageRecipient::class, 'recipient_id');
}

public function unreadMessages()
{
    return $this->messages()->where('is_read', false);
}

public function recentMessages($limit = 5)
{
    return $this->messages()
               ->with(['message.sender'])
               ->latest()
               ->limit($limit)
               ->get();
}

}