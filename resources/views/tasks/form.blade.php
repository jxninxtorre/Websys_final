@csrf

<div class="mb-4">
    <label class="block font-semibold mb-1">Title</label>
    <input type="text" name="title" value="{{ old('title', $task->title ?? '') }}"
           class="w-full border rounded p-2">
    @error('title') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<div class="mb-4">
    <label class="block font-semibold mb-1">Status</label>
    <select name="status" class="w-full border rounded p-2">
        @foreach (['pending', 'done'] as $s)
            <option value="{{ $s }}" @selected(old('status', $task->status ?? 'pending') === $s)>
                {{ ucfirst($s) }}
            </option>
        @endforeach
    </select>
    @error('status') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
</div>

<button class="bg-pink-600 text-white px-4 py-2 rounded">Save</button>
<a href="{{ route('tasks.index') }}" class="ml-3 text-gray-600">Cancel</a>