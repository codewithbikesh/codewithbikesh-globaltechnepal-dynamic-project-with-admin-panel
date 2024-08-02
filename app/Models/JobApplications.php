<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    use HasFactory;

    protected $table = "job_applications";
    protected $fillable = [
        'name',
        'email',
        'career_id',
        'mobile_number',
        'address',
        'cover_letter',
        'resume',
        // 'is_active',
    ];

    public function Career()
    {
        return $this->belongsTo(Career::class, 'career_id');
    }
}
