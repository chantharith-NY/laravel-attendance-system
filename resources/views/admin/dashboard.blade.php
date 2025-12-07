<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <!-- Total Teachers -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Teachers</div>
                        <div class="text-3xl font-bold text-blue-600 mt-2">{{ $totalTeachers }}</div>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Students</div>
                        <div class="text-3xl font-bold text-green-600 mt-2">{{ $totalStudents }}</div>
                    </div>
                </div>

                <!-- Total Classes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Classes</div>
                        <div class="text-3xl font-bold text-purple-600 mt-2">{{ $totalClasses }}</div>
                    </div>
                </div>

                <!-- Attendance Today -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Attendance Today</div>
                        <div class="text-3xl font-bold text-orange-600 mt-2">{{ $totalAttendanceToday }}</div>
                    </div>
                </div>
            </div>

            <!-- Management Links -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('admin.teachers.index') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            Manage Teachers
                        </a>
                        <a href="{{ route('admin.students.index') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                            Manage Students
                        </a>
                        <a href="{{ route('admin.classes.index') }}" class="inline-block px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700">
                            Manage Classes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
