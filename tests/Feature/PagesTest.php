<?php

test('privacy policy page is accessible', function () {
    $response = $this->get('/privacy');

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Privacy'));
});

test('terms of service page is accessible', function () {
    $response = $this->get('/terms');

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page->component('Terms'));
});
