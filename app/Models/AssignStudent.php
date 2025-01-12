<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignStudent extends Model
{
    use HasFactory;


    public function student(){
        return $this->belongsTo(User::class,'student_id','id');
    }

    public function studentClass()
    {
        return $this->belongsTo(StudentClassSetup::class, 'class_id', 'id');
    }

    public function year()
    {
        return $this->belongsTo(StudentYearSetup::class, 'year_id', 'id');
    }

    public function discount()
    {
        return $this->belongsTo(DiscountStudent::class, 'id', 'assign_student_id');
    }


}
