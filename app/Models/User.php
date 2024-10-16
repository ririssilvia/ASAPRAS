<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role_id'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class, 'reported_by');
    }

    public function repairActivities()
    {
        return $this->hasMany(RepairActivity::class, 'assigned_to');
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function notifications()
    {
        return $this->hasManyThrough(
            Notification::class,
            UserNotification::class,
            'id_user', // Foreign key on the UserNotification table...
            'id', // Foreign key on the Notification table...
            'id', // Local key on the Notification table...
            'id_notification' // Local key on the UserNotification table...
        );
    }

    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    // Check if the user is an admin
    // public function isAdmin()
    // {
    //     return $this->role && $this->role->name === 'admin';
    // }
}

