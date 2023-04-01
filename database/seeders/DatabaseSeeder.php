<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Todo;
use App\Models\Todolist;
use App\Models\User;
use App\Models\TimelineItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // php artisan migrate:refresh --seed
        User::factory(10)->create();
        // create new user
        User::factory()->create([
            'name' => 'Jules Singer',
            'email' => 'singerjules.perso@gmail.com',
            'password' => '$2y$10$JqnFEPp4t.un1AMbWykDkeK.gkzhUAyW29y1XvWs.DOmdvjAgb9/W',
        ]);

        TimelineItem::factory(20)->create();
        Todolist::factory(10)->create();
        Todolist::factory(10)->create([
            'user_id' => 11,
            'name' => 'Todolist de Jules',
            'description' => 'Todolist de Jules',
        ]);
        Todo::factory(50)->create();

        
    }
}
