<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Message -->
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h2 class="text-3xl font-bold mb-2">Welcome, {{ Auth::user()->name }}!</h2>
                    <p>You're logged in as <strong>{{ ucfirst(Auth::user()->role) }}</strong></p>
                </div>
            </div>

            @if(Auth::user()->isAdmin())
                <!-- Admin Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-6">Admin Panel</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <a href="{{ route('admin.teachers.index') }}" class="p-4 border border-gray-300 rounded hover:shadow-lg transition">
                                <div class="text-2xl font-bold text-blue-600 mb-2">👨‍🏫</div>
                                <h4 class="font-semibold mb-1">Manage Teachers</h4>
                                <p class="text-sm text-gray-600">Add, edit, or remove teachers</p>
                            </a>
                            <a href="{{ route('admin.students.index') }}" class="p-4 border border-gray-300 rounded hover:shadow-lg transition">
                                <div class="text-2xl font-bold text-green-600 mb-2">👨‍🎓</div>
                                <h4 class="font-semibold mb-1">Manage Students</h4>
                                <p class="text-sm text-gray-600">Add, edit, or remove students</p>
                            </a>
                            <a href="{{ route('admin.classes.index') }}" class="p-4 border border-gray-300 rounded hover:shadow-lg transition">
                                <div class="text-2xl font-bold text-purple-600 mb-2">🏫</div>
                                <h4 class="font-semibold mb-1">Manage Classes</h4>
                                <p class="text-sm text-gray-600">Create or manage classes</p>
                            </a>
                        </div>
                    </div>
                </div>

            @elseif(Auth::user()->isTeacher())
                <!-- Teacher Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-6">Your Classes & Attendance</h3>
                        <div class="text-center py-8">
                            <p class="text-gray-600 mb-4">Go to "My Classes" in the navigation menu to take attendance</p>
                            <a href="{{ route('teacher.dashboard') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded hover:bg-blue-700">
                                View My Classes
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <!-- Student Dashboard -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold mb-4">Your Class</h3>
                        <p class="text-gray-600">You are registered as a student. Check your attendance and class information with your teacher.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
