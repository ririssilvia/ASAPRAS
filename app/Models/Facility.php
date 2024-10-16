<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'location', 'status'];

    public function damageReports()
    {
        return $this->hasMany(DamageReport::class);
    }
}
