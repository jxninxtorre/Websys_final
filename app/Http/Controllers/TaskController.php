<?php

namespace App\Http\Controllers;

use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TaskController extends Controller
{
    public function welcome()
    {
        $tasks = Task::where('is_archived', false)
            ->whereDate('created_at', today())
            ->latest()->get();

        return view('welcome', compact('tasks'));
    }

    public function index()
    {
        $tasks = Task::where('is_archived', false)->latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:pending,done',
        ]);

        Task::create($data);

        return redirect()->route('tasks.index')->with('success', 'Task created.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'  => 'required|string|max:255',
            'status' => 'required|in:pending,done',
        ]);

        $wasDone = $task->status === 'done';

        $task->update($data);

        // send email only when status CHANGES to done (not if already done)
        if (! $wasDone && $task->status === 'done') {
            Mail::to(config('mail.task_recipient'))->send(new TaskCompleted($task));
        }

        return redirect()->route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(Task $task)
    {
        $task->update(['is_archived' => true]); // soft delete

        return redirect()->route('tasks.index')->with('success', 'Task archived.');
    }
}