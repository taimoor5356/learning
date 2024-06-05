<?php

namespace App\Http\Controllers;

use App\Exports\FeeExport;
use App\Models\FeeCollection;
use App\Models\SchoolClass;
use App\Models\SubmittedFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class FeeCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function studentFeesCollection()
    {
        //
        $id = Auth::user()->id;
        $data['header_title'] = 'My Fee Details';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['user'] = User::getSingleUser($id)->first();
        $data['records'] = SubmittedFee::getStudentFees($id)->paginate(25);
        $data['paid_amount'] = SubmittedFee::getStudentPaidFees($id, Auth::user()->batch_number);
        $data['refunded_amount'] = SubmittedFee::getStudentRefundedFees($id, Auth::user()->batch_number);
        return view('admin.fee_collection.collect_fee', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function feeCollectionReport()
    {
        //
        $data['header_title'] = 'Fee Collection Report';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['records'] = SubmittedFee::getFeeCollectionReport()->paginate(25);
        return view('admin.fee_collection.report', $data);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Students Fee List';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['records'] = User::getFeeCollectedStudents()->paginate(25);
        return view('admin.fee_collection.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $data['id'] = $id;
        $data['header_title'] = 'Collect Fee';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['user'] = User::getSingleUser($id)->first();
        $data['records'] = SubmittedFee::getStudentFees($id)->paginate(25);
        $data['paid_amount'] = SubmittedFee::getStudentPaidFees($id, $data['user']->batch_number);
        $data['refunded_amount'] = SubmittedFee::getStudentRefundedFees($id, $data['user']->batch_number);
        return view('admin.fee_collection.collect_fee', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        //
        if (!empty($request->amount) && ($request->amount > 0)) {
            $user = User::getStudentSingleClass($id)->first();
            $classId = 0;
            if (isset($user)) {
                $classId = $user->batch_number;
            }
            $paidAmount = SubmittedFee::getStudentPaidFees($id, $classId);
            $refundedAmount = SubmittedFee::getStudentRefundedFees($id, $classId);
            $remainingAmount = ($user->total_fees - $user->discounted_amount - $paidAmount) + ($refundedAmount);
            if ($remainingAmount >= $request->amount) {
                $amountToBePaid = $remainingAmount - $request->amount;
                $submittedFee = new SubmittedFee();
                $submittedFee->user_id = $id;
                $submittedFee->class_id = $classId;
                $submittedFee->total_amount = $remainingAmount;
                $submittedFee->paid_amount = $request->amount;
                $submittedFee->refund_amount = 0;
                $submittedFee->remaining_amount = $amountToBePaid;
                $submittedFee->payment_type = $request->payment_type;
                $submittedFee->installment = $request->installment;
                $submittedFee->description = $request->description;
                $submittedFee->challan_number = $request->challan_number;
                $submittedFee->created_by = Auth::user()->id;
                $submittedFee->save(); //remove all save
                return redirect()->back()->with('success', 'Fee submitted successfully');
            } else {
                return redirect()->back()->with('error', 'You can not submit more than the remaining amount');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter a valid amount');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function refund(Request $request, $id)
    {
        //
        if (!empty($request->amount) && ($request->amount > 0)) {
            $user = User::getStudentSingleClass($id)->first();
            $classId = 0;
            if (isset($user)) {
                $classId = $user->batch_number;
            }
            $paidAmount = SubmittedFee::getStudentPaidFees($id, $classId);
            $refundedAmount = SubmittedFee::getStudentRefundedFees($id, $classId);
            $remainingAmount = ($user->total_fees - $user->discounted_amount - $paidAmount) + ($refundedAmount);
            if (($paidAmount - $refundedAmount) >= $request->amount && $request->amount <= 15000) {
                $amountToBePaid = $remainingAmount + $request->amount;
                $submittedFee = new SubmittedFee();
                $submittedFee->user_id = $id;
                $submittedFee->batch_id = $classId;
                $submittedFee->class_id = $classId;
                $submittedFee->total_amount = $remainingAmount;
                $submittedFee->paid_amount = 0;
                $submittedFee->refund_amount = $request->amount;
                $submittedFee->remaining_amount = $amountToBePaid;
                $submittedFee->payment_type = $request->payment_type;
                $submittedFee->installment = $request->installment;
                $submittedFee->description = $request->description;
                $submittedFee->challan_number = $request->challan_number;
                $submittedFee->created_by = Auth::user()->id;
                $submittedFee->save(); //remove all save
                return redirect()->back()->with('success', 'Fee submitted successfully');
            } else {
                return redirect()->back()->with('error', 'Please check amounts again');
            }
        } else {
            return redirect()->back()->with('error', 'Please enter a valid amount');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FeeCollection $feeCollection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FeeCollection $feeCollection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FeeCollection $feeCollection)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FeeCollection $feeCollection)
    {
        //
    }

    public function export()
    {
        return Excel::download(new FeeExport, 'fee_report.xlsx');
    }
}
