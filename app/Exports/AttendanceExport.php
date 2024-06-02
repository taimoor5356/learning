<?php

namespace App\Exports;

use App\Models\Attendance;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AttendanceExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::where('user_type', 3)->get();
        $arr = [];
        foreach ($users as $key => $user) {
            $attendance = Attendance::where('user_id', $user->id)->where('date', date('Y-m-d'))->first();
            $arr[$key]['name'] = $user->name;
            $arr[$key]['email'] = $user->email;
            $arr[$key]['batch'] = $user->batch;
            $arr[$key]['class_type'] = $user->class_type;
            $arr[$key]['program'] = $user->program;
            $arr[$key]['class'] = $user->class;
            $arr[$key]['roll_number'] = $user->roll_number;
            $arr[$key]['mobile_number'] = $user->mobile_number;
            $arr[$key]['attendance_status'] = $user->attendance_status;
            $arr[$key]['date'] = $user->date;
            $arr[$key]['created_by'] = $user->created_by;
        }
        return Attendance::all();
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Name", "Email", "Batch", "Class Type", "Program", "Class", "Roll Number", "Mobile Number", "Attendance Status", "Date", "Created By"];
    }
}
