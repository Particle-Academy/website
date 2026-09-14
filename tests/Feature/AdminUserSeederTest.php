<?php

use App\Models\User;
use Database\Seeders\AdminUserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Finder\Finder;

/*
 * AdminUserSeeder used to create the administrator with an email and password
 * typed into the file, in a public repository. Anyone who read it could sign in
 * to any deployment that had been seeded. The credentials now come from
 * config/admin.php (ADMIN_EMAIL / ADMIN_PASSWORD) with no usable default.
 */

uses(RefreshDatabase::class);

test('the administrator is created from the configured credentials', function () {
    config([
        'admin.name' => 'Site Owner',
        'admin.email' => 'owner@example.com',
        'admin.password' => 'a-configured-secret-value',
    ]);

    app(AdminUserSeeder::class)->run();

    $admin = User::query()->where('email', 'owner@example.com')->sole();

    expect($admin->is_admin)->toBeTrue()
        ->and($admin->name)->toBe('Site Owner')
        ->and(Hash::check('a-configured-secret-value', $admin->password))->toBeTrue();
});

test('seeding production without credentials fails and creates no one', function (?string $email, ?string $password) {
    app()->instance('env', 'production');
    config(['admin.email' => $email, 'admin.password' => $password]);

    expect(fn () => app(AdminUserSeeder::class)->run())
        ->toThrow(RuntimeException::class, 'ADMIN_PASSWORD');

    expect(User::query()->count())->toBe(0);
})->with([
    'neither set' => [null, null],
    'email only' => ['owner@example.com', null],
    'password only' => [null, 'a-configured-secret-value'],
    'set but empty' => ['', ''],
]);

test('outside production an unset password becomes a one-off random one, never a fixed one', function () {
    config(['admin.email' => null, 'admin.password' => null]);

    $this->artisan('db:seed', ['--class' => AdminUserSeeder::class])
        ->expectsOutputToContain('ADMIN_PASSWORD is not set')
        ->assertSuccessful();

    $first = User::query()->where('is_admin', true)->sole();

    User::query()->delete();
    $this->artisan('db:seed', ['--class' => AdminUserSeeder::class])->assertSuccessful();
    $second = User::query()->where('is_admin', true)->sole();

    expect($first->email)->toBe('admin@example.com')
        ->and(Hash::check('', $first->password))->toBeFalse()
        ->and(Hash::check('password', $first->password))->toBeFalse()
        // Two runs, two different passwords: nothing about it is guessable from the source.
        ->and($first->password)->not->toBe($second->password);
});

test('no seeder hashes or assigns a password written into the source', function () {
    $offenders = [];

    foreach (Finder::create()->files()->in(database_path('seeders'))->name('*.php') as $file) {
        $tokens = array_values(array_filter(
            PhpToken::tokenize($file->getContents()),
            fn (PhpToken $token): bool => ! $token->isIgnorable(),
        ));

        foreach ($tokens as $i => $token) {
            $next = fn (int $offset): ?PhpToken => $tokens[$i + $offset] ?? null;
            $isLiteral = fn (?PhpToken $t): bool => $t?->is(T_CONSTANT_ENCAPSED_STRING) ?? false;

            // 'password' => '...'
            $assignsLiteral = $isLiteral($token)
                && stripos(trim($token->text, '\'"'), 'password') !== false
                && $next(1)?->is(T_DOUBLE_ARROW)
                && $isLiteral($next(2));

            // Hash::make('...'), bcrypt('...'), password_hash('...')
            $hashesLiteral = $token->is(T_STRING)
                && (
                    // Hash, \Hash and Illuminate\Support\Facades\Hash alike.
                    (strcasecmp($token->text, 'make') === 0 && class_basename($tokens[$i - 2]->text ?? '') === 'Hash')
                    || in_array(strtolower($token->text), ['bcrypt', 'password_hash'], true)
                )
                && $next(1)?->text === '('
                && $isLiteral($next(2));

            if ($assignsLiteral || $hashesLiteral) {
                $offenders[] = $file->getRelativePathname().':'.$token->line;
            }
        }
    }

    expect($offenders)->toBe([]);
});
