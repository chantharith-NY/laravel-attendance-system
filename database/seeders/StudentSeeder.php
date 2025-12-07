<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $class = \App\Models\ClassRoom::first();

        for ($i = 1; $i <= 10; $i++) {
            $user = User::create([
                'name' => "Student $i",
                'email' => "student$i@example.com",
                'password' => Hash::make('password'),
                'role' => 'student',
            ]);

            Student::create([
                'user_id' => $user->id,
                'class_id' => $class ? $class->id : null,
                'roll_number' => "STU00$i",
                'gender' => $i % 2 === 0 ? 'male' : 'female',
                'dob' => now()->subYears(15)->addDays($i * 10),
            ]);
        }
    }
}
