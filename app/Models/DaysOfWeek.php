<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaysOfWeek extends Model
{
    use HasFactory;

    static public function getWeekDays()
    {
        return DaysOfWeek::get();
    }

    static public function getWeekDayUsingName($dayName)
    {
        return self::where('name', $dayName)->first();
    }
}
