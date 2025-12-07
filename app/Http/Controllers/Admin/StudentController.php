<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with('user', 'class')->paginate(15);
        return view('admin.students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassRoom::all();
        return view('admin.students.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roll_number' => 'required|string|unique:students,roll_number',
            'class_id' => 'required|exists:classes,id',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
        ]);

        // Create user account
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'student',
        ]);

        // Create student record
        Student::create([
            'user_id' => $user->id,
            'class_id' => $validated['class_id'],
            'roll_number' => $validated['roll_number'],
            'gender' => $validated['gender'] ?? null,
            'dob' => $validated['dob'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $student = Student::with('user', 'class', 'attendance')->findOrFail($id);
        return view('admin.students.show', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $student = Student::with('user')->findOrFail($id);
        $classes = ClassRoom::all();
        return view('admin.students.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $student = Student::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'roll_number' => 'required|string|unique:students,roll_number,' . $id,
            'class_id' => 'required|exists:classes,id',
            'gender' => 'nullable|in:male,female,other',
            'dob' => 'nullable|date',
        ]);

        // Update user
        $student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        // Update student
        $student->update([
            'class_id' => $validated['class_id'],
            'roll_number' => $validated['roll_number'],
            'gender' => $validated['gender'] ?? null,
            'dob' => $validated['dob'] ?? null,
        ]);

        return redirect()->route('admin.students.index')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = Student::findOrFail($id);
        $userId = $student->user_id;
        
        $student->delete();
        User::findOrFail($userId)->delete();

        return redirect()->route('admin.students.index')->with('success', 'Student deleted successfully.');
    }
}
