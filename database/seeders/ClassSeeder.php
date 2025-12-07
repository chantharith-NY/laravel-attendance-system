<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ClassRoom;
use App\Models\User;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teacher = User::where('role', 'teacher')->first();

        ClassRoom::create([
            'name' => 'Class 10A',
            'teacher_id' => $teacher ? $teacher->id : null,
        ]);

        ClassRoom::create([
            'name' => 'Class 10B',
            'teacher_id' => $teacher ? $teacher->id : null,
        ]);

        ClassRoom::create([
            'name' => 'Class 9A',
            'teacher_id' => null,
        ]);
    }
}
