@extends('layouts.site')
@section('title', 'Welcome')

@section('content')
    <h1 class="text-3xl font-bold mb-2">Welcome to Tasks for Today</h1>
    <p class="mb-6">Here are the tasks added today.</p>

    @forelse ($tasks as $task)
        <div class="bg-white p-3 rounded shadow mb-2 flex justify-between">
            <span>{{ $task->title }}</span>
            <span class="text-sm">{{ ucfirst($task->status) }}</span>
        </div>
    @empty
        <p class="text-gray-500">No tasks for today.</p>
    @endforelse
@endsection