<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('makes distinct users', function () {
    $users = User::factory()->count(50)->create();

    expect($users->pluck('email')->unique())->toHaveCount(50)
        ->and($users->every(fn (User $user) => $user->name !== ''))->toBeTrue();
});
