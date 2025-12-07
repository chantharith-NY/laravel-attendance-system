<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->isAdmin()) {
            return view('dashboards.admin');
        } elseif ($user->isTeacher()) {
            return view('dashboards.teacher');
        } else {
            return view('dashboards.student');
        }
    }
}
