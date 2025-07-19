<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStudentFee extends Model
{
    use HasFactory;
    public function student()
    {
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function student_class()
    {
        return $this->belongsTo(StudentClassSetup::class, 'class_id', 'id');
    }

    public function year()
    {
        return $this->belongsTo(StudentYearSetup::class, 'year_id', 'id');
    }
    public function fee_category(){
        return $this->belongsTo(StudentFeeSetup::class,'fee_category_id','id');
    }
}
