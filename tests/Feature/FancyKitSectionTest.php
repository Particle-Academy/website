<?php

use App\Support\FancyKit;

/*
 * The site promotes the Fancy kit as a whole, Prism included, rather than one
 * page per package (owner, 2026-11-01). The kit's copy is a prop the home page
 * renders, so these tests see the same data the page does. PHP cannot render
 * the React tree, so the last test pins the markup that consumes it.
 */

test('the home page receives the kit with its families, Prism included', function () {
    $this->get('/')
        ->assertSuccessful()
        ->assertInertia(fn ($page) => $page
            ->component('Home')
            ->where('kit.families', fn ($families) => collect($families)->pluck('key')->all() === [
                'core', 'surfaces', 'server', 'documents', 'human-plus', 'tooling',
            ])
            ->where('kit.prism.title', 'Prism')
            ->where('kit.mirrors.languages', ['React', 'PHP', 'Node', 'Python'])
            ->has('kit.start', 4)
        );
});

test('every family names itself and says what it is', function () {
    foreach (FancyKit::toArray()['families'] as $family) {
        expect($family['title'])->toBeString()->not->toBeEmpty()
            ->and($family['body'])->toBeString()->not->toBeEmpty()
            ->and($family['icon'])->toBeString()->not->toBeEmpty();
    }
});

test('Prism is presented as the agent platform layer, with its capabilities', function () {
    $prism = FancyKit::toArray()['prism'];

    expect($prism['body'])->toContain('agent platform')
        ->and($prism['capabilities'])->toContain('Durable agent sessions')
        ->and($prism['languages'])->toBe(['PHP', 'Node', 'Python']);
});

test('how to start points at the kit showcase, its MCP, the CLI and the starter kit', function () {
    $start = collect(FancyKit::toArray()['start']);

    expect($start->pluck('href')->filter()->all())->toContain('https://ui.particle.academy', 'https://ui.particle.academy/mcp')
        ->and($start->pluck('command')->filter()->all())->toContain(
            'npx fancy-cli@latest add card',
            'laravel new my-app --using=particle-academy/fancy-starter-kit',
        );
});

test('the kit copy types no package or component count', function () {
    $copy = json_encode(FancyKit::toArray());

    expect(preg_match('~\b\d+\s+(?:packages|components)\b~i', $copy))->toBe(0);
});

test('the home page renders the kit section from the kit prop', function () {
    $home = file_get_contents(resource_path('js/Pages/Home.tsx'));

    expect($home)->toContain('id="kit"')
        ->and($home)->toContain('kit.families.map(')
        ->and($home)->toContain('kit.prism')
        ->and($home)->toContain('kit.start.map(');
});

test('the site nav links to the kit section', function () {
    expect(file_get_contents(resource_path('js/Layouts/SiteLayout.tsx')))->toContain('href="/#kit"');
});
