<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Request;

class SchoolClass extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    
    public function getStatusAttribute($value)
    {
        return $value == 0 ? 'In Active' : 'Active';
    }

    static public function getClasses() {
        $classes = self::with('user');
        if (!empty(Request::get('name'))) {
            $classes = $classes->where('name', 'LIKE', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('from_date'))) {
            $classes = $classes->whereDate('created_at', '>=', Request::get('from_date'));
        }
        if (!empty(Request::get('to_date'))) {
            $classes = $classes->whereDate('created_at', '<=', Request::get('to_date'));
        }
        return $classes->orderBy('id', 'desc');
    }

    static public function getSingleClass($id) {
        return self::find($id);
    }

    static public function getTrashedClasses() {
        return self::with('user')->onlyTrashed()->orderBy('id', 'desc');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
