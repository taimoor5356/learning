<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseHead;
use Illuminate\Http\Request;

class ExpenseHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data['header_title'] = 'Expense Heads';
        $data['records'] = ExpenseHead::getAllExpenseHeads()->paginate(25);
        return view('admin.expense.heads.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data['header_title'] = 'Add Expense Head';
        return view('admin.expense.heads.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' =>'required|string',
        ]);
        $expenseHead = new ExpenseHead();
        $expenseHead->name = $request->name;
        $expenseHead->save(); //remove all save
        return redirect('admin/expenses/heads/list')->with('success', 'Expense Head successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ExpenseHead $expenseHead)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data['header_title'] = 'Edit Expense Head'; 
        $data['record'] = ExpenseHead::getSingleExpenseHead($id);
        if (!isset($data['record'])) {
            abort(404);
        }
        return view('admin.expense.heads.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        request()->validate([
            'name' =>'required|string',
        ]);
        $expenseHead = ExpenseHead::getSingleExpenseHead($id);
        if (!isset($expenseHead)) {
            abort(404);
        }
        $expenseHead->name = $request->name;
        $expenseHead->save(); //remove all save
        return redirect('admin/expenses/heads/list')->with('success', 'Expense Head successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ExpenseHead $expenseHead)
    {
        //
    }
}
