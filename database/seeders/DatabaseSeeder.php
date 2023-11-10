<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory()->createMany([
            [
                'name' => 'User',
                'email' => 'user@todo-list.test',
                'password' => bcrypt('12345678'),
            ],
            [
                'name' => 'other',
                'email' => 'other@todo-list.test',
                'password' => bcrypt('12345678'),
            ]
        ]);

        \App\Models\Todo::factory(4)->createMany([
            [
                'user_id' => 1,
            ],
            [
                'user_id' => 2,
            ]
        ]);
    }
}
