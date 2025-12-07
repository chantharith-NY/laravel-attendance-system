<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Teacher Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Classes</div>
                        <div class="text-3xl font-bold text-blue-600 mt-2">{{ $totalClasses }}</div>
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <div class="text-gray-500 text-sm font-medium uppercase tracking-wide">Total Students</div>
                        <div class="text-3xl font-bold text-green-600 mt-2">{{ $totalStudents }}</div>
                    </div>
                </div>
            </div>

            <!-- My Classes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">My Classes</h3>
                    @if($classes->count())
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($classes as $class)
                                <div class="border border-gray-300 rounded p-4">
                                    <h4 class="font-semibold text-lg mb-2">{{ $class->name }}</h4>
                                    <p class="text-gray-600 mb-3">Students: {{ $class->students->count() }}</p>
                                    <a href="{{ route('teacher.attendance.show', $class) }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                                        Take Attendance
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p>No classes assigned yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
