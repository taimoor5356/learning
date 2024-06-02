<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DaysOfWeek;

class DaysOfWeekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
        $calendarDay = ['1', '2', '3', '4', '5', '6', '0'];
        for ($i = 0; $i < count($days); $i++) {
            DaysOfWeek::create([
                'name' => $days[$i],
                'fullcalendar_day' => $calendarDay[$i],
            ]);
        }
    }
}
