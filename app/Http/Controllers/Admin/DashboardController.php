<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use App\Models\Student;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalStudents = Student::count();
        $totalClasses = ClassRoom::count();
        $totalAttendanceToday = Attendance::whereDate('date', Carbon::today())->count();

        return view('admin.dashboard', compact(
            'totalTeachers',
            'totalStudents',
            'totalClasses',
            'totalAttendanceToday'
        ));
    }
}
