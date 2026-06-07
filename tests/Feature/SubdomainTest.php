<?php

test('main domain home page is accessible', function () {
    $response = $this->get(config('app.url'));

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Home'));
});

test('tribe-trip microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $response = $this->get($scheme.'://tribe-trip.'.$host);

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Microsites/TribeTrip'));
});

test('laravel-fun-labs microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $response = $this->get($scheme.'://laravel-fun-labs.'.$host);

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Microsites/LaravelFunLabs'));
});

test('laravel-catalog microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $response = $this->get($scheme.'://laravel-catalog.'.$host);

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Microsites/LaravelCatalog'));
});

test('invalid microsite returns 404', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $url = $scheme.'://invalid-site.'.$host;

    $response = $this->get($url);

    $response->assertStatus(404);
});
