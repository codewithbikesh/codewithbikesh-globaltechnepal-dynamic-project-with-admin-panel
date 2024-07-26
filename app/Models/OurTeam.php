<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeam extends Model
{
    use HasFactory;
    protected $table = 'our_teams';
    protected $fillable = [
        'name',
        'position',
        'facebook',
        'twitter',
        'linkedin',
        'image',
        'is_active',
    ];
}
