<?php

namespace App\Exports;

use App\Models\SubmittedFee;
use App\Models\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class FeeExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $users = User::with('class')->where('user_type', 3)->get();
        $arr = [];
        foreach ($users as $key => $user) {
            $submittedFee = SubmittedFee::where('user_id', $user->id)->where('class_id', $user->class_id);
            $lastSubmittedFee = $submittedFee->orderBy('id', 'desc')->first();
            $date = now();
            if (isset($lastSubmittedFee)) {
                $date = $lastSubmittedFee->created_at;
            }
            $paidAmount = $submittedFee->sum('paid_amount');
            $arr[$key]['name'] = $user->name;
            $arr[$key]['email'] = $user->email;
            $arr[$key]['batch'] = $user->batch_number;
            $arr[$key]['class_type'] = $user->class_type;
            $arr[$key]['program'] = $user->class_program;
            $arr[$key]['class'] = $user->class?->name;
            $arr[$key]['roll_number'] = $user->roll_number;
            $arr[$key]['mobile_number'] = $user->mobile_number;
            $arr[$key]['total_fee'] = $user->class?->amount;
            $arr[$key]['discount'] = $user->discounted_amount;
            $arr[$key]['paid_fee'] = $paidAmount;
            $arr[$key]['remaining_fee'] = (isset($user->class) ? $user->class->amount : 0) - ($paidAmount + $user->discounted_amount);
            $arr[$key]['last_created_date'] = Carbon::parse($date)->format('Y-m-d');
        }
        return collect($arr);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Name", "Email", "Batch", "Class Type", "Program", "Class", "Roll Number", "Mobile Number", "Total Fee", "Discount", "Paid Fee", "Remaining Fee", "Last Created Date"];
    }
}
