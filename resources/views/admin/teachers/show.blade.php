<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $teacher->name }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('admin.teachers.edit', $teacher) }}" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Edit</a>
                <a href="{{ route('admin.teachers.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-700">Back</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Teacher Info -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Teacher Information</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p><strong>Name:</strong> {{ $teacher->name }}</p>
                            <p><strong>Email:</strong> {{ $teacher->email }}</p>
                        </div>
                        <div>
                            <p><strong>Phone:</strong> {{ $teacher->phone ?? 'N/A' }}</p>
                            <p><strong>Joined:</strong> {{ $teacher->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Classes Assigned -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Assigned Classes</h3>
                    @if($teacher->classes->count())
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Class Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Students</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($teacher->classes as $class)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $class->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $class->students->count() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>No classes assigned yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
