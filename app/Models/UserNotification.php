<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_user',
        'id_notification',
        'read_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function notification()
    {
        return $this->belongsTo(Notification::class, 'id_notification');
    }
}
