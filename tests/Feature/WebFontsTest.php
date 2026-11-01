<?php

use Symfony\Component\Finder\Finder;

/*
 * The site's type is Geist (`--font-sans` / `--font-mono` in app.css and
 * design-tokens.css). It is self-hosted: the variable woff2 files from the
 * upstream release live in public/fonts/geist with their licence and a NOTICE
 * recording where they came from, and design-tokens.css declares them with
 * @font-face. Nothing is requested from Google's font hosts, which no lockfile,
 * allowlist or audit can see.
 *
 * History worth keeping: Geist was once requested with an `@import url(...)`
 * in design-tokens.css. CSS only honours `@import` before every other rule, and
 * app.css imports that file after Tailwind, so the build dropped it (with a
 * warning nobody read) and every page fell back to the system font. @font-face
 * has no such ordering rule, which is part of why it is the right tool here.
 */

const GEIST_FILES = ['Geist-Variable.woff2', 'GeistMono-Variable.woff2'];

/**
 * Every stylesheet under resources/css with its comments stripped, keyed by
 * relative path.
 *
 * @return array<string, string>
 */
function siteStylesheets(): array
{
    $sheets = [];

    foreach (Finder::create()->files()->in(resource_path('css'))->name('*.css') as $file) {
        $sheets[str_replace('\\', '/', $file->getRelativePathname())] = preg_replace('#/\*.*?\*/#s', '', $file->getContents());
    }

    return $sheets;
}

test('the font files ship with the site, with their licence and provenance', function () {
    foreach ([...GEIST_FILES, 'OFL.txt', 'NOTICE.md'] as $file) {
        expect(public_path("fonts/geist/{$file}"))->toBeFile();
    }

    foreach (GEIST_FILES as $file) {
        // A woff2 file starts with the signature "wOF2"; an HTML error page saved
        // under the right name would not.
        expect(substr(file_get_contents(public_path("fonts/geist/{$file}")), 0, 4))->toBe('wOF2');
    }
});

test('both families are declared with a same-origin @font-face', function () {
    $css = implode("\n", siteStylesheets());

    preg_match_all('/@font-face\s*\{([^}]*)\}/', $css, $faces);

    $declared = [];

    foreach ($faces[1] as $body) {
        preg_match('/font-family:\s*["\']([^"\']+)["\']/', $body, $family);
        preg_match('/url\(\s*["\']?([^"\')]+)/', $body, $url);

        expect($body)->toContain('font-display: swap');
        expect($url[1] ?? '')->toStartWith('/fonts/geist/');

        $declared[$family[1] ?? ''] = basename($url[1]);
    }

    expect($declared)->toBe([
        'Geist' => 'Geist-Variable.woff2',
        'Geist Mono' => 'GeistMono-Variable.woff2',
    ]);
});

test('the page head preloads the body face from this origin', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertSee('<link rel="preload" href="/fonts/geist/Geist-Variable.woff2" as="font" type="font/woff2" crossorigin>', false);
});

test('nothing requests a Google font host', function () {
    $hosts = ['fonts.googleapis.com', 'fonts.gstatic.com'];
    $html = $this->get('/')->assertSuccessful()->getContent();

    foreach ($hosts as $host) {
        expect($html)->not->toContain($host);

        foreach (siteStylesheets() as $path => $css) {
            expect($css)->not->toContain($host, "{$path} references {$host}");
        }
    }
});

test('no stylesheet imports a remote url that the build would drop', function () {
    $offenders = [];

    foreach (siteStylesheets() as $path => $css) {
        if (preg_match('/@import\s+(?:url\(\s*)?["\']?(?:https?:)?\/\//i', $css)) {
            $offenders[] = $path;
        }
    }

    expect($offenders)->toBe([]);
});
