@extends('layouts.site')
@section('title', 'Create Task')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Create Task</h1>
    <form method="POST" action="{{ route('tasks.store') }}" class="bg-white p-6 rounded shadow">
        @include('tasks._form')
    </form>
@endsection