<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test Admin',
            'email' => 'admin@example.com',
            'password'  => Hash::make('123456789')
        ]);

        User::factory()->customer()->create([
            'name' => 'Test Customer',
            'email' => 'customer@example.com',
            'password'  => Hash::make('123456789')
        ]);
    }
}
