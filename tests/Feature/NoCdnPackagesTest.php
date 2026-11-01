<?php

use Symfony\Component\Finder\Finder;

/*
 * Code the site runs comes through npm, where the lockfile pins it and the
 * third-party allowlist and the audits can see it. A <script> or stylesheet
 * hot-linked from a package CDN bypasses all three: AOS 2.3.4 was loaded from
 * unpkg in the page head for months after the last `data-aos` attribute had
 * been deleted, and nothing in CI could have noticed.
 *
 * Google's font hosts are on the list for the same reason: Geist is
 * self-hosted from public/fonts/geist (see WebFontsTest). The production-only
 * analytics tag is a separate product decision, and this test does not
 * pretend to have settled it.
 */

const PACKAGE_CDN_HOSTS = [
    'unpkg.com',
    'cdn.jsdelivr.net',
    'cdnjs.cloudflare.com',
    'esm.sh',
    'cdn.skypack.dev',
    'ga.jspm.io',
    'fonts.googleapis.com',
    'fonts.gstatic.com',
];

/**
 * Every Blade view, keyed by its relative path.
 *
 * @return array<string, string>
 */
function bladeViews(): array
{
    $views = [];

    foreach (Finder::create()->files()->in(resource_path('views'))->name('*.blade.php') as $file) {
        $views[str_replace('\\', '/', $file->getRelativePathname())] = $file->getContents();
    }

    return $views;
}

test('the scan actually reads the root template', function () {
    expect(bladeViews())->toHaveKey('app.blade.php');
});

test('no view loads a script or stylesheet from a package CDN', function () {
    $offenders = [];

    foreach (bladeViews() as $path => $source) {
        foreach (PACKAGE_CDN_HOSTS as $host) {
            if (str_contains($source, $host)) {
                $offenders[] = "{$path}: {$host}";
            }
        }
    }

    expect($offenders)->toBe([]);
});

test('the rendered page head references no package CDN', function () {
    $html = $this->get('/')->assertSuccessful()->getContent();

    foreach (PACKAGE_CDN_HOSTS as $host) {
        expect($html)->not->toContain($host);
    }
});
