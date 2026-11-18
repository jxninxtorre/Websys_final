@extends('layouts.site')
@section('title', 'Task List')

@section('content')
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Task List</h1>
        @auth
            <a href="{{ route('tasks.create') }}" class="bg-pink-600 text-white px-4 py-2 rounded">+ New Task</a>
        @endauth
    </div>

    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-pink-100">
                <tr>
                    <th class="p-3">Title</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Created</th>
                    @auth <th class="p-3">Actions</th> @endauth
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr class="border-t">
                        <td class="p-3">{{ $task->title }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded text-xs {{ $task->status === 'done' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="p-3 text-sm">{{ $task->created_at->format('M d, Y') }}</td>
                        @auth
                            <td class="p-3 flex gap-3">
                                <a href="{{ route('tasks.edit', $task) }}" class="text-blue-600 hover:underline">Edit</a>
                                <form method="POST" action="{{ route('tasks.destroy', $task) }}"
                                      onsubmit="return confirm('Archive this task?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Archive</button>
                                </form>
                            </td>
                        @endauth
                    </tr>
                @empty
                    <tr><td colspan="4" class="p-3 text-gray-500">No tasks yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection