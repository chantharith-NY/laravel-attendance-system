<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $class->name }} - Take Attendance
            </h2>
            <a href="{{ route('teacher.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Back</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('teacher.attendance.store', $class) }}">
                        @csrf
                        <input type="hidden" name="date" value="{{ $today }}">

                        <div class="mb-4">
                            <h3 class="text-lg font-semibold mb-4">Date: {{ \Carbon\Carbon::parse($today)->format('M d, Y') }}</h3>
                        </div>

                        @if($students->count())
                            <table class="min-w-full divide-y divide-gray-200 mb-6">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roll Number</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Note</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($students as $student)
                                        @php
                                            $attendanceRecord = $attendance->get($student->id);
                                        @endphp
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->roll_number }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $student->user->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="hidden" name="records[{{ $loop->index }}][student_id]" value="{{ $student->id }}">
                                                <select name="records[{{ $loop->index }}][status]" class="px-3 py-2 border border-gray-300 rounded-md" required>
                                                    <option value="">-- Select --</option>
                                                    <option value="present" {{ $attendanceRecord && $attendanceRecord->status === 'present' ? 'selected' : '' }}>Present</option>
                                                    <option value="absent" {{ $attendanceRecord && $attendanceRecord->status === 'absent' ? 'selected' : '' }}>Absent</option>
                                                    <option value="late" {{ $attendanceRecord && $attendanceRecord->status === 'late' ? 'selected' : '' }}>Late</option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <input type="text" name="records[{{ $loop->index }}][note]" value="{{ $attendanceRecord ? $attendanceRecord->note : '' }}" placeholder="Optional note" class="px-3 py-2 border border-gray-300 rounded-md w-full">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save Attendance</button>
                            </div>
                        @else
                            <p>No students in this class.</p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
