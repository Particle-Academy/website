<?php

use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

/*
 * The site serves one host and has no subdomains (owner, 2026-11-01). It used
 * to register a `{subdomain}.<host>` route group that mapped tribe-trip,
 * laravel-fun-labs and laravel-catalog to microsite pages, and it pinned every
 * other route to the exact app host. A route with a domain constraint is how
 * either comes back, so none may exist.
 *
 * Old subdomain URLs are redirected at DNS / Forge, outside this repository.
 */

test('the route table is not empty, so the domain check below checks something', function () {
    expect(count(Route::getRoutes()->getRoutes()))->toBeGreaterThan(5);
});

test('no route is registered with a domain constraint', function () {
    $constrained = collect(Route::getRoutes()->getRoutes())
        ->filter(fn ($route) => $route->getDomain() !== null)
        ->map(fn ($route) => $route->getDomain().' '.$route->uri())
        ->values()
        ->all();

    expect($constrained)->toBe([]);
});

test('the home page is served on the app url', function () {
    $this->get(config('app.url'))
        ->assertSuccessful()
        ->assertInertia(fn ($page) => $page->component('Home'));
});

test('a former microsite host no longer renders a microsite', function (string $subdomain) {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $this->get($scheme.'://'.$subdomain.'.'.$host.'/')
        ->assertSuccessful()
        ->assertInertia(fn ($page) => $page->component('Home'));
})->with(['tribe-trip', 'laravel-fun-labs', 'laravel-catalog']);

test('no route renders a microsite page', function () {
    expect(file_get_contents(base_path('routes/web.php')))->not->toContain('Microsites/');
});

test('the per-package Fancy microsites are gone', function (string $page) {
    expect(resource_path("js/Pages/Microsites/{$page}.tsx"))->not->toBeFile();
})->with(['LaravelCatalog', 'LaravelFunLabs']);

/**
 * Every file that can put a URL in front of a visitor: pages, layouts, views,
 * PHP that feeds them props, config and the static files under public/.
 *
 * @return array<string, string>
 */
function subdomainScanFiles(): array
{
    $files = [];

    $finder = Finder::create()->files()
        ->in([resource_path('js'), resource_path('views'), app_path(), config_path(), base_path('routes')])
        ->name(['*.tsx', '*.ts', '*.php']);

    foreach ($finder as $file) {
        $files[str_replace('\\', '/', $file->getRealPath())] = $file->getContents();
    }

    foreach (Finder::create()->files()->in(public_path())->depth(0)->name(['*.txt', '*.xml', '*.html']) as $file) {
        $files[str_replace('\\', '/', $file->getRealPath())] = $file->getContents();
    }

    return $files;
}

/**
 * The separate apps this site may link to. They are their own sites, not
 * subdomains of this one: the Fancy kit's showcase, and Prism's site (owner,
 * 2026-11-01: "we still have the fancy and prism sites").
 */
const SEPARATE_APP_HOSTS = ['ui.particle.academy', 'ai.particle.academy'];

/**
 * Hosts under particle.academy found in a string, other than the apex and the
 * separate apps in SEPARATE_APP_HOSTS.
 *
 * @return list<string>
 */
function foreignParticleSubdomains(string $source): array
{
    preg_match_all('~(?<![\w.-])((?:[a-z0-9-]+\.)+)particle\.academy\b~i', $source, $matches);

    return array_values(array_filter(
        array_map(fn (string $sub) => strtolower($sub).'particle.academy', $matches[1]),
        fn (string $host) => ! in_array($host, SEPARATE_APP_HOSTS, true),
    ));
}

test('the subdomain matcher catches a subdomain and ignores the apex, mail, the kit showcase and Prism', function () {
    expect(foreignParticleSubdomains('<a href="https://tribe-trip.particle.academy/">'))->toBe(['tribe-trip.particle.academy'])
        ->and(foreignParticleSubdomains('https://ui.particle.academy/mcp'))->toBe([])
        ->and(foreignParticleSubdomains('https://ai.particle.academy'))->toBe([])
        ->and(foreignParticleSubdomains('mailto:info@particle.academy https://particle.academy'))->toBe([]);
});

test('the link scan reads the pages it is meant to guard', function () {
    expect(array_keys(subdomainScanFiles()))->toContain(str_replace('\\', '/', realpath(resource_path('js/Pages/Home.tsx'))));
});

test('no source links to a particle.academy subdomain other than the separate apps', function () {
    $offenders = [];

    foreach (subdomainScanFiles() as $path => $source) {
        foreach (foreignParticleSubdomains($source) as $host) {
            $offenders[] = "{$path}: {$host}";
        }
    }

    expect($offenders)->toBe([]);
});

test('no rendered page links to a particle.academy subdomain other than the separate apps', function (string $uri) {
    $html = $this->get($uri)->assertSuccessful()->getContent();

    expect(foreignParticleSubdomains(html_entity_decode($html)))->toBe([]);
})->with(['/', '/coaches', '/partners', '/sponsors', '/privacy', '/terms', '/login']);
