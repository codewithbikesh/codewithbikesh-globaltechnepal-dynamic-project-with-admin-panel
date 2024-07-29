<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Ensure you include this for date manipulation

class Career extends Model
{
    use HasFactory;
    protected $table = 'careers';
    protected $fillable = ['jobCategory','position','totalPositions','qualification','experience','gender','lastDate','description','is_active'];



    public static function deleteRecordsWithCurrentDate()
    {
        // Get the current date
        $currentDate = Carbon::now()->format('Y-m-d');

        // Find records where lastDate matches the current date
        $records = self::whereDate('lastDate', $currentDate)->get();

        // Iterate through each record and delete it
        foreach ($records as $record) {
            $record->delete();
        }
    }
    
}
