@extends('layouts.site')
@section('title', 'Edit Task')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Edit Task</h1>
    <form method="POST" action="{{ route('tasks.update', $task) }}" class="bg-white p-6 rounded shadow">
        @method('PUT')
        @include('tasks._form')
    </form>
@endsection