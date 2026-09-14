<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    /**
     * Create the administrator from config/admin.php (ADMIN_EMAIL / ADMIN_PASSWORD).
     *
     * Never type a credential into this file: tests/Feature/AdminUserSeederTest.php
     * fails if a password literal comes back.
     *
     * @throws RuntimeException when seeding production without both credentials set.
     */
    public function run(): void
    {
        $email = config('admin.email');
        $password = config('admin.password');

        if (blank($email) || blank($password)) {
            if (app()->isProduction()) {
                throw new RuntimeException(
                    'Refusing to seed an administrator in production: set both ADMIN_EMAIL and ADMIN_PASSWORD. There is deliberately no default.'
                );
            }

            $email = filled($email) ? $email : 'admin@example.com';

            if (blank($password)) {
                $password = Str::password(24);

                $this->command?->warn("ADMIN_PASSWORD is not set, so {$email} was given a one-off random password: {$password}");
            }
        }

        User::factory()->create([
            'name' => config('admin.name'),
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);
    }
}
