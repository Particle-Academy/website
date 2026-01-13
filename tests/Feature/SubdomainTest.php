<?php

test('main domain home page contains links to microsites', function () {
    $response = $this->get(config('app.url'));

    $response->assertStatus(200);
    $response->assertSee('Explore Particle Academy Projects');
    $response->assertSee('Tribe Trip');
    $response->assertSee('Laravel Fun Lab');
    $response->assertSee('Laravel Catalog');

    // Check for updated descriptions
    $response->assertSee('Smart resource sharing app');
    $response->assertSee('Analytics disguised as gamification');
    $response->assertSee('Product and Subscription management');

    // Check for links (simplified check)
    // We expect links to contain the subdomains
    $response->assertSee('tribe-trip.');
    $response->assertSee('laravel-fun-labs.');
    $response->assertSee('laravel-catalog.');
});

test('valid microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    // Use a valid microsite from the controller
    $url = $scheme.'://tribe-trip.'.$host;

    $response = $this->get($url);

    $response->assertStatus(200);
    $response->assertSee('Share Smarter.');
    $response->assertSee('Live Better.');
    // $response->assertSee('Subdomain: tribe-trip'); // Removed as it's not in the specific layout/view anymore
});

test('laravel-fun-labs microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $url = $scheme.'://laravel-fun-labs.'.$host;

    $response = $this->get($url);

    $response->assertStatus(200);
    $response->assertSee('Analytics disguised as gamification.');
    $response->assertSee('Flexible Awards');
});

test('laravel-catalog microsite is accessible', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $url = $scheme.'://laravel-catalog.'.$host;

    $response = $this->get($url);

    $response->assertStatus(200);
    $response->assertSee('Laravel Catalog');
    $response->assertSee('Manage your Stripe catalog');
});

test('invalid microsite returns 404', function () {
    $host = parse_url(config('app.url'), PHP_URL_HOST);
    $scheme = parse_url(config('app.url'), PHP_URL_SCHEME) ?? 'http';

    $url = $scheme.'://invalid-site.'.$host;

    $response = $this->get($url);

    $response->assertStatus(404);
});
