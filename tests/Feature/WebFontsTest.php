<?php

use Symfony\Component\Finder\Finder;

/*
 * The site's type is Geist (`--font-sans` / `--font-mono` in app.css and
 * design-tokens.css), served by Google Fonts. It used to be requested with an
 * `@import url(...)` in design-tokens.css. CSS only honours `@import` before
 * every other rule, and app.css imports that file after Tailwind, so once the
 * build inlines it the import sits after thousands of rules. The build dropped
 * it (with a warning nobody read) and every page fell back to the system font.
 * Remote stylesheets now load from a <link> in the Blade head, which no bundler
 * can reorder.
 */

test('the page head loads Geist from Google Fonts', function () {
    $response = $this->get('/');

    $response->assertSuccessful();
    $response->assertSee('<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>', false);
    $response->assertSee('href="https://fonts.googleapis.com/css2?family=Geist:wght@300;400;500;600;700&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet"', false);
});

test('no stylesheet imports a remote url that the build would drop', function () {
    $offenders = [];

    foreach (Finder::create()->files()->in(resource_path('css'))->name('*.css') as $file) {
        $css = preg_replace('#/\*.*?\*/#s', '', $file->getContents());

        if (preg_match('/@import\s+(?:url\(\s*)?["\']?(?:https?:)?\/\//i', $css)) {
            $offenders[] = $file->getRelativePathname();
        }
    }

    expect($offenders)->toBe([]);
});
