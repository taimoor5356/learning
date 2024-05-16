<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Expenses';
        $data['expenseHeads'] = ExpenseHead::getAllExpenseHeads()->get();
        $data['records'] = Expense::getAllExpenses()->paginate(25);
        return view('admin.expense.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add New Expense';
        $data['expenseHeads'] = ExpenseHead::getAllExpenseHeads()->get();
        return view('admin.expense.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'expense_head_id' =>'required|integer',
            'invoice_number' =>'required|string',
            'description' =>'required',
            'amount' =>'required|integer',
        ]);
        $expense = new Expense();
        $expense->expense_head_id = $request->expense_head_id;
        $expense->invoice_number = $request->invoice_number;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        if (!empty($request->file('file'))) {
            $ext = $request->file('file')->getClientOriginalExtension();
            $file = $request->file('file');
            $randomStr = Str::random(10);
            $fileName = 'exp' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/expenses/', $fileName);
            $expense->file = $fileName;
        }
        $expense->save();
        return redirect('admin/expenses/list')->with('success', 'Expense successfully added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Expense'; 
        $data['expenseHeads'] = ExpenseHead::getAllExpenseHeads()->get();
        $data['record'] = Expense::getSingleExpense($id);
        if (!isset($data['record'])) {
            abort(404);
        }
        return view('admin.expense.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'expense_head_id' =>'required|integer',
            'invoice_number' =>'required|string',
            'description' =>'required',
            'amount' =>'required',
        ]);
        $expense = Expense::getSingleExpense($id);
        if (!isset($expense)) {
            abort(404);
        }
        $expense->expense_head_id = $request->expense_head_id;
        $expense->invoice_number = $request->invoice_number;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        if (!empty($request->file('file'))) {
            $ext = $request->file('file')->getClientOriginalExtension();
            $file = $request->file('file');
            $randomStr = Str::random(10);
            $fileName = 'exp' . strtolower($randomStr). '.'. $ext;
            $file->move('public/images/expenses/', $fileName);
            $expense->file = $fileName;
        }
        $expense->save();
        return redirect('admin/expenses/list')->with('success', 'Expense successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expense $expense)
    {
        //
    }
}
