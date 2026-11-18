<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $titles = [
            'Julieta Christie Munoz - finish database migration',
            'Isabel Seno - design the task list page',
            'Janina Charisse Torre - set up Breeze login',
            'Powerpuff Girlz - write the README',
        ];

        foreach ($titles as $title) {
            Task::create(['title' => $title, 'status' => 'pending']);
        }
    }
}