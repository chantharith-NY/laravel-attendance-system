<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $table = 'attendance';
    protected $fillable = ['class_id','student_id','teacher_id','date','status','note'];

    public function class()
    {
        return $this->belongsTo(ClassRoom::class,'class_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class,'teacher_id');
    }
}
