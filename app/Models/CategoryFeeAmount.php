<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFeeAmount extends Model
{
    use HasFactory;

    protected $fillable = ['class_id', 'amount', 'fee_category_id'];


    public function fee_category()
    {
        return $this->belongsTo(StudentFeeSetup::class, 'fee_category_id', 'id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClassSetup::class, 'class_id', 'id');
    }
}
