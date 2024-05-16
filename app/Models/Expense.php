<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Request;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    static public function getAllExpenses() {
        $expenses = self::with('expense_head');
        if (!empty(Request::get('expense_head_id'))) {
            $expenses = $expenses->whereHas('expense_head', function ($q) {
                $q->where('id', Request::get('expense_head_id'));
            });
        }
        if (!empty(Request::get('invoice_number'))) {
            $expenses = $expenses->where('invoice_number', 'LIKE', '%' . Request::get('invoice_number') . '%');
        }
        if (!empty(Request::get('description'))) {
            $expenses = $expenses->where('description', 'LIKE', '%' . Request::get('description') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $expenses = $expenses->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $expenses = $expenses->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $expenses->orderBy('id', 'desc');
    }

    static public function getSingleExpense($id) {
        return self::find($id);
    }

    public function expense_head() {
        return $this->belongsTo(ExpenseHead::class, 'expense_head_id', 'id');
    }
}
