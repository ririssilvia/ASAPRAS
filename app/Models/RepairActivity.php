<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairActivity extends Model
{
    use HasFactory;

    protected $table = 'repair_activities';  // Menentukan nama tabel

    // Menentukan field yang bisa diisi
    protected $fillable = [
        'report_id',
        'assigned_to',
        'start_date',
        'end_date',
        'remarks'
    ];

    // Relasi ke DamageReport
    public function damageReport()
    {
        return $this->belongsTo(DamageReport::class, 'report_id');
    }

    // Relasi ke User yang ditugaskan
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
