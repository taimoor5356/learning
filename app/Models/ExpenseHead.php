<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class ExpenseHead extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    static public function getAllExpenseHeads() {
        $expenseHeads = self::with('expenses');
        if (!empty(Request::get('name'))) {
            $expenseHeads = $expenseHeads->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('invoice_number'))) {
            $expenseHeads = $expenseHeads->whereHas('expenses', function ($q) {
                $q->where('invoice_number', 'LIKE', '%' . Request::get('invoice_number') . '%');
            });
        }
        if (!empty(Request::get('description'))) {
            $expenseHeads = $expenseHeads->whereHas('expenses', function ($q) {
                $q->where('description', 'LIKE', '%' . Request::get('description') . '%');
            });
        }
        if (!empty(Request::get('from_date'))) {
            $expenseHeads = $expenseHeads->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $expenseHeads = $expenseHeads->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $expenseHeads->orderBy('id', 'desc');
    }

    static public function getSingleExpenseHead($id) {
        return self::find($id);
    }

    public function expenses() {
        return $this->hasMany(Expense::class, 'expense_head_id', 'id');
    }
}
