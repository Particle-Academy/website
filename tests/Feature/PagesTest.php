<?php

test('privacy policy page is accessible', function () {
    $response = $this->get('/privacy');

    $response->assertStatus(200);
    $response->assertSee('Privacy Policy');
});

test('terms of service page is accessible', function () {
    $response = $this->get('/terms');

    $response->assertStatus(200);
    $response->assertSee('Terms of Service');
});
