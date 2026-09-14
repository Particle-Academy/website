<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Seeded Administrator
    |--------------------------------------------------------------------------
    |
    | The administrator account Database\Seeders\AdminUserSeeder creates. The
    | email and password deliberately have no defaults: a credential written
    | into this repository is a credential anyone can read. Seeding in
    | production fails until both are set; elsewhere an unset password is
    | replaced by a one-off random one that the seeder prints.
    |
    */

    'name' => env('ADMIN_NAME', 'Admin User'),

    'email' => env('ADMIN_EMAIL'),

    'password' => env('ADMIN_PASSWORD'),

];
