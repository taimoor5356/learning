<?php

namespace App\Http\Controllers;

use App\Models\FeeCollection;
use App\Models\SchoolClass;
use App\Models\SubmittedFee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $data['records'] = SubmittedFee::getStudentFees($id)->paginate(10);
        $data['paid_amount'] = SubmittedFee::getStudentPaidFees($id, Auth::user()->class_id);
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
        $data['records'] = SubmittedFee::getFeeCollectionReport()->paginate(10);
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
        $data['records'] = User::getFeeCollectedStudents()->paginate(10);
        return view('admin.fee_collection.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        //
        $data['header_title'] = 'Collect Fee';
        $data['classes'] = SchoolClass::getClasses()->get();
        $data['user'] = User::getSingleUser($id)->first();
        $data['records'] = SubmittedFee::getStudentFees($id)->paginate(10);
        $data['paid_amount'] = SubmittedFee::getStudentPaidFees($id, $data['user']->class_id);
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
                $classId = $user->class_id;
            }
            $paidAmount = SubmittedFee::getStudentPaidFees($id, $classId);
            $remainingAmount = $user->class?->amount - $paidAmount;
            if ($remainingAmount >= $request->amount) {
                $amountToBePaid = $remainingAmount - $request->amount;
                $submittedFee = new SubmittedFee();
                $submittedFee->user_id = $id;
                $submittedFee->class_id = $classId;
                $submittedFee->total_amount = $remainingAmount;
                $submittedFee->paid_amount = $request->amount;
                $submittedFee->remaining_amount = $amountToBePaid;
                $submittedFee->payment_type = $request->payment_type;
                $submittedFee->description = $request->description;
                $submittedFee->created_by = Auth::user()->id;
                $submittedFee->save();
                return redirect()->back()->with('success', 'Fee submitted successfully');
            } else {
                return redirect()->back()->with('error', 'You can not submit more than the remaining amount');
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
}
