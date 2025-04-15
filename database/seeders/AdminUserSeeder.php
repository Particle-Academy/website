<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an admin user
        \App\Models\User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@particle.academy',
            'password' => \Illuminate\Support\Facades\Hash::make('zippy1234'),
            'is_admin' => true,
        ]);
    }
}
