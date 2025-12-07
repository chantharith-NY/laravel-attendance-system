<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $class->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.classes.edit', $class) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                <a href="{{ route('admin.classes.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Class Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Class Information</h3>
                    <p><strong>Class Name:</strong> {{ $class->name }}</p>
                    <p><strong>Teacher:</strong> {{ $class->teacher ? $class->teacher->name : 'Unassigned' }}</p>
                    <p><strong>Total Students:</strong> {{ $class->students->count() }}</p>
                </div>
            </div>

            <!-- Students in Class -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Students in This Class</h3>
                    @if($class->students->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll Number</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($class->students as $student)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->roll_number }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $student->user->email }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No students in this class.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
