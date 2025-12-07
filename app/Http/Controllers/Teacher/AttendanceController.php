<?php

namespace App\Http\Controllers\Teacher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ClassRoom;
use App\Models\Attendance;
use App\Models\Student;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function show(ClassRoom $class)
    {
        $students = $class->students()->with('user')->get();
        $today = Carbon::today()->toDateString();

        // load today's attendance if exists
        $attendance = Attendance::where('class_id',$class->id)->where('date',$today)->get()->keyBy('student_id');

        return view('teacher.attendance', compact('class','students','attendance','today'));
    }

    public function store(Request $request, ClassRoom $class)
    {
        $data = $request->validate([
            'records' => 'required|array',
            'records.*.student_id' => 'required|exists:students,id',
            'records.*.status' => 'required|in:present,absent,late',
        ]);

        $date = $request->input('date', now()->toDateString());
        foreach ($data['records'] as $rec) {
            Attendance::updateOrCreate(
                [
                    'class_id' => $class->id,
                    'student_id' => $rec['student_id'],
                    'date' => $date
                ],
                [
                    'teacher_id' => auth()->user()->id,
                    'status' => $rec['status'],
                    'note' => $rec['note'] ?? null
                ]
            );
        }

        return redirect()->back()->with('success','Attendance saved.');
    }
}

