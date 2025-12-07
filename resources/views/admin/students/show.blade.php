<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $student->user->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.students.edit', $student) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                <a href="{{ route('admin.students.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Student Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Student Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>Full Name:</strong> {{ $student->user->name }}</p>
                            <p><strong>Email:</strong> {{ $student->user->email }}</p>
                        </div>
                        <div>
                            <p><strong>Roll Number:</strong> {{ $student->roll_number }}</p>
                            <p><strong>Gender:</strong> {{ ucfirst($student->gender) ?? 'N/A' }}</p>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p><strong>Date of Birth:</strong> {{ $student->dob ? $student->dob->format('M d, Y') : 'N/A' }}</p>
                        <p><strong>Class:</strong> {{ $student->class ? $student->class->name : 'Unassigned' }}</p>
                    </div>
                </div>
            </div>

            <!-- Attendance History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Recent Attendance (Last 30 Days)</h3>
                    @if($student->attendance->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($student->attendance->take(30) as $attendance)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $attendance->date->format('M d, Y') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $attendance->class->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 rounded text-white {{ $attendance->status === 'present' ? 'bg-green-600' : ($attendance->status === 'absent' ? 'bg-red-600' : 'bg-yellow-600') }}">
                                                {{ ucfirst($attendance->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No attendance records found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
