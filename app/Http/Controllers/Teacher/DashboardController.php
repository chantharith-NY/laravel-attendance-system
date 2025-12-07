<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassRoom;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $teacher = auth()->user();
        $classes = $teacher->classes()->with('students')->get();
        $totalClasses = $classes->count();
        $totalStudents = $classes->sum(function ($class) {
            return $class->students->count();
        });

        return view('teacher.dashboard', compact('classes', 'totalClasses', 'totalStudents'));
    }
}
