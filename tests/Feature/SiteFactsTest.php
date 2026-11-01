<?php

/*
 * Owner rulings on PR #4, 2026-11-01.
 *
 * - The Organization JSON-LD said the academy's phone was +1-123-456-7890 and
 *   listed three social profiles. The number was a placeholder, and none of
 *   the profiles could be shown to be the academy's: x.com/particleacademy is a
 *   404, facebook.com/particleacademy answers 400, and instagram.com answers a
 *   made-up username with the same page it gives this one. A search engine
 *   reads those as facts about the organisation, so they go rather than stay
 *   as guesses.
 * - The home page stat said "7 Skills tracks" over a list of six. The number
 *   is now the list's length.
 * - TribeTrip was dropped; the `appUrl` shared prop existed only for the
 *   microsites.
 */

/**
 * The Organization JSON-LD block the root template prints on every page.
 *
 * @return array<string, mixed>
 */
function organizationJsonLd(string $html): array
{
    preg_match('~<script type="application/ld\+json">(.*?)</script>~s', $html, $m);

    return json_decode($m[1] ?? 'null', true) ?? [];
}

test('the structured data parses as an Organization', function () {
    $data = organizationJsonLd($this->get('/')->assertSuccessful()->getContent());

    expect($data['@type'] ?? null)->toBe('Organization')
        ->and($data['contactPoint']['email'] ?? null)->toBe('info@particle.academy');
});

test('the structured data has no placeholder phone number and no unverified profiles', function () {
    $data = organizationJsonLd($this->get('/')->getContent());

    expect($data['contactPoint'])->not->toHaveKey('telephone')
        ->and($data)->not->toHaveKey('sameAs')
        ->and(file_get_contents(resource_path('views/app.blade.php')))->not->toContain('123-456-7890');
});

test('the skills-track stat is the length of the list it counts', function () {
    $home = file_get_contents(resource_path('js/Pages/Home.tsx'));

    preg_match('~<div className="v">([^<]*)</div>\s*<div className="l">Skills tracks</div>~', $home, $m);

    expect($m[1] ?? null)->toBe('{PILLARS.length}');
});

test('TribeTrip and the microsites directory are gone', function () {
    expect(resource_path('js/Pages/Microsites/TribeTrip.tsx'))->not->toBeFile()
        ->and(resource_path('js/Pages/Microsites'))->not->toBeDirectory();
});

test('the appUrl shared prop, used only by the microsites, is gone', function () {
    $this->get('/')->assertInertia(fn ($page) => $page->missing('appUrl'));
});

test('the header call to action has a short label for narrow screens', function () {
    $layout = file_get_contents(resource_path('js/Layouts/SiteLayout.tsx'));
    $css = file_get_contents(resource_path('css/home.css'));

    expect($layout)->toContain('className="cta-long"')
        ->and($layout)->toContain('className="cta-short"')
        ->and($css)->toMatch('~@media \(max-width: 480px\)\s*\{[^}]*\.cta-long\s*\{\s*display:\s*none~');
});
