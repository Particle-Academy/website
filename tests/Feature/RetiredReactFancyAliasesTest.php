<?php

use Symfony\Component\Finder\Finder;

/*
 * react-fancy renamed `Action` to `Button` (and `ActionColor` / `ActionProps`
 * to `ButtonColor` / `ButtonProps`). The old names survive only as deprecated
 * aliases that a future major removes, so a page still using them builds today
 * and breaks on that upgrade. PHP cannot render the React tree, so this asserts
 * the source contract instead: no TS/TSX file under resources/js imports a
 * retired alias from react-fancy or renders an `<Action>` element.
 */

const RETIRED_REACT_FANCY_ALIASES = ['Action', 'ActionColor', 'ActionProps'];

/**
 * Every TS/TSX source file under resources/js, keyed by its relative path.
 *
 * @return array<string, string>
 */
function reactSourceFiles(): array
{
    $files = [];

    foreach (Finder::create()->files()->in(resource_path('js'))->name(['*.ts', '*.tsx']) as $file) {
        $files[str_replace('\\', '/', $file->getRelativePathname())] = $file->getContents();
    }

    return $files;
}

test('the scan actually reads the React sources', function () {
    expect(reactSourceFiles())->toHaveKey('app.tsx');
});

test('no source imports a retired react-fancy alias', function () {
    $offenders = [];

    foreach (reactSourceFiles() as $path => $source) {
        preg_match_all(
            '/import\s+(?:type\s+)?\{([^}]*)\}\s*from\s*["\']@particle-academy\/react-fancy["\']/',
            $source,
            $imports,
        );

        foreach ($imports[1] as $clause) {
            foreach (explode(',', $clause) as $specifier) {
                // `Action as Foo` and `type ActionColor` both import the alias.
                $imported = preg_replace('/^type\s+/', '', trim(explode(' as ', trim($specifier))[0]));

                if (in_array($imported, RETIRED_REACT_FANCY_ALIASES, true)) {
                    $offenders[] = "{$path}: {$imported}";
                }
            }
        }
    }

    expect($offenders)->toBe([]);
});

test('no source renders an <Action> element', function () {
    $offenders = [];

    foreach (reactSourceFiles() as $path => $source) {
        if (preg_match_all('/<Action[\s>\/]/', $source, $matches)) {
            $offenders[] = "{$path}: ".count($matches[0]);
        }
    }

    expect($offenders)->toBe([]);
});
