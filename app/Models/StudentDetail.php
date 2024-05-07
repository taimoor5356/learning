<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentDetail extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id', 'id');
    }
}
