<?php

use Symfony\Component\Finder\Finder;

/*
 * Icons render through react-fancy's <Icon name="...">, which resolves the
 * approved Lucide set itself. `lucide-react` is react-fancy's dependency, not
 * this site's: it is not in package.json, so a direct import only resolved
 * because npm happened to hoist it, and it would break (or silently change
 * version) the day react-fancy moves it. PHP cannot render the React tree, so
 * this asserts the source contract instead.
 */

/**
 * Every TS/TSX source file under resources/js, keyed by its relative path.
 *
 * @return array<string, string>
 */
function iconSourceFiles(): array
{
    $files = [];

    foreach (Finder::create()->files()->in(resource_path('js'))->name(['*.ts', '*.tsx']) as $file) {
        $files[str_replace('\\', '/', $file->getRelativePathname())] = $file->getContents();
    }

    return $files;
}

test('the scan actually reads the React sources', function () {
    expect(iconSourceFiles())->toHaveKey('app.tsx');
});

test('no source imports lucide-react directly', function () {
    $offenders = [];

    foreach (iconSourceFiles() as $path => $source) {
        if (preg_match('/(?:from|import|require\()\s*["\']lucide-react(?:\/[^"\']*)?["\']/', $source)) {
            $offenders[] = $path;
        }
    }

    expect($offenders)->toBe([]);
});

test('lucide-react is not declared as a site dependency', function () {
    $manifest = json_decode(file_get_contents(base_path('package.json')), true, flags: JSON_THROW_ON_ERROR);

    expect($manifest['dependencies'] ?? [])->not->toHaveKey('lucide-react')
        ->and($manifest['devDependencies'] ?? [])->not->toHaveKey('lucide-react');
});
