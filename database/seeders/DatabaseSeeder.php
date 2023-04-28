<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::create([
            'name' => 'John Doe',
            'email' => 'john_doe@dev.local',
            'password' => Hash::make('abcd1234')
        ]);
        User::create([
            'name' => 'Jane Doe',
            'email' => 'jane_doe@dev.local',
            'password' => Hash::make('abcd1234')
        ]);
        
        User::find(1)->todos()->createMany([
            ['task' => 'Clean the dishes'],
            ['task' => 'Check the car', 'detail' => 'Monthly maintenance'],
            ['task' => 'Sort the books', 'detail' => 'Sort the one in the basement.', 'status' => 'done'],
            ['task' => 'Do the taxes', 'due_date' => "2023-05-01", 'status' => 'in-progress'],
            ['task' => 'Change the lightbulb', 'detail' => 'the one in the attic', 'status' => 'done'],
        ]);

        User::find(2)->todos()->createMany([
            ['task' => 'Inform the neightbour', 'detail' => 'Ask to keep an eye on the house while we gone'],
            ['task' => 'Buy groceries' , 'status' => 'done'],
            ['task' => 'Fetch the kids', 'detail' => 'Daycare close at 5pm', 'status' => 'in-progress'],
            ['task' => 'Prepare for the family trip', 'detail' => 'Pack up some clothes', 'status' => 'done'],
            ['task' => 'Check when the plane ticket', 'due_date' => "2023-05-01", 'status' => 'done'],
        ]);
    }
}
