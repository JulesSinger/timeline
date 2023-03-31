<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Todo;
use App\Models\Todolist;
use App\Models\User;
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
        Todolist::factory(10)->create();
        Todo::factory(50)->create();
    }
}
