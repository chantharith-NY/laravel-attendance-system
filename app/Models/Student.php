<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id','class_id','gender','dob','roll_number'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassRoom::class,'class_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class,'student_id');
    }
}
