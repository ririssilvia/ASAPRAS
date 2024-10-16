<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DamageReport extends Model
{
    use HasFactory;

    protected $fillable = ['facility_id', 'reported_by', 'description', 'image_url', 'status'];

    public function facility()
    {
        return $this->belongsTo(Facility::class);
    }

    public function reportedBy()
{
    return $this->belongsTo(User::class, 'reported_by');
}

}
